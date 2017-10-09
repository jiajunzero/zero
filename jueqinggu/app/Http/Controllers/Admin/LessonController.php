<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Lesson;
use App\Http\Models\Member;
use App\Http\Models\Course;
use App\Http\Models\Profession;
use Validator;
class LessonController extends Controller
{
    public function index(Lesson $lesson)
    {

        $data = $lesson->get();
        $count = count($data);

        return view('admin.lesson.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Member $member,Course $course,Profession $pofesssion)
    {

        //课程信息
        $data['course']=$course->select('id','course_name')->get();

        if($request->ajax()){
            //对应课程的授课老师
            $course_id=$request->get('_id');
            $pro_id=$course->find($course_id)->pro_id;
            $teacher_ids=$pofesssion->find($pro_id)->teacher_ids;

            $teacher=explode(',',$teacher_ids);
            $teachers=$member->select('id','nickname')->whereIn('id',$teacher)->get();
            return ['teachers'=>$teachers];

        }

        return view('admin.lesson.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminat            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
    e\Http\Response
     */
    public function store(Request $request, lesson $lesson)
    {

        $data = $request->all();

        //验证数据
        $rules = array(
            'lesson_name' => 'required|unique:lesson',
            'course_id' => 'required',
            'teacher' =>'required',
            'sort' =>'numeric',

        );

        $message = array(
            'lesson_name.required' => '课时名称不能为空',
            'lesson_name.unique' => '课时已存在',
            'teacher.required' => '请选择授课老师',
            'sort.numeric' =>'排序必须是数字',
        );


        if($data['disabled_at']==1){
            $data['disabled_at']=date('Y-m-d H:i:s');
        }else{
            $data['disabled_at']=null;
        }

        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }


        //添加数据
        $res = $lesson->create($data);
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
    public function ajax_list(Request $request,Lesson $lesson,Member $member){
        if($request->ajax()){
            $data=$lesson->with('course')->select('id','course_id','lesson_name','cover_img','video_address','lesson_desc','lesson_time','teacher','sort','note','disabled_at','created_at')->get();

            //根据老师的id查出对应的昵称
            $data->each(function($item,$key)use($member){
                if($item->teacher){
                    $item->teacher= $member->find($item->teacher)->nickname;
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
}
