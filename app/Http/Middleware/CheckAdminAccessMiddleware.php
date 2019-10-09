<?php

namespace App\Http\Middleware;

use App\Admin;
use App\Models\AdminPermission;

use Closure;
use Illuminate\Support\Facades\Auth;


class CheckAdminAccessMiddleware
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
        $access = AdminPermission::where('admin_id', $user->id)->first();

        if(!$access) {
            return redirect('/ne-dozvoljen-pristup');
        }
        return $next($request);
    }
}
