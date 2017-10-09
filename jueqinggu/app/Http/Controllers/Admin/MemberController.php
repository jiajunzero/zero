<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Member;
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Member $member)
    {
        $data = $member->get();
        $count = count($data);
        return view('admin.member.index',['count'=>$count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //ajax 获取所有数据
    public function ajax_list(Request $request,Member $member)
    {
        if ($request->ajax()) {

            $data= $member->select('id', 'type_id', 'username', 'nickname', 'money', 'avatar', 'phone', 'email', 'sex', 'note', 'education', 'job', 'login_ip', 'login_number','created_at');

            //判断ajax发送的请求头是否有teacher=1
            if($request->header('teacher')==1){
                $data=$data->where('type_id',2);
            }

            $data=$data->get();
//            dump($data);die;
            $cnt = count($data);

            //dataTabeles 插件要求返回的数据
            $info = array(
                'draw' => $request->get('draw'),  //ajax发送过来的参数
                'recordsTotal' => $cnt,   //数据总量
                'recordsFiltered' => $cnt,
                'data' => $data
            );
//            dump($info);die;
            return $info;
        }
    }
}
