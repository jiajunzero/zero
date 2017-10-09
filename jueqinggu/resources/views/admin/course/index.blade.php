@extends('admin.common')
@section('title')课程列表@endsection

@section('body')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 课程管理 <span class="c-gray en">&gt;</span> 课程列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	{{--<div class="text-c">--}}
		{{--<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">--}}
		{{--<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>--}}
	{{--</div>--}}
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="course_add('添加课程','{{url('admin/course/create')}}','1100','')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加课程</a></span> <span class="r">共有数据：<strong>{{$count}}</strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
        <tr>
            <th scope="col" colspan="12" style="text-align: center;font-size:20px">课程列表</th>
        </tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="30">ID</th>
				<th width="140">课程名称</th>
				<th width="150">所属专业</th>
				<th width="100">禁用状态</th>
				<th width="90">排序</th>
				<th width="150">创建时间</th>
				<th width="80">操作</th>
			</tr>
		</thead>
		<tbody>

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
            'targets':[0,2,3,7],  //不参与排序的列
            'orderable':false
        }],
        'processing':true,   //显示数据在处理中的状态
        'serveSide':true,   //是否开启服务端
        'ajax':{
            'url':"{{url('admin/course/ajax_list')}}",
            'type':'post',
            'headers': { 'X-CSRF-TOKEN' : "{{csrf_token()}}" }
        },
        "columns": [
            {'data':'a',"defaultContent":" "},
            {'data':'id',"defaultContent":' '},
            {'data':'course_name',"defaultContent":" "},
            {'data':'profession.pro_name',"defaultContent":''},
            {'data':'disabled_at',"defaultContent":''},
            {'data':'sort',"defaultContent":' '},
            {'data':'created_at',"defaultContent":" "},
            {'data':'cz',"defaultContent":' '},

        ],

        "createdRow":function(row,data,dataIndex){

            $(row).addClass('text-c');
//            $(row).find('td:eq(7)').html(});
            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
            $(row).find('td:eq(4)').html(data.disabled_at?data.disabled_at:'启用中...');
            $(row).find('td:eq(-1)').html(' <a title="编辑" href="javascript:;" onclick="member_edit(\'编辑\',\'/admin/admin/'+data.id+'/edit'+'\',\''+data.id+'\',\'1000\',\'\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="course_del(this,\''+data.id+'\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>');
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
//	});

});
/*用户-添加*/
function course_add(title,url,w,h){
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
function course_del(obj,id){
    layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){

        var url='/admin/course/'+id;
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
    layer.confirm('删除需谨慎，确认要删除吗？',function(index) {
        var ids = new Array();
        $('input:checked').each(function (k, v) {
            ids[k] = $(this).val();
        });
        ids=ids.join(',');
//        console.log(ids);
        var url = '/admin/course/'+ids;
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