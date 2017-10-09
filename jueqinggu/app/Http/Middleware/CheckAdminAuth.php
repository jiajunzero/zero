<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdminAuth
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

//        $auth=new \App\Http\Models\Auth;
        $role=Auth::guard("admin")->user()->role; //获取管理员的角色
        $auth_ac=$role->role_auth_ac; //获取管理员的权限
//        dump($auth_ac);
        //当前管理员访问的控制器方法
        //"App\Http\Controllers\Admin\AuthController@index"
        $addr=\Route::currentRouteAction();
        //分别获取控制器和方法
        $addr=explode('Controller@',$addr);
        $action=$addr[1];


//        dump($addr);die;
        $controller=explode('\\',$addr[0]);
        $controller=end($controller);

        $current=['controller'=>$controller,'action'=>$action];
        //判断当前用户的控制器跟方法是否存在权限当中
        if(!in_array($current,$auth_ac)){

//            $url=url()->previous(); //上个页面的url
            echo <<<DDD
            <script type="text/javascript" src="/back/lib/jquery/1.9.1/jquery.min.js"></script>
           <script type="text/javascript" src="/back/lib/layer/2.1/layer.js"></script>
            <script>
            $(function(){
           
                 layer.alert('权限不足', {
                    icon: 5,
                    skin: 'layer-ext-moon'
                },function(){
                     top.location.href="/admin";                           
                });
            });
            
            </script>
DDD;
        }
        return $next($request);
    }
}
