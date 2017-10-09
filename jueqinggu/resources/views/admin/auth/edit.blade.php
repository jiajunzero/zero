
@extends('admin.common')
@section('title')添加角色@endsection
@section('body')
<article class="page-container">
	<form action="{{url('admin/auth/'.$info->id)}}" method="post" class="form form-horizontal" id="form-admin-auth-add">
		{{csrf_field()}}
		{{method_field('put')}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$info->auth_name}}" id="authName" name="auth_name" datatype="*4-16" nullmsg="用户账户不能为空">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级权限：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="auth_pid" size="1">
					<option value="0">顶级权限</option>
				@foreach($auth_list as $item)
				{{--@if($item->auth_pid!=0)--}}
					<option value="{{$item['id']}}" {{$item['id']==$info->auth_pid?'selected':''}}>{{$item['auth_name']}}</option>
				{{--@endif--}}
				@endforeach
			</select>

			</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>控制器名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$info->auth_controller}}" placeholder="" id="" name="auth_controller">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>方法名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$info->auth_action}}" placeholder="" id="" name="auth_action">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>路由地址：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$info->auth_address}}" placeholder="" id="" name="auth_address">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否作为菜单显示：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="is_menu" type="radio" id="auth-1" value="1" {{$info->is_menu==1?'checked':''}}>
					<label for="auth-1">是</label>
				</div>
				<div class="radio-box">
					<input name="is_menu" type="radio" id="auth-2"  value="0" {{$info->is_menu==0?'checked':''}}>
					<label for="auth-2">否</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>

@endsection

@section('script')
	<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/additional-methods.min.js"></script>
	<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>

	<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	$("#form-admin-auth-add").validate({
		rules:{
			auth_name:{
				required:true
			}
		},

		onkeyup:true,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit(function(msg){
				if(msg.status=='success'){
					layer.alert('编辑成功',{
					    icon:1,
						skin:'layer-ext-moon'

					},function(){
                        parent.location.reload();
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
					});

				}else{
				    layer.alert(msg.error,{
				        icon:5,
						skin:'layer-ext-moon'
					});
				}
			});
//
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection