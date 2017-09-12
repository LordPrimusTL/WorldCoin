<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','gender','username','phonenumber','address','referrer','class_id','referrer_mark','r_link',
        'email', 'password','payment_id','activated','is_active','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function FindRefferer($link)
    {
        $user = User::where(['r_link' => $link,'activated' => true])->get();
        if(count($user) > 0)
        {
            return $user[0];
        }
        else{
            return null;
        }

    }

    public function comments()
    {
        return $this->hasMany(comment::class);
    }
    public function tickets()
    {
        return $this->hasMany(ticket::class);
    }


    public static function FindByReferralLink()
    {
        $user = User::where(['referrer' => Auth::user()->r_link,'activated' => true])->get();
        return $user;
    }

    public static function FindOtherReferral($id)
    {
        $user = User::find($id);
        $users = User::where(['referrer' => $user->r_link, 'activated' => true])->get();
        return $users;
    }

    public function ColumnListing()
    {
        return  $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }


}
