<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserIpMiddleware
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
        $user = Auth::user();
        
        if( $request->ip() == $user->user_ip) {
            Auth::logout();
            return redirect('/ne-dozvoljen-pristup');
        }
        return $next($request);
    }
}
