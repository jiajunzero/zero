@extends('admin.common')
@section('title')权限管理@endsection

@section('body')
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 权限管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加权限','{{url("admin/auth/create")}}','1000')"><i class="Hui-iconfont">&#xe600;</i> 添加权限</a> </span> <span class="r">共有数据：<strong><span id="num"></span></strong> {{$count}}条</span> </div>
	<table class="table table-border table-bordered table-hover table-bg" id="datatable">
		<thead>
			<tr>
				<th scope="col" colspan="9" style="text-align: center;font-size:20px">权限管理</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" value="0" name=""></th>
				<th width="40">ID</th>
				<th width="100">权限名称</th>
				<th width="100">父类权限</th>
				<th>控制器方法</th>
				<th width="150">路由地址</th>
				<th width="100">是否作为菜单</th>
				<th width="200">创建时间</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
			{{--<tr class="text-c">--}}
				{{--<td><input type="checkbox" value="" name=""></td>--}}
				{{--<td>1</td>--}}
				{{--<td>超级管理员</td>--}}
				{{--<td><a href="#">admin</a></td>--}}
				{{--<td>拥有至高无上的权利</td>--}}
				{{--<td class="f-14"><a title="编辑" href="javascript:;" onclick="admin_role_edit('权限编辑','admin-role-add.html','1')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_role_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>--}}
			{{--</tr>--}}
		</tbody>
	</table>
</div>

@endsection
@section('script')
<script type="text/javascript" src="{{asset('back')}}/lib/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript">
/*管理员-权限-添加*/
function admin_role_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-编辑*/
function admin_auth_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-权限-删除*/
function admin_auth_del(obj,id){
	layer.confirm('权限删除须谨慎，确认要删除吗？',function(index){

	    var url='/admin/auth/'+id;
	    var data={
	        '_method':'delete',
			'_token':'{{csrf_token()}}'
		};

	    $.post(url,data,function(msg){
			if(msg.status=='success'){
                $(obj).parents("tr").remove();
                layer.msg('已删除!',{icon:1,time:1000});
                location.reload();
			}else{
                layer.msg('删除失败!',{icon:2,time:1000});
			}
		},'json');
		//此处请求后台程序，下方是成功后的前台处理……

	});
}

//批量删除
function datadel(){
    layer.confirm('权限删除须谨慎，确认要删除吗？',function(index) {
        var ids = new Array();
        $('input:checked').each(function (k, v) {
            ids[k] = $(this).val();
        });
		 ids=ids.join(',');
//        console.log(ids);
        var url = '/admin/auth/'+ids;
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

$('#datatable').DataTable({
    //设置每一页的数据量
	'lengthMenu':[[10,20,50,-1],[10,20,50,'全部']],
	'paging':true,  //是否显示分页
	'info':true,   //分页辅助信息
	'searching':true,  //搜索框
	'ordering':true,  //排序
	'order':[[1,'desc']],  //默认列下标为1的升序
	'stateSave':false,  //是否保存插件使用状态
	'columnDefs':[{
	    'targets':[0,-1,2,3,4,5],  //不参与排序的列
		'orderable':false
	}],
	'processing':false,   //显示数据在处理中的状态
	'serveSide':true,   //是否开启服务端
	'ajax':{
	    'url':"{{url('admin/auth/ajax_list')}}",
	    'type':'POST',
        'headers': { 'X-CSRF-TOKEN' : "{{ csrf_token() }}" }
	},
    "columns": [
        {'data':'a',"defaultContent":" "},
        {'data':'id',"defaultContent":" "},
        {'data':'auth_name',"defaultContent":' '},
        {'data':'auth_pid',"defaultContent":" "},
        {'data':'ca',"defaultContent":''},
        {'data':'auth_address',"defaultContent":' '},
        {'data':'is_menu',"defaultContent":" "},
        {'data':'created_at',"defaultContent":' '},
        {'data':'t',"defaultContent":' '},
    ],

    "createdRow":function(row,data,dataIndex){
//        $(row).find('td:eq(3)').html(data.auth_pid==data.auth_id?data.auth_name:'');
        $(row).find('td:eq(4)').html(data.auth_controller+'@'+data.auth_action);
		$(row).find('td:eq(6)').html(data.is_menu==1?'是':'否');
	    $(row).addClass('text-c');
	    $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" name="del[]">');
	    $(row).find('td:eq(-1)').html('<a title="编辑" href="javascript:;" onclick="admin_auth_edit(\'权限编辑\',\'/admin/auth/'+data.id+'/edit\',\''+data.id+'\')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a title="删除" href="javascript:;" onclick="admin_auth_del(this,\''+data.id+'\')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>');
	}
});
</script>
@endsection