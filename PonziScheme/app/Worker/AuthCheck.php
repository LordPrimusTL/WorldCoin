<?php
/**
 * Created by PhpStorm.
 * User: Primus
 * Date: 8/6/2017
 * Time: 4:35 PM
 */

namespace App\Worker;


use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    public static function AuthUserCheck()
    {
        if(Auth::check() && Auth::user()->role_id == 3 && Auth::user()->is_active)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public static function AuthAdminCheck()
    {
        if(Auth::check() && Auth::user()->role_id < 3 && Auth::user()->is_active)
        {
            return true;
        }
        else{
            return false;
        }
    }
}