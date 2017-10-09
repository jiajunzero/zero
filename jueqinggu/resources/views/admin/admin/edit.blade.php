@extends('admin.common')
@section('title')编辑管理员@endsection

@section('body')
	<link rel="stylesheet" href="{{asset('back')}}\lib\webuploader\0.1.5\webuploader.css">

	<article class="page-container">
	<form action="{{url('admin/admin/'.$info->id)}}" method="post"  class="form form-horizontal" id="form-admin-add" enctype="multipart/form-data">
	{{csrf_field()}}
	{{method_field('put')}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>管理员账号：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$info->username}}" placeholder="" id="adminName" name="username">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">昵称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$info->nickname}}" placeholder="" id="adminName" name="nickname">
		</div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="sex" type="radio" id="sex-1"  value="2" {{$info->sex==2?'checked':''}} >
				<label for="sex-1">男</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="sex" value="1" {{$info->sex==1?'checked':''}}>
				<label for="sex-2">女</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$info->phone}}" placeholder="" id="phone" name="phone">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" placeholder="@" value='{{$info->email}}' name="email" id="email">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">头像：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<div id="avatar">选择图片</div>
			<div class="uploader-list" id="preview">
				<img src="{{$info->avatar?:''}}" alt="" width="100">
			</div>
				<div id="processing">
					<div class="progress" style="width:100px">
					<span class="progress-bar">
						<span class="sr-only" ></span>
					</span>
					</div>
				</div>
			<div id="error"></div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>角色：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="role_id" size="1">
				@foreach($role_list as $item)
					<option value="{{$item->id}}" {{$info->role_id==$item->id?'selected':''}}>{{$item->role_name}}</option>
				@endforeach
			</select>
			</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>启用状态：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="disabled_at" type="radio" id="sex-1" checked value="1" {{$info->disabled_at==1?'checked':''}}>
				<label for="sex-1">启用</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="disabled_at" value="0" {{$info->disabled_at==0?'checked':''}}>
				<label for="sex-2">禁用</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<script id="container" name="note" type="text/plain">
				{!! $info->note !!}
			</script>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
		<input type="hidden" name='avatar' value="{{$info->avatar}}">
	</form>
</article>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/additional-methods.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/webuploader/0.1.5/webuploader.min.js"></script>

<script src="{{asset('back')}}/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script src="{{asset('back')}}/lib/ueditor/1.4.3/ueditor.all.js"></script>
{{--<script type="text/javascript" src="{{asset('')}}/js/placeImage.js"></script>--}}
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
//		rules:{
//			adminName:{
//				required:true,
//				minlength:4,
//				maxlength:16
//			},
//			password:{
//				required:true,
//			},
//			password2:{
//				required:true,
//				equalTo: "#password"
//			},
//			sex:{
//				required:true,
//			},
//			phone:{
//				required:true,
//				isPhone:true,
//			},
//			email:{
//				required:true,
//				email:true,
//			},
//			adminRole:{
//				required:true,
//			},
//		},
		onkeyup:false,
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
		}
	});
});



var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,
    // swf文件路径
    swf:"{{asset('back')}}/lib/webuploader/0.1.5/Uploader.swf",
    resize:false,
    // 文件接收服务端。
    server: "{{url('admin/admin/upload/avatar')}}",
    formData:{
        '_token':'{{csrf_token()}}',
    },
    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#avatar',
    // 只允许选择图片文件。
    accept: {
        title: '图片',
        extensions: 'gif,jpg,jpeg,png'
    }

});

//预览图片
$preview=$('#preview');
uploader.on( 'fileQueued', function( file ) {

    uploader.makeThumb(file, function (error, src) {
        $preview.empty();
        if (error) {
            layer.msg('不能预览图片');
            return;
        } else {
            $preview.append('<img src="' + src + '" />');
        }

    },100,100);
});

//进度条]
uploader.on( 'uploadProgress', function( file ,percentage) {
    $('#processing .sr-only').css('width',percentage * 100 + '%')
});

//文件上传成功后 把图片路径提交到控制器进行入库
uploader.on( 'uploadSuccess', function( file ,msg) {
    if(msg.status=='success'){

        //发送ajax把原有的图片删除
		var old=$('input[name=avatar]').val();
		var data={
		    '_token':'{{csrf_token()}}',
			'avatar':old
		}
//		console.log(msg.file);
		$.post('/admin/del_upload',data,function(msg){

        });
        $('input[name=avatar]').val(msg.file)
    }else{
        $('#error').html('文件上传失败')
    }
});
</script>
<script>
    var ue = UE.getEditor('container',{
        toolbars: [[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music'
        ]]
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
@endsection