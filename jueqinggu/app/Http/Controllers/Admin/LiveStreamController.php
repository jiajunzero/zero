<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\LiveStream;
use Validator;

class LiveStreamController extends Controller
{
    public function index(LiveStream $livestream)
    {
        $data = $livestream->get();
        $count = count($data);

        return view('admin.livestream.index', ['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.livestream.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,LiveStream $livestream)
    {
        if (!$request->ajax()) {
            return ['code' => 1, 'error' => ['非法请求！']];
        }
        $data = $request->all();

        //验证数据
        $rules = array(
            'stream_name'=>'required|unique:live_stream',
            'status'=>'required',

        );

        $message = array(
            'stream_name.required' => '流名称不能为空',
            'stream_name.unique'=>'流名称已存在',
            'status.required'=> '请选择禁播状态',

        );


        $val = Validator::make($data, $rules, $message);

        if ($val->fails()) {
            return ['status' => 'fail', 'code' => 2, 'error' => $val->messages()->first()];
        }


        //添加数据
        $res = $livestream->create($data);
        if ($res->id) {

            //创建流
            $method='POST';
            $path='/v2/hubs/php-25/streams';
            $host='pili.qiniuapi.com';
            $body=json_encode(['key'=>$data['stream_name']]); //流名称
            $qiniutoken=$this->getQiniuToken($method,$path,$host,$body);

            //发送请求包
            $client = new \GuzzleHttp\Client([
                'base_uri'=>'http://'.$host
            ]);

            $response = $client->post($path,[
                'headers'=>[ //请求头
                    'Authorization'=>$qiniutoken,  //请求鉴权
                    ' Content-Type'=>'application/json',
                    'Accept-Encoding'=> 'gzip',
                    'Content-Length' => strlen($body),
                    'User-Agent' => 'pili-sdk-go/v2 go1.6 darwin/amd64',
                ],
                'body' =>$body  //发送内容
            ]);

            $code=$response->getStatusCode();


//            if($code!=200){
//                $res->delete();
//                return ['status'=>'fail','error'=>'直播流名称重复'];
//            }

            return ['status' => 'success'];
        } else {
            return ['status' => 'fail', 'code' => 3, 'error' => '添加失败'];
        }
    }

    //生成七牛云的请求鉴权
    private function getQiniuToken($method,$path,$host,$body){
       $contentType='application/json';
       $token="$method $path\nHost:$host\nContent-Type: $contentType\n\n$body";
       $ak=config('filesystems.disks.qiniu.access_key');
       $sk=config('filesystems.disks.qiniu.secret_key');
       $auth=new \Qiniu\Auth($ak,$sk);
       $qiniutoken='Qiniu '. $auth->sign($token);  //利用七牛的编码方法
       return $qiniutoken;

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

        $livestream=new livestream;
        $ids=explode(',',$id);

        //批量删除
        if(is_array($ids)){
            $res=0;
            foreach($ids as $v){
                $res+=$livestream->where('id',$v)->delete();
            }
            if($res>0){
                return ['status'=>'success'];
            }else{
                return ['status'=>'error','code'=>2];
            }
        }else{ //单个删除
            $res=$livestream->where('id',$id)->delete();
        }

        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','code'=>1];
        }

    }

    //ajax 获取所有数据
    public function ajax_list(Request $request,LiveStream $livestream){
        if($request->ajax()){
            $data=$livestream->select('id','stream_name','status','expired_at','created_at')->get();

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
