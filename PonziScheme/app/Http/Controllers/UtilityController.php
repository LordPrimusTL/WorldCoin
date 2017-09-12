<?php

namespace App\Http\Controllers;

use App\Classes\EmailWorks;
use App\Worker\AuthCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UtilityController extends Controller
{
    public function Home()
    {
        if(AuthCheck::AuthUserCheck())
        {
            return redirect()->action('UserController@Dashboard');
        }
        elseif(AuthCheck::AuthAdminCheck())
        {
            return redirect()->action('AdminController@Dashboard');
        }
        return view('Utility.home')->with(['title'=>'Home']);
    }

    public function SignIn()
    {
        return view('Utility.signin')->with(['title'=>'Sign In']);
    }

    public function SignOut()
    {
        Auth::logout();
        return redirect()->action('UtilityController@Home');
    }

    public function Register()
    {
        return view('Utility.register')->with(['title' => 'Register','rf' => null]);
    }

    public function RRegister($refferer)
    {
        return view('Utility.register')->with(['title' => 'Register','rf' => $refferer]);
    }

    public function ResetPassword()
    {
        return view('Utility.forgotpassword')->with(['title' => 'Reset Password','a_email'=>false, 'MyAuth' => false, 'form_title' => 'Account Recovery']);
    }

    public function ResetPasswordA($id)
    {
        return view('Utility.forgotpassword')->with(['title' => 'Reset Password','a_email'=>true, 'MyAuth' == false, 'token' => $id, 'form_title' => 'Account Recovery']);
    }

    public function About()
    {
        return view('Utility.about')->withTitle('About');
    }

    public function TOS()
    {
        return view('Utility.tos')->withTitle('Term of Service');
    }
}
