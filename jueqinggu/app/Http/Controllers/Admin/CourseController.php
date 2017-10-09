<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Course;
use App\Http\Models\Profession;
use Validator;

class CourseController extends Controller
{
    public function index(Course $course)
    {
        $data = $course->get();
        $count = count($data);

        return view('admin.course.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Profession $profession)
    {
        $data['proInfo']=$profession->select('id','pro_name')->get();
        return view('admin.course.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Course $course)
    {
        if (!$request->ajax()) {
            return ['code' => 1, 'error' => ['非法请求！']];
        }
        $data = $request->all();

        //验证数据
        $rules = array(
            'pro_id' => 'required',
            'course_name'=>'required|unique:course',
            'course_desc'=>'required',
            'sort' => 'regex:/\d+/',
        );
        $message = array(
            'pro_id.required' => '所属专业不能为空',
            'course_name.required'=>'课程名称不能为空',
            'course_name.unique'=>'此课程已存在',
            'course_desc.required'=>'请填写课程描述',
            'sort.regex'=>'排序必须是数字',
        );

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }

        if($data['disabled_at']==1){
            $data['disabled_at']=date('Y-m-d H:i:s');
        }else{
            $data['disabled_at']=null;
        }

        //添加数据
        $res = $course->create($data);
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
    public function edit(Role $role)
    {
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

        $course=new Course;
        $ids=explode(',',$id);

        //批量删除
        if(is_array($ids)){
            $res=0;
            foreach($ids as $v){
                $res+=$course->where('id',$v)->delete();
            }
            if($res>0){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','code'=>2];
            }
        }else{ //单个删除
            $res=$course->where('id',$id)->delete();
        }

        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','code'=>1];
        }

    }


    //ajax 获取所有数据
    public function ajax_list(Request $request,Course $couse){
        if($request->ajax()){
            $data=$couse->with('profession')->select('id','pro_id','course_name','course_desc','sort','note','content','disabled_at','created_at')->get();
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
}
