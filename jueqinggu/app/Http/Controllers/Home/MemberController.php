<?php

namespace App\Http\Controllers\Home;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Models\Member;
use Auth;
use Validator;

class MemberController extends Controller
{

    //显示会员首页
    public function index(){

    }

    //登录注册页
    public function loginRegister(){

        return view('home.member.loginRegister');
    }

    //登录功能
    public function login(Request $request){


        $data=$request->only('username','password');

//        $rules=[
//          'username'=>'required',
//          'password'=>'required',
//        ];
//
//        $message=[
//          'username.required'=>'请输入手机号码或邮箱',
//          'password.required'=>'请输入密码',
//        ];
//
//        $validator=Validator::make($data,$rules,$message);
//        if($validator->fails()){
//            return redirect()->back()->withErrors($validator);
//        }


        $res1=Auth::guard('member')->attempt(['password'=>$data['password'],'email'=>$data['username']]);
        $res2=Auth::guard('member')->attempt(['password'=>$data['password'],'phone'=>$data['username']]);


        if($res1 || $res2){
            if($url=$request->session()->get('previous')){
                return redirect($url);
            }

            //清除上一页面的sessoin
            $request->session()->put('previous',null);
            return redirect('member');
        }else{
            return redirect()->back()->withErrors(['请输入正确的手机号或邮箱']);
        }
    }

    //注册功能
    public function register(){

    }

    //退出登录
    public function logout(Request $request){
        Auth::guard('member')->logout();
        return redirect('/');
    }


    //发送短信验证码
    public function sendSMS(){

    }


    //找回密码
    public function find(){

    }


}
