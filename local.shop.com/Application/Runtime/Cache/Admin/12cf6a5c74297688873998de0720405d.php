<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>商品列表</title>

        <link href="/Public/Admin/css/mine.css" type="text/css" rel="stylesheet" />
        <!--<link href="/Public/Css/page.css" type="text/css" rel="stylesheet"/>-->
        <link href="/Public/LightBox/css/lightbox.css" type="text/css" rel="stylesheet"/>
        <style>
            .pagination{
                margin-top:20px;
            }
            .prev,.next{
                font-size: 20px;
               color:#9B410E;
                background: #ddd;
                border:1px solid darkseagreen;
               text-decoration: none;
            }

            .num{
                font-size: 20px;
                padding-left: 5px;
                padding-right: 5px;
                 margin:5px;
                border: 1px solid #02435f;
                background: #ddd;
                text-decoration: none;
            }

            .current{
                font-size: 20px;
                padding-left: 5px;
                padding-right: 5px;
                border: 1px solid #02435f;
                background:#30c37c;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <style>
            .tr_color{background-color: #9F88FF}
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：商品管理-》商品列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="/index.php/Admin/Goods/add">【添加商品】</a>
                    <a style="text-decoration: none;" href="/index.php/Admin/recovery/lst">【回收站】</a>

                </span>
            </span>
        </div>
        <div></div>
        <div class="div_search">
            <span>
                <form action="/index.php/Admin/Goods/lst" method="get">
                   名称：<input type="text" name="gn" value="<?php echo I('get.gn')?>"  id="sub">
                    　根据：
                    ID<input type="radio" name="ob" value="goods_id" <?php if(I('get.ob')=='goods_id'){ echo "checked='checked'" ;} ?>>
                    价格<input type="radio" name="ob" value="goods_price" <?php if(I('get.ob')=='goods_price'){ echo "checked='checked'" ;} ?>>　
                    　　
                    排序规则：
                    升序<input type="radio" name="ow" value="asc" class="ow" <?php if(I('get.ow')=='asc'){ echo "checked='checked'" ;}?>>　
                    降序<input type="radio" name="ow" value="desc" class="ow"   <?php if(I('get.ow')=='desc'){ echo "checked='checked'" ;}?>>　

                </form>
            </span>
        </div>
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody>
                <tr style="font-weight: bold;">
                    <td>序号</td>
                    <td>商品名称</td>
                    <td>商品价格</td>
                    <td>商品库存</td>
                    <td>商品货号</td>
                    <td>商品图片</td>
                    <td>是否上架</td>
                    <td>是否新品</td>
                    <td>添加时间</td>
                    <td align="center">操作</td>
                </tr>
                <?php foreach($lsts as $k => $lst): ?>
                <tr id="product1">
                    <td><?php echo ++$k?></td>
                    <td><?php echo $lst['goods_name']?></td>
                    <td><?php echo $lst['goods_price']?></td>
                    <td><?php echo $lst['goods_num']?></td>
                    <td><?php echo $lst['goods_sn']?></td>
                    <td>
                        <a href="<?php echo C('VIEW_IMG_PATH').$lst[goods_img]?>" data-lightbox="img">
                            <img src="<?php echo C('VIEW_IMG_PATH').$lst[goods_thumb]?>" width="150" height="80">
                        </a>
                    </td>
                    <td><?php echo $lst['is_sale']==1?'上架':'待上架'?></td>
                    <td><?php echo $lst['is_new']==1?'是':'否'?></td>
                    <td><?php echo date('Y-m-d H:s',$lst['add_time'])?></td>

                    <td>
                        <a href="/index.php/Admin/Goods/content/goods_id/<?php echo $lst['goods_id']?>">
                            <button>查看详情</button>
                        </a>
                        <a href="/index.php/Admin/Goods/upd/goods_id/<?php echo $lst['goods_id']?>">
                            <button>修改</button>
                        </a>
                        <a>
                            <button class="del" goods_id="<?php echo $lst['goods_id']?>" >删除</button>
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
<script src="/Public/LightBox/Js/lightbox.js"></script>
<script>
    //利用ajax技术实现无刷新删除
    $('.del').click(function(){

        var goods_id=$(this).attr('goods_id');//获取到当前商品的ID
        var self=$(this);//把当前对象赋给一个变量 方便其他函数利用

        if( !confirm('确定删除？') ){
            return false;
        }
//        发送ajax请求
        $.ajax({
            type:'get',
            url:"/index.php/Admin/Goods/del",//跳转到当前控制器的删除方法
            data:{'goods_id':goods_id},//把ID传到方法中删除数据库本条记录
            dataType:'json',
            success:function(json) {
                //接收的错误为0就删除当前行
                if(json.error == 0) {
                    self.parent().parent().parent().remove();//删除当前行
                    //重新排序
                   $('tbody tr[id="product1"]').each(function(k,v){
                        $(this).find('td').eq(0).html(k+1);
//                       console.log( $(this).find('td').eq(1));
                    });
                    alert(json.info);
                }else{
                    alert(json.info);
                }
            }
        })

        return false;
    })
</script>
<script>
    $('#sub').blur(function(){
        $('form').submit();
    })

    $('.ow').change(function(){
        $('form').submit();
    })

</script>
</html>