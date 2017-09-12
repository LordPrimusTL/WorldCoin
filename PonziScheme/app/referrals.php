<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class referrals extends Model
{
    public $fillable = ['referred','referrer','base_link','ref_link','link_ex'];

    public static function FindRefLink($referrer,$referred)
    {
        $rf = referrals::where(['referrer' => $referrer,'referred' => $referred])->first();
        return $rf->ref_link;
    }
    public static function FindReferrals($id)
    {
        return referrals::where(['referrer'=>$id])->get();
    }

    public static function FindByUserAndReferrer($id,$referrer)
    {
        $data = referrals::where(['referred' => $id, 'referrer' => $referrer])->first();
        return $data;
    }
}
