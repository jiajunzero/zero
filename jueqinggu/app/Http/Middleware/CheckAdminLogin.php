<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {    //验证用户是否登录
        if(!Auth::guard('admin')->check()){
            return redirect('admin/login')->withErrors(['请先登录后访问!']);
        }
        return $next($request);
    }
}
