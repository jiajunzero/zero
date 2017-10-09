@extends('admin.common')
@section('title')添加课时@endsection

@section('body')

	<link rel="stylesheet" href="{{asset('back')}}\lib\webuploader\0.1.5\webuploader.css">
	<link rel="stylesheet" href="{{asset('back')}}\lib\zyUpload\control\css\zyUpload.css">
<article class="page-container">
	<form action="{{url('admin/lesson')}}" method="post"  class="form form-horizontal" id="form-profession-add" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课时名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="lesson_name" name="lesson_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属课程：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
		<select class="select" name="course_id" size="1" id="course_sel">
			@foreach($course as $item)
				<option value="{{$item->id}}">{{$item->course_name}}</option>
			@endforeach
		</select>
		</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>授课老师：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
	<select class="select" name="teacher" size="1" id="teacher">

	</select>
	</span> </div>
	</div>

	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>封面图：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<div id="cover_img">选择图片</div>
			<div class="uploader-list" id="webuploader_preview"></div>
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
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>视频：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<div id="video_address">上传视频</div>
			<div class="uploader-list" id="video_preview"></div>
			<div id="processing2">
				<div class="progress" style="width:100px">
			<span class="progress-bar">
				<span class="sr-only2" ></span>
			</span>
				</div>
			</div>
			<div id="error2"></div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="sort" name="sort">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否禁用：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="disabled_at" type="radio" id="auth-1" checked value="1">
				<label for="auth-1">是</label>
			</div>
			<div class="radio-box">
				<input name="disabled_at" type="radio" id="auth-2" checked value="0">
				<label for="auth-2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>视频描述：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="lesson_desc" id="lesson_desc" cols="126" rows="5"  autocomplete="off"></textarea>

		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="note" id="note" cols="126" rows="5"  autocomplete="off"></textarea>

		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
		<input type="hidden" name="cover_img">
		<input type="hidden" name="video_address">
	</form>
</article>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/additional-methods.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/zyUpload/control/js/zyUpload.js"></script>
<script type="text/javascript" src="{{asset('back')}}/lib/zyUpload/core/zyFile.js"></script>
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
	
	$("#form-profession-add").validate({
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
        '_token':'{{csrf_token()}}'
	},
    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#cover_img',
    // 只允许选择图片文件。
    accept: {
        title: '图片',
        extensions: 'gif,jpg,jpeg,png'
    }

});

//预览图片
$webuploader_preview=$('#webuploader_preview');
uploader.on( 'fileQueued', function( file ) {

    uploader.makeThumb(file, function (error, src) {
        $webuploader_preview.empty();
        if (error) {
           layer.msg('不能预览图片');
           return;
        } else {
            $webuploader_preview.append('<img src="' + src + '" />');
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
		$('input[name=cover_img]').val(msg.file)
	}else{
		$('#error').html('文件上传失败')
	}
});




var uploader = WebUploader.create({

    // 选完文件后，是否自动上传。
    auto: true,
    // swf文件路径
    swf:"{{asset('back')}}/lib/webuploader/0.1.5/Uploader.swf",
    resize:true,
    // 文件接收服务端。
    server: "{{url('admin/admin/upload/avatar')}}",
    formData:{
        '_token':'{{csrf_token()}}'
    },
    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: '#video_address',
    // 只允许选择图片文件。
    accept: {
        title: '视频',
        extensions: 'mp4,mkv,wmv'
    }

});
//预览视频
$video_preview=$('#video_preview');
uploader.on( 'fileQueued', function( file ) {
	console.log(file);
    uploader.makeThumb(file, function (error, src) {
        $video_preview.empty();
        if (error) {
            layer.msg('不能预览视频');
            return;
        } else {
            $video_preview.append('<video src="'+src+'" controls="controls" ></video>');
        }

    },100,100);
});

//进度条]
uploader.on( 'uploadProgress', function( file ,percentage) {
    $('#processing2 .sr-only2').css('width',percentage * 100 + '%')
});

//文件上传成功后 把图片路径提交到控制器进行入库
uploader.on( 'uploadSuccess', function( file ,msg) {
    if(msg.status=='success'){
        $('input[name=video_address]').val(msg.file)
    }else{
        $('#error2').html('文件上传失败')
    }
});


//根据选择的课程找出对应的老师
$('#course_sel').change(function(){

    var data={
        _id:$(this).val()
	};

    $.get('/admin/lesson/create',data,function(msg){
            $('#teacher').children().remove();

		$(msg.teachers).each(function(k,v){

//            $('#teacher').children().val(v.id);
			$('#teacher').append('<option value="'+v.id+'">'+v.nickname+'</option>');
		});
	});
})
</script>


<!--/请在上方写此页面业务相关的脚本-->
@endsection