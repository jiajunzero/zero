<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Role;
use App\Http\Models\Auth;
use Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {

        $data = $role->get();
        $count = count($data);

        return view('admin.role.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Auth $auth)
    {
        $data['topAuth']=$auth->where('auth_pid','0')->get(); //顶级权限
        $data['sonAuth']=$auth->where('auth_pid','!=','0')->get();  //子级权限
        return view('admin.role.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role,Auth $auth)
    {
        if (!$request->ajax()) {
            return ['code' => 1, 'error' => ['非法请求！']];
        }
        $data = $request->all();

        //验证数据
        $rules = array(
            'role_name' => 'required|unique:role'
        );
        $message = array(
            'role_name.required' => '角色名称不能为空',
            'role_name.unique' => '角色名称已存在'
        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }

        //添加权限
        $data['role_auth_ids']=$request->auth_ids; //获取权限列表id
        //查询出对应的控制器方法等
        $authList=$auth->select('auth_controller','auth_action','auth_address','is_menu')->where('auth_pid','!=',0)->whereIn('id',$request->auth_ids)->get();

        $data['role_auth_ac']=[];
        $data['role_auth_addr']=[];
        foreach($authList as $item){
            //保存所有对应权限的控制器跟方法
            $data['role_auth_ac'][]=['controller'=>$item->auth_controller,'action'=>$item->auth_action];
            if($item->is_menu==1){
                //保存作为菜单显示的路由地址
                $data['role_auth_addr'][]=$item->auth_address;
            }
        }

        //添加数据
        $res = $role->create($data);
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
    public function edit(Role $role,Auth $auth)
    {

        $data['topAuth']=$auth->where('auth_pid','0')->get(); //顶级权限
        $data['sonAuth']=$auth->where('auth_pid','!=','0')->get();  //子级权限
        $data['roleInfo'] = $role;
        return view('admin.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if(!$request->ajax()){
            return ['code' => 1, 'error' => ['非法请求！']];
        }
        $data = $request->all();

        //验证数据
        $rules = array(
            'role_name' => 'required|unique:role,role_name,'.$role->id  //忽略当前记录的值
        );
        $message = array(
            'role_name.required' => '角色名称不能为空',
            'role_name.unique' => '角色名称已存在'
        );

        if(!isset($data['role_auth_ids'])){
            return ['status' => 'fail', 'code' => 4, 'error' =>'请选择权限'];

        }


        $val = Validator::make($data, $rules, $message);

        if ($val->fails())
        {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }

        //添加数据
        $res = $role->update($data);
        if ($res) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'fail', 'code' => 3, 'error' => '修改失败'];
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

        $role=new Role;
        $ids=explode(',',$id);

        //批量删除
        if(is_array($ids)){
            $res=0;
            foreach($ids as $v){
                $res+=$role->where('id',$v)->delete();
            }
            if($res>0){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','code'=>2];
            }
        }else{ //单个删除
            $res=$role->where('id',$id)->delete();
        }

        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','code'=>1];
        }

    }


    //ajax 获取所有数据
    public function ajax_list(Request $request,Role $role){
        if($request->ajax()){
            $data=$role->select('id','role_name','note','created_at')->get();
//            $data.-$role->select('count(*) as count')->get();
            $cnt=count($data);

            //dataTabeles 插件要求返回的数据
            $info=array(
                'draw'=>$request->get('draw'),  //ajax发送过来的参数
                'recordsTotal'=>$cnt,   //数据总量
                'recordsFiltered'=>$cnt,
                'data'=>$data
            );

            return $info;
        }

    }


//    public function restore(Role $role){
//        $res=$role->restore();
//        if($res){
//            dump('ok');
//        }else{
//            dump('error');
//        }
//    }




}
