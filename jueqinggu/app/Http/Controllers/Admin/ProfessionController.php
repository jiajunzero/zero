<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Profession;
use App\Http\Models\ProfessionCate;
use App\Http\Models\Member;
use Validator;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Profession $profession)
    {

        $data = $profession->get();
        $count = count($data);

        return view('admin.profession.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProfessionCate $professionCate)
    {
        $data['cate']=$professionCate->select('id','cate_name')->get();
        return view('admin.profession.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminat            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
    e\Http\Response
     */
    public function store(Request $request, Profession $profession)
    {

        $data = $request->all();

        //验证数据
        $rules = array(
            'pro_name' => 'required|unique:profession',
            'cate_id' => 'required',
            'teacher_ids' => 'required',
            'duration' => 'required',
            'pro_desc' => 'required',
            'detail' => 'required',
            'price' => 'required|regex:/\d+/',
            'market_price' => 'regex:/\d+/',
            'expired_at'=>'required|regex:/\d+/',
        );

        $message = array(
            'pro_name.required' => '专业名称不能为空',
            'pro_name.unique' => '专业名称已存在',
            'cate_id.required' => '专业分类不能为空',
            'teacher_ids.required' => '授课老师不能为空',
            'duration.required' => '课程总时长不能为空',
            'pro_desc.required' => '专业简介不能为空',
            'detail.required' => '专业详情不能为空',
            'price.required' => '价格不能为空',
            'price.regex' => '价格必须是数字',
            'market_price.regex' => '价格必须是数字',
            'expired.regex' => '有效期必须是数字',
            'expired.required' => '有效期不能为空',

        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }


        //添加数据
        $res = $profession->create($data);
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
    public function ajax_list(Request $request,Profession $profession,Member $member){
        if($request->ajax()){
            $data=$profession->with('ProfessionCate')->select('id','cate_id','pro_name','teacher_ids','pro_desc','click','duration','expired_at','sort','price','market_price','detail','note','disabled_at','created_at')->get();

            //根据老师的id查出对应的昵称
           $data->each(function($item,$key)use($member){
              if($item->teacher_ids){
                  $teacher=explode(',',$item->teacher_ids);
                  $item->teacher_ids= $member->select('nickname')->whereIn('id',$teacher)->get();
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
//            dump($info);die;
            return $info;
        }

    }

    //选择授课老师弹框
    public function select_teacher(){

        return view('admin.profession.select_teacher');
    }

}
