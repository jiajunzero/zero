@extends('admin.common')
@section('title')授课老师列表@endsection

@section('body')
<div class="page-container">
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
        <tr>
            <th scope="col" colspan="10" style="text-align: center;font-size:20px">授课老师列表</th>
        </tr>
			<tr class="text-c">
				<th width="25"><div id='sel' class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"> <a href="javascript:;" class="btn btn-primary " >提交</a></span></div></th>
				<th width="30">ID</th>
				<th width="120">账号</th>
				<th width="60">昵称</th>
				<th width="40">性别</th>
				<th width="100">手机</th>
				<th width="180">邮箱</th>
				<th width="100">余额</th>
				<th width="130">注册时间</th>

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
        'paging':false,  //是否显示分页
        'info':true,   //分页辅助信息
        'searching':false,  //搜索框
        'ordering':true,  //排序
        'order':[[1,'desc']],  //默认列下标为1的升序
        'stateSave':false,  //是否保存插件使用状态
        'columnDefs':[{
            'targets':[0,-1,2,3,5,6,8],  //不参与排序的列
            'orderable':false
        }],
        'processing':true,   //显示数据在处理中的状态
        'serveSide':true,   //是否开启服务端
        'ajax':{
            'url':"{{url('admin/member/ajax_list')}}",
            'type':'POST',
            'headers': { 'X-CSRF-TOKEN' : "{{ csrf_token() }}",'teacher':1 }
        },
        "columns": [
            {'data':'a',"defaultContent":" "},
            {'data':'id',"defaultContent":' '},
            {'data':'username',"defaultContent":" "},
            {'data':'nickname',"defaultContent":''},
            {'data':'s',"defaultContent":''},
            {'data':'phone',"defaultContent":' '},
            {'data':'email',"defaultContent":" "},
            {'data':'money',"defaultContent":' '},
            {'data':'created_at',"defaultContent":' '},

        ],

        "createdRow":function(row,data,dataIndex){

            if(data.sex==1){
                var sex='女';
            }else if(data.sex==2){
                var sex='男';
            }else{
                var sex='保密';
            }
//            console.log(data);
{{--			if(data.role_id=={{$}})--}}
            $(row).addClass('text-c');
            $(row).find('td:eq(4)').html(sex);
//            $(row).find('td:eq(8)').html(data.type_id==1?'学生':'老师');
//            $(row).find('td:eq(7)').html(});
            $(row).find('td:eq(0)').html('<input type="checkbox" value="'+data.id+'" teacher_name='+data.nickname+'  name="del[]">');
//            $(row).find('td:eq(2)').html('<u style="cursor:pointer" class="text-primary" onclick="member_show(\''+data.username+'\',\'/admin/admin_show?id='+data.id+'\',\''+data.id+'\',\'1000\',\'\')">'+data.username+'</u>');

        }
    });


$('#sel').on('click',function(){
    var obj=$('input:checked');

    var teacher_ids=[];  //用来保存老师的id集合
    var teacher_name=[];  //保存老师的昵称
    $.each(obj,function(k,v){   //循环获取选中的值  插入数组当中
       teacher_ids.push($(v).val());
       teacher_name.push(($(v).attr('teacher_name')));
    });

    teacher_ids=teacher_ids.join(',');
    teacher_name=teacher_name.join(',');
    //赋值到上一个页面表单上
   var par= $(parent.document).find('#teachers');
   var par_ids=$(parent.document).find('#teacher_ids');
    par.val(teacher_name);
    par_ids.val(teacher_ids);
    if(!teacher_ids){
        layer.msg('未选择授课老师');
    }else{
        var index=parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
    }

})


});



</script> 
@endsection