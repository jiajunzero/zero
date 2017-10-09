@extends('admin.common')
@section('title')课时列表@endsection

@section('body')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 课时管理 <span class="c-gray en">&gt;</span> 课时列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    {{--<div class="text-c">--}}
        {{--<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">--}}
        {{--<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>--}}
    {{--</div>--}}
    <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加课时','{{url('admin/lesson/create')}}','1100','')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加课时</a></span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
    <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr>
            <th scope="col" colspan="12" style="text-align: center;font-size:20px">课时列表</th>
        </tr>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="30">ID</th>
                <th width="120">课时名称</th>
                <th width="120">所属课程</th>
                <th width="150">封面图片</th>
                <th width="150">视频</th>
                <th width="100">课时(小时)</th>
                <th width="90">授课老师</th>
                <th width="40">排序</th>
                <th width="100">禁用状态</th>
                <th width="160">创建时间</th>
                <th width="80">操作</th>
            </tr>
        </thead>
        <tbody>
            {{--<tr class="text-c">--}}
                {{--<td><input type="checkbox" value="1" name=""></td>--}}
                {{--<td>1</td>--}}
                {{--<td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','360','400')">zhangsan</u></td>--}}
                {{--<td>张三</td>--}}
                {{--<td>男</td>--}}
                {{--<td>14000000000</td>--}}
                {{--<td>admin@mail.com</td>--}}
                {{--<td class="text-l">超级</td>--}}
                {{--<td>2014-6-11 11:11:42</td>--}}
                {{--<td class="td-status"><span class="label label-success radius">已启用</span></td>--}}
                {{--<td class="td-manage"><a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-add.html','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','change-password.html','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a> <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>--}}
            {{--</tr>--}}
        </tbody>
    </table>
    </div>
</div>


@endsection
@section('script')

<script type="text/javascript" src="{{asset('back')}}/lib/laypage/1.2/laypage.js"></script>

<script type="text/javascript">
$(function(){
    $('.table-sort').DataTable({
        //设置每一页的数据量
        'lengthMenu':[[10,5,20,50,-1],[10,5,20,50,'全部']],
        'paging':true,  //是否显示分页
        'info':true,   //分页辅助信息
        'searching':true,  //搜索框
        'ordering':true,  //排序
        'order':[[1,'desc']],  //默认列下标为1的升序
        'stateSave':false,  //是否保存插件使用状态
        'columnDefs':[{
            'targets':[0,-1,2,4,5,7],  //不参与排序的列
            'orderable':false
        }],
        'processing':true,   //显示数据在处理中的状态
        'serveSide':true,   //是否开启服务端
        'ajax':{
            'url':"{{url('admin/lesson/ajax_list')}}",
            'type':'POST',
            'headers': { 'X-CSRF-TOKEN' : "{{ csrf_token() }}" }
        },
        "columns": [
            {'data':'a',"defaultContent":" "},
            {'data':'id',"defaultContent":' '},
            {'data':'lesson_name',"defaultContent":" "},
            {'data':'course.course_name',"defaultContent":''},
            {'data':'cover_img',"defaultContent":''},
            {'data':'video_address',"defaultContent":' '},
            {'data':'lesson_time',"defaultContent":" "},
            {'data':'teacher',"defaultContent":' '},
            {'data':'sort',"defaultContent":' ','className':"td-manage"},
            {'data':'disabled_at',"defaultContent":' ','className':'td-status'},
            {'data':'created_at',"defaultContent":' ','className':"td-manage"},
            {'data':'cz',"defaultContent":' ','className':"td-manage"},
        ],

        "createdRow":function(row,data,dataIndex){

            $(row).addClass('text-c');
            $(row).find('td:eq(4)').html('<img src="'+data.cover_img+'" width=100/>');
            $(row).find('td:eq(5)').html('<div class="btn btn-primary radius" id="player_video">播放</div>');
            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
            $(row).find('td:eq(9)').html(data.disabled_at?data.disabled_at:'启用中');
//            $(row).find('td:eq(9)').html(_html);
            $(row).find('td:eq(-1)').html(' <a title="编辑" href="javascript:;" onclick="member_edit(\'编辑\',\'/admin/admin/'+data.id+'/edit'+'\',\''+data.id+'\',\'1000\',\'\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="member_del(this,\''+data.id+'\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>');

            $(document).on('click','#player_video',function(){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['600px', '500px'], //宽高
                    title:'播放视频',
                    content: '<video src="http://mp4.vjshi.com/2017-05-01/83565d85c28ee603e2c6daf8ff618834.mp4" controls="controls" style="width:90%; position: fixed; left:0; top:0; bottom:0; right:0; margin:auto; " autoplay="autoplay">播放中</video>'
            });
            })

        }
    });
//    $('.table-sort tbody').on( 'click', 'tr', function () {
//        if ( $(this).hasClass('selected') ) {
//            $(this).removeClass('selected');
//        }
//        else {
//            table.$('tr.selected').removeClass('selected');
//            $(this).addClass('selected');
//        }
//  });

});
/*用户-添加*/
function member_add(title,url,w,h){
    layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
    layer_show(title,url,w,h);
}

/*用户-编辑*/
function member_edit(title,url,id,w,h){
    layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
    layer_show(title,url,w,h);  
}
/*用户-删除*/
function member_del(obj,id){
    layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){

        var url='/admin/admin/'+id;
        var data={
            '_method':'delete',
            '_token':'{{csrf_token()}}'
        };

        $.post(url,data,function(msg){
            if(msg.status=='success'){
                $(obj).parents("tr").remove();
                location.reload();
                layer.msg('已删除!',{icon:1,time:1000});
//                location.reload();
            }else{
                layer.msg('删除失败!',{icon:2,time:1000});
            }
        },'json');
        //此处请求后台程序，下方是成功后的前台处理……

    });
}

//批量删除
function datadel(){
    layer.confirm('角色删除须谨慎，确认要删除吗？',function(index) {
        var ids = new Array();
        $('input:checked').each(function (k, v) {
            ids[k] = $(this).val();
        });
        ids=ids.join(',');
//        console.log(ids);
        var url = '/admin/admin/'+ids;
        var data = {
            '_method':'delete',
            '_token':'{{csrf_token()}}',
        };
        $.post(url, data, function (msg) {
            if(msg.status=='success'){
                $('input:checked').parents("tr").remove();
                layer.msg('批量删除成功!',{icon:1,time:3000});
                location.reload();
            }else{
                layer.msg('删除失败!',{icon:2,time:1000});
            }
        }, 'json');
    });
}




</script> 
@endsection