<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\LiveCourse;
use App\Http\Models\LiveStream;
use App\Http\Models\Profession;
use App\Http\Models\Member;
use Validator;
class LiveCourseController extends Controller
{
    public function index(LiveCourse $livecourse)
    {
        $data = $livecourse->get();
        $count = count($data);

        return view('admin.livecourse.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(LiveStream $livestream , Profession $profession)
    {

        $data['stream']=$livestream->select('id','stream_name')->get();
        $data['pro']=$profession->select('id','pro_name')->get();
        return view('admin.livecourse.create',$data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,LiveCourse $livecourse)
    {
        if (!$request->ajax()) {
            return ['code' => 1, 'error' => ['非法请求！']];
        }
        $data = $request->all();

        if(strtotime($data['start_at'])>strtotime($data['end_at'])){
            return ['status'>'fail','error'=>'直播开始时间不能大于结束时间'];
        }


        //验证数据
        $rules = array(
            'pro_id' => 'required',
            'course_name'=>'required|unique:live_course',
            'stream_id'=>'required',
            'teacher_id'=>'required',
            'sort' => 'numeric',
            'start_at' => 'required',
            'end_at' => 'required',
        );
        $message = array(
            'pro_id.required' => '所属专业不能为空',
            'course_name.required'=>'课程名称不能为空',
            'course_name.unique'=>'此课程已存在',
            'teacher_id.required'=>'请选择授课老师',
            'sort.numeric'=>'排序必须是数字',
            'start_at' => '请输入直播开始时间',
            'end_at' => '请输入直播结束时间',
        );


        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }


        //添加数据
        $res = $livecourse->create($data);
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

        $livecourse=new livecourse;
        $ids=explode(',',$id);

        //批量删除
        if(is_array($ids)){
            $res=0;
            foreach($ids as $v){
                $res+=$livecourse->where('id',$v)->delete();
            }
            if($res>0){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','code'=>2];
            }
        }else{ //单个删除
            $res=$livecourse->where('id',$id)->delete();
        }

        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','code'=>1];
        }

    }


    //ajax 获取所有数据
    public function ajax_list(Request $request,LiveCourse $livecourse){
        if($request->ajax()){
            $data=$livecourse->with('profession')->with('member')->with('stream')->select('id','course_name','stream_id','pro_id','teacher_id','cover_img','start_at','end_at','sort','note','created_at')->get();
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

    //选择授课老师弹框
    public function select_teacher(){

        return view('admin.livecourse.select_teacher');
    }

    //弹出推流地址和拉流地址
    public function create_addr(LiveStream $stream,LiveCourse $livecourse,Member $member){
        $space= 'php-25';  //直播空间名
        $stream_name=$stream->stream_name; //流名称
        $expire_at =time()+3600; //禁播时间

        $path="/$space/$stream_name/?e=$expire_at";//生成推流凭证

        $ak=config('filesystems.disks.qiniu.access_key');
        $sk=config('filesystems.disks.qiniu.secret_key');

        $qiniu= new \Qiniu\Auth($ak,$sk);
        $token=$qiniu->sign($path);

        //推流地址 ：  rtmp://pili-publish.www.sinsea.cn/$space
        // 推流名称  $stream_name?e=$expire_at$token=$token

        //播放地址   rtmp://pili-live-rtmp.www.sinsea,cn/$space/$stream_name

        $course=$livecourse->where('stream_id',$stream->id)->get();
        $data['course_name']=$course[0]['course_name'];
        $data['start_at']=$course[0]['start_at'];
        $data['end_at']=$course[0]['end_at'];
        $memInfo=$member->find($course[0]['teacher_id']);
        $data['teacher']=$memInfo['nickname'];

        return view('admin.livecourse.create_addr',$data);

    }

    //发送短信和邮件
    public function send(){
        if(request()->ajax()){
            $send=request()->get('send');
            if($send=='sms'){ //发送短信

                $to='13432609808';
                $content='在线直播平台测试';
                $res= \PhpSms::make()->to($to)->content($content)->send();

                // $template  短信模板
                //  data=  [
                //   '模板占位符1'=>'替换的内容1'
                //   '模板占位符2'=>'替换的内容2'
                //]
//              $res= \PhpSms::make()->to($t0)->template($template)->data($data)->send();

                if($res['success']==true){
                    return ['status'=>'success'];
                }else{
                    return ['status'=>'fail'];
                }

            }else{
                //发送邮件

                $centent='在线直播平台测试邮件';
                $res2=\Mail::raw($centent,function($mail){
                    $mail->to('2321381942@qq.com');
                    $mail->subject('直播通知');
                });

                return ['status'=>'success'];

            }
        }
    }

}
