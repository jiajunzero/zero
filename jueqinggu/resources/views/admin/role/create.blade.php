
@extends('admin.common')
@section('title')添加角色@endsection
@section('body')
<article class="page-container">
	<form action="{{url('admin/role')}}" method="post" class="form form-horizontal" id="form-admin-role-add">
		{{csrf_field()}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" id="roleName" name="role_name" datatype="*4-16" nullmsg="用户账户不能为空">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="" name="note">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站角色：</label>
			<div class="formControls col-xs-8 col-sm-9">
				@foreach($topAuth as $top)
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="{{$top->id}}" name="auth_ids[]" id="user-Character-0">
							{{$top->auth_name}}
						</label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							<dd>
								@foreach($sonAuth as $son)
									@if($son->auth_pid==$top->id)
								<label class="">
									<input type="checkbox" value="{{$son->id}}" name="auth_ids[]" id="user-Character-0-0-0">
									{{$son->auth_name}}
								</label>
									@endif
								@endforeach
							</dd>
						</dl>

					</dd>

				</dl>
				@endforeach
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
	
	$("#form-admin-role-add").validate({
		rules:{
			role_name:{
				required:true
			}
		},

		onkeyup:true,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit(function(msg){
				if(msg.status=='success'){
					layer.alert('添加成功',{
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