@extends('admin.common')
@section('title')修改密码 -管理员管理@endsection

@section('body')
<article class="page-container">
	<form action="{{url('admin/admin_change_password?id='.$id)}}" method="post" class="form form-horizontal" id="form-change-password">
		{{csrf_field()}}
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账户：</label>
			<div class="formControls col-xs-8 col-sm-9"> {{$username}}</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>新密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" autocomplete="off" placeholder="不修改请留空" name="password" id="newpassword">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="password" class="input-text" autocomplete="off" placeholder="不修改请留空" name="password2" id="newpassword2">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

@endsection
@section('script')
<!--请在下方写此页面业务相关的脚本-->

<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script>

<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/additional-methods.min.js"></script>

<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>

<script type="text/javascript">
$(function(){
	$("#form-change-password").validate({
		rules:{
			newpassword:{
				required:true,
				minlength:6,
				maxlength:16
			},
			newpassword2:{
				required:true,
				minlength:6,
				maxlength:16,
				equalTo: "#newpassword"
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit(function(msg){
				if(msg.status=='success'){
                    layer.alert('修改成功',{
                        icon:1,
                        skin:'layer-ext-moon'

                    },function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.$('.btn-refresh').click();
                        parent.layer.close(index);
                    });

				}else{
                    layer.alert(msg.error,{
                        icon: 5,
                        skin: 'layer-ext-moon'
                    });
				}


			});

		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection