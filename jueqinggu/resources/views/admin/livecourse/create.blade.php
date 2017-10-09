@extends('admin.common')
@section('title')添加直播课程@endsection

@section('body')

	<link rel="stylesheet" href="{{asset('back')}}\lib\webuploader\0.1.5\webuploader.css">
	<link rel="stylesheet" href="{{asset('back')}}\lib\zyUpload\control\css\zyUpload.css">
<article class="page-container">
	<form action="{{url('admin/livecourse')}}" method="post"  class="form form-horizontal" id="form-profession-add" enctype="multipart/form-data">
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="pro_name" name="course_name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属直播流：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
		<select class="select" name="stream_id" size="1">
			@foreach($stream as $item)
				<option value="{{$item->id}}">{{$item->stream_name}}</option>
			@endforeach
		</select>

		</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属专业：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
	<select class="select" name="pro_id" size="1">
		@foreach($pro as $item)
			<option value="{{$item->id}}">{{$item->pro_name}}</option>
		@endforeach
	</select>

	</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>授课老师：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="teachers" name="teachers">
			<input type="hidden" class="input-text" autocomplete="off" value=""  id="teacher_id" name="teacher_id">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播开始时间：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="datetime-local" class="input-text" autocomplete="off" value=""  id="price" name="start_at">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播结束时间：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="datetime-local" class="input-text" autocomplete="off" value=""  id="price" name="end_at">
		</div>
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
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>排序：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" autocomplete="off" value=""  id="sort" name="sort">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>直播课程简介：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="note" id="pro_desc" cols="126" rows="5"  autocomplete="off"></textarea>

		</div>
	</div>

	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
		<input type="hidden" name="cover_img">
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


//弹出选择授课老师分类框
$('#teachers').on('click',function(){
   layer_show('选择授课老师分类','{{url('admin/live/select_teacher')}}',900,400);
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