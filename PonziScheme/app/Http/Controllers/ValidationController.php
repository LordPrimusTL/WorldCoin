<?php

namespace App\Http\Controllers;

use App\alert_error;
use App\btc_link;
use App\main_acct;
use App\ref_acct;
use App\referrals;
use App\Role;
use App\trade_trans;
use App\transaction;
use App\User;
use App\user_class;
use App\utility;
use App\Worker\AlertError;
use App\Worker\EmailWorks;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ValidationController extends Controller
{

    public function getLogger()
    {
        $logger = new AlertError();
        return $logger;
    }
    public function SignInV()
    {
        //verify and redirect to dashboard
        if(Auth::attempt(['email' => Input::get('user_email'),'password' => Input::get('user_password')]))
        {
            if(Auth::user()->is_active)
            {
                if(Auth::user()->role_id < 3)
                {
                    return redirect()->action('AdminController@Dashboard');
                }
                else{
                    return redirect()->action('UserController@Dashboard');
                }
            }
            else{
                Session::flash('error', 'Please contact the admin as your account has entered the dormancy period.');
                Auth::logout();
                return redirect()->back();
            }

        }
        else{
            Session::flash('error','Incorrect Username/Password');
            return redirect()->back();
        }
        //return redirect()->action('UserController@Dashboard');
    }
    public function RegisterV(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'phonenumber' => 'required',
            'address' => 'required',
            'password' => 'required',
            'password_conf' => 'required|same:password'
        ]);
        $user = new User();
        $user->firstname = $request->first_name;
        $user->lastname = $request->last_name;
        $user->username = $request->username;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->payment_id = $request->payment_id;
        if($request->referrer != null)
        {
            $referrer = User::FindRefferer($request->referrer);
            if($referrer == null)
            {
                $user->referrer = null;
            }
            else{
                $user->referrer = $referrer->id;
            }

        }
        else{
            $user->referrer  = $request->referrer;// get refferer id
        }
        $user->r_link = $request->first_name . $request->last_name . time();
        if($user->save())
        try{
            Log::info('User ' . $user->id. ' Added',[$user]);
            Session::flash('success','An Activation Email Has been sent to you.');
            /*if($user -> payment_id == 1)
            {
                $data = ['fname' => $user->firstname,'email' => $user->email];
                $email = new EmailWorks();
                //if($email->BTCRegMail($data))
                {
                    var_dump('sent');
                    Session::flash('success','An Activation Email Has been sent to you.');
                }
               // else
                    {
                    $user->delete();
                    var_dump('not sent');
                    Session::flash('error','Could not register a new user at this time. Please try again later');
                }


            }*/
        }
        catch(\Exception $ex){
            Log::error('Could Not add User due to error below',[$user]);
            Session::flash('error','Could not register a new user at this time. Please try again later');
            var_dump('dhfaksdnfjasdf');
        }
        return redirect()->back();
    }
    public function ResetPassword()
    {
        //echo '<pre>';
        //var_dump(Input::all());
        //echo '</pre>';
        Session::flash('success','Your reset token has been sent to your enail. Thank you');
        return redirect()->back();
    }
    public function ResetPasswordA($id)
    {
        echo '<pre>';
        var_dump(Input::all(), $id);
        echo '</pre>';
    }
    public function EditProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username',
            'phonenumber' => 'required',
            'address' => 'required',
        ]);

        $user = User::find(Auth::id());
        $user->firstname = $request->first_name;
        $user->lastname = $request->last_name;
        $user->username = $request->username;
        $user->phonenumber = $request->phonenumber;
        $user->address = $request->address;
        $user->payment_id = $request->payment_id;
        $user->r_link = $request->first_name . $request->last_name . time();
        if(Hash::check($request->password,$user->password))
        {
            if($user->save())
            {
                Log::info('User Profile Updated', ['Old Data' => json_encode($request->all()),'New Data' => json_encode($user)]);
                Session::flash('success','Profile Updated Succeccfully.');
            }
            else{
                Session::flash('error','Could not register a new user at this time. Please try again later');
            }
        }
        else{
            Session::flash('error','Incorrect Password');
        }

        return redirect()->back();
    }
    public function PasswordChange(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'new_conf_password' => 'required|same:new_password',
        ]);

        $user = User::find(Auth::id());
        if(Hash::check($request->old_password,$user->password))
        {
            $user->password = Hash::make($request->new_password);
            if($user->save())
            {
                Session::flash('success','Password Changed Successfully');
                Log::info('User Changed Password',['Old Password' => json_encode($request->old_password),'New Password' => json_encode($user->password)]);
            }
            else{
                Session::flash('error','Oops something we don\'t know happened. Please try again');
            }
        }
        else
        {
            Session::flash('error','Password Mismatch. Please try again');
        }


        return redirect()->back();

    }
    public function MyEcho($data)
    {
        //echo '<pre>';
        dd($data);
        //echo '</pre>';
    }
    public function AwardCash($referred){
        for($i = 5; $i > 0; $i--)
        {
            if($referred->referrer != null) {
                $user = User::find($referred->referrer);
                $transaction = new transaction();
                $transaction->t_id = $this->GenerateTID();
                $transaction->user_id = $referred->referrer;
                $transaction->amount = $i;
                $transaction->transaction_description = 'Referral Bonus';
                $transaction->tn_id = 3;
                $transaction->ts_id = 1;
                $transaction->t_type = 3;
                $transaction->current_balance = transaction::getBalance($referred->referrer) + $i;
                try{
                    if ($transaction->save()) {
                        Log::info($i . ' Transaction saved', [(array)$transaction]);
                        if(count(ref_acct::where(['user_id' => $referred->referrer])->get()) == 0)
                        {
                            $rft = new ref_acct();
                            $rft->user_id = $referred->referrer;
                            $rft->amount = $transaction->amount;
                            $rft->t_id = $transaction->id;
                            $rft->fbal = 0;
                            $rft->cbal = $transaction->amount;
                            try{
                                $rft->save();
                                Log::info('Ref Account Updated',['Old RFT'=>null, 'New RFT'=>(array)$rft]);
                                if(count(main_acct::where(['user_id' => $referred->referrer])->get()) == 0)
                                {
                                    $main = new main_acct();
                                    $main->user_id = $referred->referrer;
                                    $main->ref_amount = $rft->amount;
                                    $main->trade_amount = 0;
                                    $main->total_amount = $main->ref_amount + $main->trade_amount;
                                    try{
                                        $main->save();
                                        Log::info('Main Account Updated',['user_id' => $referred->referrer,['main_acct'=>(array)$main]]);
                                    }
                                    catch(\Exception $ex)
                                    {
                                        $this->getLogger()->LogError('Error Updating Main Account',$ex,['user_id' => $referred->referrer,['main_acct'=>(array)$main]]);
                                    }
                                }

                                if ($user->class_id != 0) {
                                    Log::info('Class recruiting limit reached',(array)$user);
                                }
                                else {
                                    try {
                                        $user->referrer_mark++;
                                        $this->RfUpdate($user);
                                        $user->save();
                                        Log::info('referral mark added', (array)$user);
                                    } catch (\Exception $ex) {
                                        $this->getLogger()->LogError('Referral Mark Could not be Added',$ex,['user' => (array)$user]);
                                    }

                                }
                            }
                            catch(\Exception $ex)
                            {
                                $error_id = $this->ErrorID();
                                Log::error('Referral Account Could Not be Updated',['error_id'=>$error_id,'error'=> $ex->getMessage().$ex->getLine().$ex->getTraceAsString(), 'data' => (array)$rft]);
                                $this->LogError($error_id,Auth::id());
                            }
                        }
                        else{
                            $rft = ref_acct::where(['user_id' => $referred->referrer])->first();
                            $oldrft = $rft;
                            $rft->t_id = $transaction->id;
                            $rft->amount = $transaction->amount;
                            $rft->fbal = $rft->cbal;
                            $rft->cbal = $transaction->amount;
                            try {
                                $rft->save();
                                Log::info('Ref Account Updated',['Old RFT'=>(array)$oldrft, 'New RFT'=>(array)$rft]);
                                $main = main_acct::where(['user_id' => $referred->referrer])->first();
                                $old_main = $main;
                                $main->ref_amount = $main->ref_amount + $rft->amount;
                                $main->total_amount = $main->ref_amount + $main->trade_amount;
                                try{
                                    $main->save();
                                    Log::info('Main Account Updated from referrals',['User_id' => $referred->referrer,
                                        'Old_main' => (array)$old_main,'New Main'=>$main]);
                                }
                                catch(\Exception $ex)
                                {
                                    $this->getLogger()->LogError('Main account could not be updated from referrals',$ex,['User_id' => $referred->referrer,
                                        'Old_main' => (array)$old_main,'New Main'=>$main]);
                                }
                                if ($user->class_id != 0) {
                                    Log::info('Class recruiting limit reached', (array)$user);
                                } else {
                                    try {
                                        $user->referrer_mark++;
                                        $this->RfUpdate($user);
                                        $user->save();
                                        Log::info('referral mark added', (array)$user);
                                    } catch (\Exception $ex) {
                                        $error_msg = 'referral mark not added';
                                        $this->getLogger()->LogError($error_msg, $ex,['user' => (array)$user]);
                                    }

                                }
                            }
                            catch (\Exception $ex){
                                $this->getLogger()->LogError('Referral Account Could Not be Updated',$ex,['Old RFT'=>(array)$oldrft, 'TBRFT'=>(array)$rft]);
                            }
                        }
                        $referred = User::find($referred->referrer);
                    }
                }
                catch (\Exception $exception)
                {
                    $this->getLogger()->LogError('Transaction Could Not be saved',$ex,['transaction'=>(array)$transaction, 'user' => (array)$user]);
                }
            }
            else{
                break;
            }
        }
    }
    public function GenerateTID()
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
    public function UpdateClass($user)
    {
        $nc = user_class::all();
        if($user->referral_mark < user_class::find(count($nc))->target)
        {
            $class = user_class::find($user->class_id);
            if($class == null)
            {
                $user->referral_mark = $user->referral_mark + 1;
                try{
                    $user->referrer_mark = $user->referrer_mark + 1;
                    $user->save();
                    Log::info('Referral Mark(1) Has been added to User',['user'=>(array)$user]);

                }
                catch(\Exception $ex)
                {
                    $this->getLogger()->LogError('Referral Mark Could Not be added to user',$ex,['user'=>(array)$user]);
                }
            }
        }

    }
    private function RfUpdate($user)
    {
        if($user->referrer_mark == user_class::find($user->class_id + 1)->target)
        {
            $user->class_id++;
            $user->save();
            $referrer = User::find($user->referrer);
            if($referrer == null)
            {
                Log::info('referrer is null',(array)$referrer);
                return;
            }
            else{
                $referrer->referrer_mark++;
                $referrer->save();
                $this->RfUpdate($referrer);
            }
        }

    }
    public function Invest(Request $request)
    {
        $Amount = Input::get('inv_number');
        if($Amount != null && $Amount > 20 )
        {
            if(trade_trans::Occupied(Auth::id()))
            {
                Session::flash('error','You are already trading, please try again when the current trading is over. Thank you');
                return redirect()->back();
            }
            else{
                //sendmail to ID
                $transaction = new transaction();
                $transaction->t_id = $this->GenerateTID();
                $transaction->user_id = Auth::id();
                $transaction->amount = $Amount;
                $transaction->transaction_description = 'Investment';
                $transaction->tn_id = 1;
                $transaction->ts_id = 3;
                $transaction->t_type = 2;
                $transaction->current_balance = transaction::getBalance(Auth::id());
                try{
                    $transaction->save();
                    Log::info('Investment Saved and waiting Aprroval Please chack you email for further instructions',[(array)$transaction]);
                    Session::flash('success','Investment Applied for and waiting approval');
                    //Send Mail with BTCs or Cash
                    return redirect()->action('UserController@Transactions');
                }
                catch(\Exception $ex){
                    $this->getLogger()->LogError('Investment Application Not Successful',$ex,[(array) $transaction]);
                    Session::flash('error','Investment Application Failed. Please try again later');
                    return redirect()->back();
                }
            }

        }
        else{
            Session::flash('error','Please Supply an amount greater that 20');
            return redirect()->back();
        }
    }
    public function Withdrawal(Request $request)
    {
        $act_from = $request->with_from;
        $ut = utility::where('name','withdrawal')->get();
        if(!$ut[0]->value)
        {
            Session::flash('error','You can\'t withdraw at this time. Please with till the withdrawal colour is set to green');
            return redirect()->back();
        }
        else{
            if($request->with_from == null)
            {
                Session::flash('error','Please select an account to deduct the funds from.');
                return redirect()->back();
            }
            else{
                $amt = $request->with_number;
                $main = main_acct::where(['user_id'=>Auth::id()])->first();
                if($main != null) {
                    if ($act_from == 0) {
                        if ($amt > $main->ref_amount) {
                            Session::flash('error', 'Insufficient Amount, You are trying to withdraw $' . $amt . ' from your referral Account while you have $' . $main->ref_amount);
                            return redirect()->back();
                        }
                    } elseif ($act_from == 1) {
                        if ($amt > $main->trade_amount) {
                            Session::flash('error', 'Insufficient Amount, You are trying to withdraw $' . $amt . ' from your Trade Account while you have $' . $main->trade_amount);
                            return redirect()->back();
                        }
                    }
                    $trans = new transaction();
                    $trans->user_id = Auth::id();
                    $trans->t_id = $this->GenerateTID();
                    $trans->amount = $amt;
                    $trans->transaction_description = 'Withdrawal';
                    if($request->with_from == 0)
                    {
                        $trans->tn_id = 4;
                        $trans->transaction_description = 'Withdrawal/Referral';
                    }

                    if($request->with_from == 1)
                    {
                        $trans->transaction_description = 'Withdrawal/Trade';
                        $trans->tn_id = 2;
                    }
                    $trans->ts_id = 3;
                    $trans->t_type = 2;
                    $trans->current_balance = $main->Total_amount;
                    try{
                        $trans->save();
                        Log::info('Transaction Table Updated from Withrawal',['trans'=>$trans,'user_id'=>Auth::id()]);
                        Session::flash('success','Withdrawal Application Successful!!!');
                    }
                    catch(\Exception $exception)
                    {
                        $this->getLogger()->LogError('Transaction Table Unable to Update',$exception,['trans'=>$trans,'user_id'=>Auth::id()]);
                        Session::flash('error','Oops, An Error Occured. Please Try Again');
                    }
                }
                else{
                    Session::flash('error','Insufficient Amount, You are trying to withdraw $'.$amt.' while you have $0');
                    return redirect()->back();
                }
            }
            return redirect()->back();
        }

    }




    //----------------------------Admin Section----------------------------------
    public function EditUser(Request $request)
    {
        if(Input::get('user_id') == null && $request->user_id)
        {
            Session::flash('error','Operation could not be completed at this time.');
        }
        else
        {
            $user = User::find($request->user_id);
            $old_user = $user;
            if($user->class_id == $request->class_id)
            {
                $user->class_id = $request->class_id;
            }
            else{
                $user->class_id = $request->class_id;
                $user->referrer_mark = 0;
            }
            $user->is_active = (bool)$request->is_active;
            $user->activated = (bool)$request->activated;
            if($user->activated)
            {
                if(referrals::FindByUserAndReferrer($user->id,$user->referrer) == null)
                {
                    $this->ActivateUser($user->id);
                }
            }
            if(Hash::check($request->password, Auth::user()->password))
            {
                if($user->save())
                {
                    Session::flash('success','User Data Updated successfully');
                    Log::info('User ' . $user->id .' Editted by a user with Admin priviledges and ID ' . Auth::id(),
                        ['Admin'=>(array)Auth::user(), 'Old User' => (array)$old_user,'New User' => (array)$user]);
                }
                else{
                    Session::flash('error','Could not register a new user at this time. Please try again later');
                }
            }

        }
        return redirect()->back();
    }
    public function UserSearch(Request $request)
    {
        $col = new User();
        $i = $col->ColumnListing();
        $user = User::where($i[$request->col_name],'LIKE','%'.$request->user_key.'%')->where(['role_id'=>3])->get();

        return view('Admin.users')->with(['title'=>'Users-Admin','pageName'=> 'List Users','users'=>$user,'col_list' => $i]);
    }
    public function TransSearch(Request $request)
    {
        $col = new transaction();
        $i = $col->ColumnListing();
        $user = transaction::where($i[$request->col_name],'LIKE','%'.$request->trans_key.'%')->get();
        return view('Admin.Account.transactions')->with(['title'=>'Transactions-Admin','pageName'=> 'List Users','transs'=>$user,'col_list' => $i]);
    }
    public function ActivateUser($id)
    {
        $user = User::find($id);
        $referrer = User::find($user->referrer);
        $user->activated = true;
        try{
            $user->save();
            if($user->referrer != null) {
                $rf = new referrals();
                $rf->referred = $user->id;
                $rf->referrer = $referrer->id;
                if ($referrer->referrer != null) {
                    $rf->base_link = referrals::FindRefLink($referrer->referrer, $referrer->id);
                } else {
                    $rf->base_link = null;
                }
                $rf->ref_link = $referrer->id . '_' . $user->id;
                try {
                    $rf->save();
                    Log::info('Referral saved', (array)$rf);
                    $this->AwardCash($user);
                    //Send Activated Mail
                } catch (\Exception $exception) {
                    Session::flash('error', 'Operation Could Not be completed At this time');
                    $this->getLogger()->LogError('Referral Could Not Be saved',$exception,(array)$rf);
                    //return redirect()->back();
                }
            }
            else{
                Log::error('Referral Could Not Be saved', (array)$user);
            }
        }
        catch(\Exception $exception){
            Session::flash('error','Operation Could not be completed at this time');
            $this->getLogger()->LogError('Could Not Activate User',$exception,(array)$user);
        }
        return redirect()->back();
    }
}
