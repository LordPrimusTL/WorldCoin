<?php

namespace App\Http\Controllers;

use App\main_acct;
use App\trade_trans;
use App\transaction;
use App\User;
use App\utility;
use App\Worker\AlertError;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private function MyEcho($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }

    public function Dashboard()
    {
        return view('Admin.dashboard')->with(['title'=>'Dashboard-Admin','pageName'=>'Admin Dashboard']);
    }
    public function ListUsers()
    {
        $users = User::where(['role_id' => 3])->get();
        $u = new User();
        return view('Admin.users')->with(['title'=>'Users-Admin','pageName'=> 'List Users','users'=>$users,'col_list' => $u->ColumnListing()]);
    }
    public function UserProfile($id)
    {
        $user = User::find($id);
        return view('Admin.Account.view_user')->with(['title'=>'View User','user'=>$user]);
    }
    public function Accounts()
    {
        $ut = utility::where('name','withdrawal')->get();
        return view('Admin.Account.account')->with(['title' => 'Account-Admin','with' => $ut[0]->value]);
    }
    public function Transactions()
    {
        $tr = new transaction();
        return view('Admin.Account.transactions')->with(['title'=> 'Transactions - Admin','transs' => transaction::orderBy('created_at','DESC')->get(),'col_list'=>$tr->ColumnListing()]);
    }
    public function ApproveInvestment($t_id)
    {
        $date = Carbon::now();
        $trans = transaction::FindByTID($t_id)[0];
        $tt = new trade_trans();
        $tt->t_id = $trans->t_id;
        $tt->user_id = $trans->user_id;
        $tt->start_date = $date;
        $tt->amount = $trans->Amount;
        $tt->month_used = 0;
        $tt->profit_acc = 0;
        $tt->total_inv = $tt->amount + $tt->profic_acc;
        $tt->active = true;
        try{
            $tt->save();
            try{
                $tran = transaction::find($trans->id);
                $tran->ts_id = 6;
                $tran->save();
                Log::info('Trading Approved by Admin with ID '. Auth::id(),['Trans' =>(array)$trans]);
                Session::flash('success','Trading with transaction ID ' . $trans->t_id. ' is running',$tt->toArray());
                return redirect()->back();
            }
            catch (\Exception $ex)
            {
                $this->getLogger()->LogError('Investment/Trade with t_id '. $trans->t_id . 'Could not be Approved',$ex,['transaction' => (array)$trans, 'tt' =>$tt->toArray()]);
            }

        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('Investment/Trade with t_id '. $trans->t_id . 'Could not be Approved',$ex,['transaction' => (array)$trans, 'tt' =>$tt->toArray()]);
        }
        return redirect()->back();
    }
    public function CancelInvestment($t_id)
    {
        try{
            $tt = trade_trans::FindByTID($t_id);
            //move funds to main account
            $tt->active = false;
            try{
                $tt->save();
                $trans = transaction::FindByTID($t_id)[0];
                $trans = transaction::find($trans->id);
                $trans->ts_id = 5;
                try{
                    $trans->save();
                    Session::flash('success','Operation Completed Successfully');
                }
                catch (\Exception $ex)
                {
                    $this->getLogger()->LogError('Transaction Table Could not be altered to',$ex,['trans' => (array)$trans]);
                    Session::flash('error','Oops Something went wrong.., Please view log File');
                }
            }
            catch(\Exception $ex)
            {
                $this->getLogger()->LogError('Trade Transaction Table Could not be altered to',$ex,['trade Trans' => (array)$tt]);
                Session::flash('error','Oops Something went wrong.., Please view log File');
            }
        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('Somethin Went wrong',$ex,null);
            Session::flash('error','Oops Something went wrong.., Please view log File');
        }
        return redirect()->back();
    }
    private function getLogger()
    {
        $logger = new AlertError();
        return $logger;
    }
    public function TradeProgress(){
        $this->TradeSync();
        $data = trade_trans::orderBy('created_at','DESC')->get();
        return view('Admin.Account.trade_progress')->with(['title'=>'Trade Progress - Admin','data' => $data]);
        //dd();
    }
    private function TradeSync()
    {
        $trades = trade_trans::where(['active' => true])->get();
        if(count($trades) == 0)
        {
            return;
        }
        else{
            //dd($trades);
            foreach ($trades as $trade)
            {
                $old_trade = $trade;
                $sd = Carbon::parse($trade->start_date);
                $diff = $sd->diffInMonths(Carbon::now());
                if($diff > $trade->month_used)
                {
                    $trade->month_used = $diff;
                    try{
                        if($trade->month_used == 1 || $trade->month_used == 2)
                        {
                            $trade->profit_acc = $trade->profit_acc + $trade->amount/2;
                            $trade->total_inv = $trade->amount + $trade->profit_acc;
                            $trade->save();
                            $this->UpdateTransMain($trade,1);
                        }

                        if($trade->month_used == 3)
                        {
                            $trade->profit_acc = $trade->profit_acc + $trade->amount/2;
                            $trade->total_inv = $trade->amount + $trade->profit_acc;
                            $trade->active = false;
                            $trade->save();
                            $this->UpdateTransMain($trade,3);
                            $trans = transaction::FindByTID($trade->t_id)[0];
                            $old_t = $trans;
                            $trans->ts_id = 1;
                            try{
                                $trans->save();
                                Log::info('Trade Sync: Transaction Updated',['Old Trans'=> $old_t,'trans' => $trans,'trade'=>$trade,'user'=>Auth::user()]);
                            }
                            catch(\Exception $ex){
                                $this->getLogger()->LogError('Trade Sync: Transaction Update Failed',$ex,['trans' => $trans,'trade'=>$trade,'user'=>Auth::user()]);
                            }

                        }
                        Log::info('Trade Sync: Trade Updated Successfully',['old_trade' => $old_trade,'trade' => (array)$trade, 'user'=>Auth::id()]);
                    }
                    catch(\Exception $ex)
                    {
                        $this->getLogger()->LogError('Trade Sync: Error occured while saving trade', $ex, ['old_trade' => $old_trade,'trade' => (array)$trade, 'user'=>Auth::id()]);
                    }
                }
                else{

                }
                //$this->MyEcho(Carbon::parse($trade->start_date));
                //$this->MyEcho(Carbon::parse($trade->start_date)->diffInMonths(Carbon::now()));
            }
            Session::flash('success','Trade Sync Completed Sucessfully');
            return;

        }
    }
    private function UpdateTransMain($trade,$type)
    {
        $trans = new transaction();
        $trans->t_id = $this->GenerateTID();
        $trans->user_id = $trade->user_id;
        $trans->amount = $trade->amount/2 + $trade->amount;
        if($type == 1)
        {
            $trans->amount = $trade->amount/2;
            $trans->transaction_description = 'Monthly Trade Profit';
        }
        if($type == 3)
        {
            $trans->amount = $trade->amount/2 + $trade->amount;
            $trans->transaction_description = 'Monthly Trade Profit/Capital';
        }

        $trans->tn_id = 1;
        $trans->t_type = 1;
        $trans->ts_id = 8;
        $trans->current_balance = transaction::getBalance($trade->user_id) + $trans->amount;

        try{
            $trans->save();
            Log::info('Transaction Saved from Trade Sync',['trade' => (array)$trade,'trans' => (array)$trans, 'user' => Auth::id()]);
            $main = main_acct::where(['user_id' => $trade->user_id])->first();
            if($main ==  null || count($main) == 0)
            {
                $old_main = null;
                $nmain = new main_acct();
                $nmain->user_id = $trade->user_id;
                $nmain->ref_amount = 0;
                $nmain->trade_account =  $trade->amount/2;
                $main->total_amount = $main->ref_amount + $main->trade_amount;
            }
            else{
                $old_main = $main;
                $main->trade_amount = $main->trade_amount + $trade->amount/2;
                $main->total_amount = $main->ref_amount + $main->trade_amount;
            }
            try{
                $main->save();
                Log::info('Trade Sync: Main Account Updated.',['old_main' => (array)$old_main, 'main'=>(array)$main, 'trans' => (array)$trans,'trade'=>(array)$trade]);
            }
            catch(\Exception $ex){
                $this->getLogger()->LogError('Main Account Could not be Updated', $ex,['old_main' => (array)$old_main, 'main'=>(array)$main, 'trans' => (array)$trans,'trade'=>(array)$trade]);
            }
            Log::info('Trade Sync: Transaction Saved',['trade' => (array)$trade,'trans' => (array)$trans, 'user' => Auth::id()]);
        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('Trade Sync: Transaction Could Not be saved', $ex,['trans' => (array)$trans,'trade'=>(array)$trade]);
        }
    }
    public function Withdrawals()
    {
        $ut = utility::where('name','withdrawal')->get();
        //dd(transaction::where(['tn_id' => 2])->orWhere(['tn_id' => 4])->orderBy('created_at','DESC')->get());
        return view('Admin.Account.withdrawals')->with(['title' => 'Withdrawals - Admin',
            'transs' => transaction::where(['tn_id' => 2])->orWhere(['tn_id' => 4])->orWhere(['tn_id' => 5])->orderBy('created_at','DESC')->get(),'with' => $ut[0]->value]);
    }
    public function ApproveWithdrawal($t_id)
    {
        $trans = transaction::FindByTID($t_id)[0];
        $trans = transaction::find($trans->id);
        $main = main_acct::where(['user_id'=>$trans->user_id])->first();
        if($trans == null)
        {
            Session::flash('error','Unknown Transaction Id Given');
        }
        else
        {
            if(User::find($trans->user_id)->class_id < 1)
            {
                $tr = new transaction();
                $tr->t_id = $this->GenerateTID();
                $tr->Amount = (10/100) * $trans->Amount;
                $tr->user_id = $trans->user_id;
                $tr->transaction_description = 'Withdrawal Charge/'.$trans->t_id;
                $tr->tn_id = 5;
                $tr->ts_id = 7;
                $tr->t_type = 2;
                $tr->current_balance = $trans->current_balance;
                $trans->ts_id = 7;
                try{
                    $tr->save();
                    Log::info('AW: Charge Deducted from transaction table',['Charge' =>(array)$tr ]);
                }
                catch(\Exception $ex)
                {
                    $this->getLogger()->LogError('AW: Charge Could not be decucted from transaction table',$ex,['Charge' => (array)$tr]);
                }
            }
            else{
                $trans->ts_id = 7;
                $trans->save();
            }
            try{
       //         $trans->current_balance = $main->total_amount;
                $trans->save();
                Session::flash('success','Withdrawal Approved');
                Log::info('Withdrawal Approved by Admin with ID '. Auth::id(),['Trans' =>(array)$trans]);
            }
            catch(\Exception $ex)
            {
                $this->getLogger()->LogError('Error Approving Withdrawal',$ex,['Trans' =>(array)$trans]);
            }



        }
        return redirect()->back();
    }
    public function CancelWithdrawal($t_id)
    {
        $trans = transaction::FindByTID($t_id)[0];
        if($trans  == null)
        {
            Session::flash('error','Unknown Transaction ID Given');
        }
        else{
            $trans = transaction::find($trans->id);
            $trans->ts_id = 5;
            try{
                $trans->save();
                Session::flash('success','Operation Completed Successfully');
            }
            catch (\Exception $ex)
            {
                $this->getLogger()->LogError('Transaction Table Could not be altered to',$ex,['trans' => (array)$trans]);
                Session::flash('error','Oops Something went wrong.., Please view log File');
            }
        }


    }
    private function GenerateTID()
    {
        $t_id = str_random(15);
        if(transaction::findByT_ID($t_id))
        {
            return $t_id;
        }
        else
        {
            $this->GenerateTID();
        }
    }
    public function WithStatus($status)
    {
        $ut = utility::where('name','withdrawal')->get();
        $ut[0]->value = (bool)$status;
        try{
            $ut[0]->save();
            Log::info('Withdrawal Status Changed by Admin with User ID '.Auth::id(),[$status]);
        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('WithStatus: Could Not Change status',$ex,['Admin ID' => Auth::id(),'Status'=> $status]);
        }
        return redirect()->back();
    }


}
