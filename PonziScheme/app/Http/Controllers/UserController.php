<?php

namespace App\Http\Controllers;

use App\referrals;
use App\transaction;
use App\User;
use App\utility;
use App\Worker\AlertError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getLogger()
    {
        $logger = new AlertError();
        return $logger;
    }
    public function MyEcho($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
    public function Dashboard()
    {
        $ut = utility::where('name','withdrawal')->get();
        return view('User.dashboard')->with(['title' => 'Dashboard','with' => $ut[0]->value]);
    }
    public function Profile()
    {
        return view('User.profile')->with(['title' => 'Profile','user' => Auth::user()]);
    }
    public function ChangePassword()
    {
        return view('Utility.forgotpassword')->with(['title' => 'Change Password','a_email'=>false, 'MyAuth' => true, 'form_title' => 'Change Password']);
    }
    public function Referral()
    {
        Log::info('Cliked On Referral ',[json_encode(Auth::user())]);
        return view('User.referral')->with(['title' => 'Referrals','referrals' => referrals::FindReferrals(Auth::id())]);
    }
    public function Referrals($id)
    {
        Log::info('Cliked On referral for user '. $id);
        return view('User.referral')->with(['title' => 'Referrals','referrals' => referrals::FindReferrals($id)]);
    }
    public function Transactions()
    {
        $transaction = transaction::where(['user_id' => Auth::id()])->orderBy('created_at','desc')->get();
        return view('User.transactions')->with(['title'=>'Transaction','transaction' => $transaction]);
    }
    public function Account()
    {
        return view('User.accounts')->with(['title'=>'Accounts']);
    }
    public function ReferralAccount()
    {
        $trade = transaction::where(['user_id' => Auth::id(),'tn_id' => 3])->orderBy('created_at','DESC')->get();
        return view('User.Account.referral')->with(['title'=>'Referral Account','cName' => 'Referral Account And Transactions','trade' => $trade]);
    }
    public function Invest()
    {
        return view('User.Invest')->with(['title'=>'Invest']);
    }
    public function CancelTransaction($t_id)
    {
        $trans = transaction::FindByTID($t_id)[0];
        $trans->ts_id = 4;
        try{
            $trans->save();
            Session::flash('success','Transaction Cancelled Successfully');
            Log::info('Transaction with cancelled successfully',['User' => Auth::user(), 'trans' => $trans]);
        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('Error Occured When tring to cancel operation',$ex,['User' => Auth::user(), 'trans' => $trans]);
            Session::flash('error'.'Oops, Something went wrong, try again later');
        }
        return redirect()->back();

    }
    public function Withdrawals()
    {
        return view('User.Account.withdrawals')->with(['title'=>'Withdrawals','transaction' => transaction::where(['user_id' => Auth::id(),'tn_id' => 2])->orderBy('created_at','DESC')->get()]);
        //dd(transaction::where(['user_id' => Auth::id(),'tn_id' => 2])->get());
    }
    public function TradeAccount()
    {

    }

}
