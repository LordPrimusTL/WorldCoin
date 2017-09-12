<?php

namespace App\Http\Middleware;

use App\Worker\AuthCheck;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckAdmin
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
        if(AuthCheck::AuthAdminCheck())
        {
            return $next($request);
        }
        else{

            Log::info('User with ID ' . Auth::id() . ' tried to access an admin route');
            Auth::logout();
            return redirect()->action('UtilityController@Home');
        }
    }
}
