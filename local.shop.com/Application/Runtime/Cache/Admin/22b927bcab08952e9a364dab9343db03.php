<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加商品类型</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">
        <link href="/Public/Css/completer.css" type="text/css" rel="stylesheet">
    </head>
    <style>
        label.error{
            color:red;
            margin-left: 5px;
        }
    </style>
    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品类型管理-》添加商品类型</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Admin/Type/lst">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/Type/add" method="post" enctype="multipart/form-data" name="myform">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>商品类型名称</td>
                    <td><input type="text" name="type_name" placeholder="Type name..." /></td>
                </tr>
                <tr>
                    <td>商品类型描述</td>
                    <td><textarea name="mark_up" rows="5" cols="40"></textarea> </td>
                </tr>


                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
<script src="/Public/Js/jquery.min.js"></script>
<script src="/Public/Js/jquery.validate.min.js"></script>
<script src="/Public/Js/validate_zh_cn.js"></script>
<script src="/Public/Js/completer.min.js"></script>
<script>
    $("form[name=myform]").validate({
        rules:{
            username:{
                required:true,
                rangelength:[2,10]
            },
            password:{
                required:true,
                rangelength:[5,15]
            },
            repwd:{
                required:true,
                equalTo:"#password"
            },
            email:{
                required:true,
                email:true
            }
        }
    })
</script>
    <script>
        $('#auto_email').completer({
            separator:'@',
            source:["163.com",'qq.com','139.com','gmail.com']
        });
    </script>
</html>