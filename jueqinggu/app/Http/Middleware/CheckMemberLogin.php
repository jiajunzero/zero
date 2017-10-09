<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckMemberLogin
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
        //如果用户没有登录 把记录上一页的地址到session中  便于登陆后支付
        if(!Auth::guard('member')->check()){
            $request->session()->put('previous',url()->previous());
            //跳转到登录页
            return redirect('member/loginRegister')->withErrors(['您尚未登录']);
        }
        return $next($request);
    }
}
