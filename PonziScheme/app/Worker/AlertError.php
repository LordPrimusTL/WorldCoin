<?php
/**
 * Created by PhpStorm.
 * User: Primus
 * Date: 8/12/2017
 * Time: 3:01 PM
 */

namespace App\Worker;


use App\alert_error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AlertError
{
    private function SaveError($error_id)
    {
        $ae = new alert_error();
        $ae->error_id = 'Error - '. $error_id;
        $ae->user_id = Auth::id();
        $ae->save();
        Session::flash('error','minor error occured, Please check Log');
        Log::info('New Error saved in database to be treated');
    }

    public function LogError($errormsg,$ex,$other){
        $error_id = $this->ErrorID();
        if($other == null)
        {
            Log::error($errormsg,['error_id'=>$error_id,'error'=> $ex->getMessage().$ex->getLine().$ex->getTraceAsString()]);
        }
        else{
            Log::error($errormsg,['error_id'=>$error_id,'error'=> $ex->getMessage().$ex->getLine().$ex->getTraceAsString(), $other]);
        }

        $this->SaveError($error_id);
    }

    private function ErrorID()
    {
        $t_id = str_random(20);
        if(alert_error::findByT_ID($t_id))
        {
            return $t_id;
        }
        else
        {
            var_dump(false);
            $this->ErrorID();
        }
        return $t_id;
    }

}