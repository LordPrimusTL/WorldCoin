<?php

namespace App\Http\Middleware;

use App\Worker\AuthCheck;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckAuthUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(AuthCheck::AuthUserCheck())
        {
            return $next($request);
        }
        else{
            Log::info('User with Admin right and ID ' . Auth::id() . 'tried to acces a user profile');
            Auth::logout();
            return redirect()->action('UtilityController@Home');
        }
    }
}
