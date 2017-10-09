@extends('admin.common')
@section('body')
<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="{{str_replace('https','http',$info->avatar)}}" alt="">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18">{{$info->nickname}}</span> <span class="pl-10 f-12">角色：{{$info->role_id}}</span></dt>
    {{--<dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd>--}}
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">性别：</th>
        <td>{{$info->sex==1?'女':'男'}}</td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td>{{$info->phone}}</td>
      </tr>
      <tr>
        <th class="text-r">邮箱：</th>
        <td>{{$info->email}}</td>
      </tr>
      <tr>
        <th class="text-r">登录IP：</th>
        <td>{{$info->login_ip}}</td>
      </tr>
      <tr>
        <th class="text-r">加入时间：</th>
        <td>{{$info->created_at}}</td>
      </tr>
      <tr>
        <th class="text-r">修改时间：</th>
        <td>{{$info->updated_at}}</td>
      </tr>
      <tr>
        <th class="text-r">备注：</th>
        <td>{!!$info->note!!}</td>
      </tr>

    </tbody>
  </table>
</div>
@endsection