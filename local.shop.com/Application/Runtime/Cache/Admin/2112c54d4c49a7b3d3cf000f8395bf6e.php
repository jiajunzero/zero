<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>编辑用户</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet">


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
                <span style="float:left">当前位置是：用户管理-》编辑用户信息</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="/index.php/Admin/User/lst">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="/index.php/Admin/User/upd/id/1" method="post" enctype="multipart/form-data" name="myform">
                <input type="hidden" name="id" value="<?php echo ($row['id']); ?>">
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>用户名称</td>
                    <td><input type="text" name="username" value="<?php echo ($row['username']); ?>" /></td>
                </tr>
                <tr>
                    <td>用户角色</td>
                    <td>
                        <select name="role_id">
                            <option value="0">请选择</option>

                            <?php if(is_array($roleInfo)): foreach($roleInfo as $key=>$info): ?><option value="<?php echo ($info['role_id']); ?>"><?php echo ($info['role_name']); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>密码</td>
                    <td><input type="password" name="password" id="password" placeholder="密码留空表示不修改" /></td>
                </tr>
                <tr>
                    <td>确认密码</td>
                    <td><input type="password" name="repwd" placeholder="repwd..." /></td>
                </tr>
                <tr>
                    <td>邮箱</td>
                    <td><input type="text" name="email" value="<?php echo ($row['email']); ?>" /></td>
                </tr>
                <tr>
                    <td>用户详细描述</td>
                    <td>
                        <textarea name="mark_up" cols="40" rows="5" placeholder="mark_up..." ><?php echo ($row['mark_up']); ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="编辑">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
    <script src="/Public/Js/jquery.min.js"></script>
    <script src="/Public/Js/jquery.validate.min.js"></script>
    <script src="/Public/Js/validate_zh_cn.js"></script>
<script>
    $("form[name=myform]").validate({
        rules:{
            username:{
                required:true,
                rangelength:[2,10]
            },
            password:{
                rangelength:[5,15]
            },
            repwd:{
                equalTo:"#password"
            },
            email:{
                required:true,
                email:true
            }
        }
    })
</script>
</html>