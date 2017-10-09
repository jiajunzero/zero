<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Admin;
use App\Http\Models\Role;
use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Admin $admin)
    {

        $data = $admin->get();
        $count = count($data);

        return view('admin.admin.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $data['info']=$role->get();
        return view('admin.admin.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminat            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
    e\Http\Response
     */
    public function store(Request $request, Admin $admin)
    {

        $data = $request->all();

        //验证数据
        $rules = array(
            'username' => 'required|unique:admin',
            'password' => 'required|between:6,16|same:password2',
            'phone' => 'required|unique:admin|regex:/\d{11}/',
            'email' => 'required|unique:admin|email',
        );

        $message = array(
            'username.required' => '管理员账号不能为空',
            'username.unique' => '此管理员已存在',
            'password.required' => '密码不能为空',
            'password.between' => '密码长度在6-16之间',
            'password.same' => '两次输入的密码不一致',
            'phone.required' => '手机号码不能为空',
            'phone.unique' => '手机号码已存在',
            'phone.regex' => '手机号码格式不正确',
            'email.required' => '邮箱不能为空',
            'email.unique' => '邮箱已存在',
            'email.email' => '邮箱格式不正确',
        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }
        $data['password']=bcrypt($data['password']);
        $data['login_ip']=$request->server()['REMOTE_ADDR'];
        //上传头像
//        $avatar_path=date('Y-m-d').'/';
//        $path=public_path().'/uploads/avatar/'.$avatar_path;
//
//        if(!file_exists($path)){
//            mkdir($path,0755,true);
//        }
//
//        $file_name=sha1(microtime(true)); //文件名 微妙时间戳
//
//        $file_name=$file_name.'.'.$data['avatar']->extension();
//        $res=$data['avatar']->move($path,$file_name);
//        $data['avatar']=$avatar_path.$res->getFileName();


//        $data['avatar']=str_replace('https','http',$data['avatar']);
        //添加数据
        $res = $admin->create($data);
        if ($res->id) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'fail', 'code' => 3, 'error' => '添加失败'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin,Role $role)
    {
        $data['info'] = $admin;

        $data['role_list']=$role->select('id','role_name')->get();

        return view('admin.admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        if(!$request->ajax()){
            return ['code' => 1, 'error' => ['非法请求！']];
        }
        $data = $request->all();
//        dump($data);die;
        //验证数据
        $rules = array(
            'username' => 'required|unique:admin,username,'.$admin->id,
            'phone' => 'required|regex:/\d{11}/|unique:admin,phone,'.$admin->id,
            'email' => 'required|email|unique:admin,email,'.$admin->id,
            
        );

        $message = array(
            'username.required' => '管理员账号不能为空',
            'phone.required' => '手机号不能为空',
            'email.required' => '邮箱不能为空',
            'username.unique' => '此管理员已存在',
            'phone.unique' => '手机号码已存在',
            'phone.regex' => '手机号码格式不正确',
            'email.unique' => '邮箱已存在',
            'email.email' => '邮箱格式不正确',
        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }

        $data['login_ip']=$request->server()['REMOTE_ADDR'];

        //修改数据
        $res = $admin->update($data);

        if($res) {
            return ['status' => 'success'];
        }else{
            return ['status' => 'fail', 'code' => 3, 'error' => '编辑失败'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!request()->ajax()){
            return ['code'=>404,'error'=>'非法请求！'];
        }

        $admin=new Admin;
        $ids=explode(',',$id);

        //批量删除
        if(is_array($ids)){
            $res=0;
            foreach($ids as $v){
                $res+=$admin->where('id',$v)->delete();
            }
            if($res>0){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','code'=>2];
            }
        }else{ //单个删除
            $res=$admin->where('id',$id)->delete();
        }

        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','code'=>1];
        }

    }

    //ajax 获取所有数据
    public function ajax_list(Request $request,Admin $admin){
        if($request->ajax()){
            $data=$admin->with('role')->select('id', 'role_id','username', 'nickname', 'avatar', 'phone', 'email', 'sex', 'note', 'login_ip', 'login_number', 'disabled_at','created_at')->get();

//            dump($data);die;
            $cnt=count($data);

            //dataTabeles 插件要求返回的数据
            $info=array(
                'draw'=>$request->get('draw'),  //ajax发送过来的参数
                'recordsTotal'=>$cnt,   //数据总量
                'recordsFiltered'=>$cnt,
                'data'=>$data
            );
//            dump($info);die;
            return $info;
        }

    }

    //管理员详情页
    public function admin_show(Request $request,Admin $admin){

        $id=$request->get('id');

        $data['info']=$admin->find($id);
        return view('admin.admin.admin_show',$data);
    }

    //修改密码
    public function change_password(Request $request,Admin $admin){
        if($request->isMethod('post')){
            $data=$request->only('id','password','password2');
            if($data['password']){
                $rules = array(
                    'password' => 'between:6,16|same:password2',
                );
                $message=array(
                    'password.between'=>'密码长度6-16位之间',
                    'password.same'=>'两次输入的密码不一致',
                );

                $val=Validator::make($data,$rules,$message);
                if($val->fails()){
                    return ['status' => 'fail', 'code' => 1, 'error' => $val->messages()->first()];
                }

                $data['passwrod']=bcrypt($data['password']);
                $res= $admin->where('id',$data['id'])->update(['password'=>$data['password']]);
                if($res){
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'error','code'=>2,'error'=>'修改失败'];
                }
            }else{
                return ['status'=>'error','code'=>3,'error'=>'未修改'];
            }

        }

        $id=$request->get('id');
        $row=$admin->find($id);
        return view('admin.admin.change_password',$row);
    }

    //禁用状态
    public function admin_stop(Request $request,Admin $admin){
        $id=$request->get('id');
        $res=$admin->where('id',$id)->update(['disabled_at'=>0]);
        if($res){
            return ['status'=>'success'];
        }else {
            return ['status' => 'error', 'code' => 1];
        }
    }

    //启用状态
    public function admin_start(Request $request,Admin $admin){
        $id=$request->get('id');
        $res=$admin->where('id',$id)->update(['disabled_at'=>1]);
        if($res){
            return ['status'=>'success'];
        }else {
            return ['status' => 'error', 'code' => 1];
        }
    }


}
