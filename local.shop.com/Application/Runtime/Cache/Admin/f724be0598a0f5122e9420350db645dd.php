<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加权限</title>
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
                <span style="float:left">当前位置是：权限管理-》添加权限信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Admin/Auth/lst">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/Auth/add" method="post" enctype="multipart/form-data" name="myform">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>权限名称</td>
                    <td><input type="text" name="auth_name" placeholder="权限名称" /></td>
                </tr>
                <tr>
                    <td>上级权限</td>
                    <td>
                        <select name="auth_pid">
                            <option value="">请选择</option>
                            <option value="0">顶级权限</option>
                            <?php foreach ($tree as $k =>$v){ ?>
                            <option value="<?php echo $v['auth_id']?>"><?php echo str_repeat("　",$v['level']).$v['auth_name']?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>权限控制器</td>
                    <td><input type="text" name='auth_c' placeholder="权限控制器" /></td>
                </tr>
                <tr>
                    <td>权限方法</td>
                    <td><input type="text" name="auth_a" placeholder="权限方法" /></td>
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
        rules: {

            repwd: {
                required: true,
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true
            }
        }
    })
</script>

</html>