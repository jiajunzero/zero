<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\ProfessionCate;
use Validator;

class professionCateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProfessionCate $professionCate)
    {

        $data = $professionCate->get();

        $count = count($data);

        return view('admin.professioncate.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.professioncate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminat            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
    e\Http\Response
     */
    public function store(Request $request, ProfessionCate $professionCate)
    {

        $data = $request->all();
        //验证数据
        $rules = array(
            'cate_name' => 'required|unique:professioncate',
//            'sort' =>'digits',

        );
        $message = array(
            'cate_name.required' => '专业分类名称不能为空',
            'cate_name.unique' => '专业分类已存在',
//            'sort.digits'=>'排序必须是数字',

        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }

        //添加数据
        $res = $professionCate->create($data);
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

        $procate=new ProfessionCate;
        $ids=explode(',',$id);

        //批量删除
        if(is_array($ids)){
            $res=0;
            foreach($ids as $v){
                $res+=$procate->where('id',$v)->delete();
            }
            if($res>0){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','code'=>2];
            }
        }else{ //单个删除
            $res=$procate->where('id',$id)->delete();
        }

        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','code'=>1,'id'=>$id];
        }

    }

    //ajax 获取所有数据
    public function ajax_list(Request $request, ProfessionCate $professionCate){
        if($request->ajax()){
            $data=$professionCate->select('id','cate_name','logo','sort','created_at')->get();

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

    //管理员详情页
    public function admin_show(Request $request,Admin $admin){

        $id=$request->get('id');

        $data['info']=$admin->find($id);
        return view('admin.admin.admin_show',$data);
    }


}
