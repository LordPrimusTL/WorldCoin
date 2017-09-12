<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    public $fillable =['t_id','user_id','amount','current_balance','ts_id','transaction_description'];

    public static function findByT_ID($t_id)
    {
        $checkTid = transaction::where(['t_id' => $t_id])->get();
        if(count($checkTid) > 0)
        {
            return false;
        }
        else{
            return true;
        }
    }

    public static function FindByTID($t_id)
    {
        $checkTid = transaction::where(['t_id' => $t_id])->get();
        if(count($checkTid) > 0)
        {
            return $checkTid;
        }
        else{
            return null;
        }
    }

    public static function getBalance($id)
    {
        $bal = transaction::where(['user_id' => $id])->orderBy('created_at','desc')->first();
        if($bal != null)
        {
            if($bal->current_balance != null)
            {
                return $bal->current_balance;
                //return 0;
            }
            else
            {
                return 0;
            }
        }
        else{
            return 0;
        }
    }

    public function ColumnListing()
    {
        return  $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
