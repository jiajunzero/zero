<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Auth;
//use App\Http\Models\Role;
use Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Auth $auth)
    {

        $data = $auth->get();
        $count = count($data);

        return view('admin.auth.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Auth $auth)
    {
        $data=$auth->get();

        $data=$data->toArray();
        $data['authList']=$auth->_getTree($data);

        return view('admin.auth.create',$data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminat            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
    e\Http\Response
     */
    public function store(Request $request, auth $auth)
    {

        $data = $request->all();

        //验证数据
        $rules = array(
            'auth_name' => 'required|unique:auth',
        );

        $message = array(
            'auth_name.required' => '权限名称不能为空',
            'auth_name.unique' => '权限已存在',
        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }

        //添加数据
        $res = $auth->create($data);
        if ($res) {
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
    public function edit(auth $auth)
    {
        $data['info']=$auth;
        $data['auth_list']=$auth->select('id','auth_name','auth_pid')->get();

        return view('admin.auth.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, auth $auth)
    {
        if(!$request->ajax()){
            return ['code' => 1, 'error' => ['非法请求！']];
        }
        $data = $request->all();
//        dump($data);die;
        //验证数据
        $rules = array(
            'auth_name' => 'required|unique:auth,auth_name,'.$auth->id,
        );

        $message = array(
            'auth_name.required' => '权限名称不能为空',
            'auth_name.unique' => '权限已存在'
        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }


        //修改数据
        $res = $auth->update($data);

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

        $auth=new auth;
        $ids=explode(',',$id);

        //批量删除
        if(is_array($ids)){
            $res=0;
            foreach($ids as $v){
                $res+=$auth->where('id',$v)->delete();
            }
            if($res>0){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','code'=>2];
            }
        }else{ //单个删除
            $res=$auth->where('id',$id)->delete();
        }

        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','code'=>1];
        }

    }

    //ajax 获取所有数据
    public function ajax_list(Request $request,Auth $auth){
        if($request->ajax()){
            $data=$auth->select('id','auth_pid', 'auth_name', 'auth_action', 'auth_controller', 'auth_address', 'is_menu','created_at')->get();
//            $data.-$auth->select('count(*) as count')->get();
//            $data['avatar']=str_replace('https','http',$data['avatar']);

            $data->each(function($item,$key) use ($auth){
                if($item->auth_pid=='0'){
                    $item->auth_pid='*';
                }else{
                    $item->auth_pid=$auth->where('id',$item->auth_pid)->first()->auth_name;
                }
            });
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



}
