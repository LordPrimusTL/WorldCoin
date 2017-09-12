<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trade_trans extends Model
{
    //

    public static function FindByTID($t_id)
    {
        return trade_trans::where('t_id',$t_id)->first();
    }

    public static  function Occupied($id)
    {
        $occ = trade_trans::where(['user_id' => $id, 'active'=> true])->get();
        if(count($occ) > 0)
        {
            return true;
        }
        else{
            return false;
        }

    }

}
