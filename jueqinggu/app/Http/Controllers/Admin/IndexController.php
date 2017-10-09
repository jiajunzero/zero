<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qiniu\Storage;
use Validator;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function index(\App\Http\Models\Auth $auth){

        //输出权限菜单
        $role=Auth::guard("admin")->user()->role;

        $data['topAuth']=$auth->whereIn('id',$role->role_auth_ids)->where('auth_pid','0')->get();// 顶级权限

        $data['sonAuth']=$auth->whereIn('id',$role->role_auth_ids)->where('auth_pid','!=',0)->where('is_menu',1)->get();// 子级权限

        return view('admin.index.index',$data);
    }


    //登录
    public function login(Request $request){

        if($request->isMethod('post')){

            //接收数据
            $data=$request->only('username','password','verify');

            //验证规则
            $rules=[
              'username'=>'required',
               'password'=>'required',
               'verify'=>'required|captcha'
            ];

            //不符规则的错误信息
            $message=[
              'username.required'=>'请输入用户名',
              'password.required'=>'请输入密码',
              'verify.required'=>'请输入验证码',
              'verify.captcha'=>'验证码不正确'
            ];

            $validator=Validator::make($data,$rules,$message);

            //验证失败返回错误信息
            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }


            $remember=$request->input('online'); //记住登录
            //验证登录信息 多条件登录 $remember  如果为true 就记住登录状态
           $res1= Auth::guard('admin')->attempt(['password'=>$data['password'],'username'=>$data['username']],$remember);
           $res2= Auth::guard('admin')->attempt(['password'=>$data['password'],'phone'=>$data['username']],$remember);
           $res3= Auth::guard('admin')->attempt(['password'=>$data['password'],'email'=>$data['username']],$remember);

           if($res1 || $res2 || $res3){//登录成功

               //登录次数
                  //登录成功就+1
               $number=Auth::guard('admin')->user()->login_number+1;
               Auth::guard('admin')->user()->login_number=$number;
               //保存登录ip
               Auth::guard('admin')->user()->login_ip=$request->server('REMOTE_ADDR');
               Auth::guard('admin')->user()->save();

               return redirect()->to('admin');
           }else{
               //登录失败
               return redirect()->back()->withErrors(['用户名或密码不正确！']);
           }
        }


        return view('admin.index.login');
    }


    //退出登录
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login')->withErrors(['已退出登录']);
    }

    public function welcome(){

        return view('admin.index.welcome');
    }


    //上传文件到七牛云
    public function upload($path,Request $request){
        $disk = \Storage::disk('qiniu');

        $file=$request->file->getPathName();
        $content=file_get_contents($file); //获取文件的内容 二进制
//        $content=get($file); //获取文件的内容 二进制
        $name=substr(bin2hex(random_bytes(ceil(32/2))),0,32);//基于时间戳生成的唯一文件名
        $filename=$path.'/'.$name.'.'.$request->file->extension();
        $res=$disk->put($filename,$content);      //上传文件，$contents 二进制文件流

        //返回文件名到模板中
        if($res){
            return ['status'=>'success','file'=>config('filesystems.disks.qiniu.domain').'/'.$filename];
        }else{
            return ['status'=>'error'];
        }
    }

    //删除原有的图片
    public function del_upload(Request $request){
        $disk = \Storage::disk('qiniu');
        $old=$request->input('avatar'); //获取原有的文件路径
        $domain=config('filesystems.disks.qiniu.domain').'/'; //获取七牛云保存图片域名
//        $old=str_replace('http','https',$old);

        if($old) {
            $old = str_replace($domain,'', $old);//删除不需要域名  替换为空
            $res=$disk->delete($old); //删除
            if($res){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','old'=>$old];
            }
        }

    }
}
