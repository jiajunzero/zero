<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
        <link href="/Public/Css/page.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：用户管理-》用户列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="/index.php/Admin/Type/add">【添加用户】</a>
                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="#" method="get">
                    品牌<select name="s_product_mark" style="width: 100px;">
                        <option selected="selected" value="0">请选择</option>
                        <option value="1">苹果apple</option>
                    </select>
                    <input value="查询" type="submit" />
                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody>
                <tr style="font-weight: bold;">
                    <td>序号</td>
                    <td>商品类型名称</td>
                    <td>商品类型描述</td>
                    <td align="center">操作</td>
                </tr>
                <?php foreach($typeData as $k => $lst): ?>
                <tr id="product1">
                    <td><?php echo ++$k?></td>
                    <td><?php echo $lst['type_name']?></td>
                    <td><?php echo $lst['mark_up']?></td>

                    <td>
                        <a href=""><button>属性列表</button></a>
                        <a href="/index.php/Admin/Type/upd/id/<?php echo $lst['type_id']?>">
                            <button>修改</button>
                        </a>
                       <a>
                           <button class="del" user_id="<?php echo $lst['type_id']?>" >删除</button>
                       </a>
                    </td>

                </tr>
                <?php endforeach?>

                </tbody>
            </table>
            <div class="pagination" align="center">
                <?php echo ($page); ?>

            </div>
        </div>
    </body>
<script src="/Public/Js/jquery.min.js"></script>
<script>
    //利用ajax技术实现无刷新删除
    $('.del').click(function(){

        $u_id=$(this).attr('user_id');//获取到当前用户的ID
        var self=$(this);//把当前对象赋给一个变量 方便其他函数利用

        if( !confirm('确定删除？') ){
            return false;
        }
//        发送ajax请求
        $.ajax({
            type:'get',
            url:"/index.php/Admin/Type/del",//跳转到当前控制器的删除方法
            data:{'u_id':$u_id},//把ID传到方法中删除数据库本条记录
            dataType:'json',
            success:function(json) {
                //接收的错误为0就删除当前行
                if(json.errCode == 0) {
                    self.parent().parent().remove();//删除当前行
                    //重新排序
                   $('tbody tr').each(function(k,v){
                        $(this).find('td').eq(1).html(k+1);
                    });
                    alert(json.info);
                }else{
                    alert(json.info);
                }
            }
        })
    })
</script>
<script>
//    $(document).on('click','.pagination a',function(){
//        var href=$(this).attr('href');
//      $.get(href,'',function(json){
//         console.log(json);
//          $('tbody').html(json.data);
//          $('.pagination').html(json.page);
//      },'json');
//      return false;
//    })
</script>
</html>