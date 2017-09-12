<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class alert_error extends Model
{
    public $fillable =['error_id','user_id'];

    public static function findByT_ID($t_id)
    {
        $checkTid = alert_error::where(['error_id' => $t_id])->get();
        if(count($checkTid) > 0)
        {
            return false;
        }
        else{
            return true;
        }
    }
}
