<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5
 * Time: 20:35
 */

namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{
    protected  $_validate=array(
      array('good_name','require','商品名称不能为空'),
      array('good_price','require','商品价格不能为空'),
      array('good_num','require','商品库存不能为空'),
      array('cate_id','require','请选择商品分类'),
      array('type_id','require','请选择商品类型'),
    );


    //插入前的钩子
    public function _before_insert(&$data, $options)
    {
        //自动生成货号
       $data['goods_sn']=date(Ymdhi,time()).uniqid();
       //自动生成时间
       if($data['add_time']){
           $data['add_time']=strtotime($data['add_time']);
       }else{
           $data['add_time']=time();
       }

        return $this->_uploadImg($data);

    }
    
    //插入后的钩子
    public function _after_insert($data,$options){
        $goods_id=$data['goods_id'];//商品id
        $attr_values=I('post.goodsAttr');//获取属性值
        $attrsModel=D('goods_attrs');
        foreach($attr_values as $k => $v){//
            if(is_array($v)){//多选下拉属性是数组
                foreach($v as $key=>$val){
                    $insertData=array(
                        'goods_id'=>$goods_id,
                        'attr_id'=>$k,
                        'goods_attr_values'=>$val
                    );
                    
                    $attrsModel->add($insertData);
                }

            }else{
                //直接入库
                $insertData=array(
                    'goods_id'=>$goods_id,
                    'attr_id'=>$k,
                    'goods_attr_values'=>$v
                );
                $attrsModel->add($insertData);
            }
        }
    }

    //修改前的钩子
    public function _before_update(&$data,$options){

        $data['add_time']=strtotime($data['add_time']);

        //上传图片成功
       if($_FILES['goods_img']['error']==0){
           //删除旧的图片
           $goods_id=$options['where']['goods_id'];//获取当前的ID
           $row=$this->field('goods_img,goods_thumb')->find($goods_id);//查出当前记录的图片路径
           foreach($row as $v){
               @unlink(C('IMG_PATH').$v);//删除图片和缩略图
           }

           //调用生成图片路径的方法生成新的图片路径
           return $this->_uploadImg($data);
       }
    }


    private function _uploadImg(&$data,$options){
        $path=C('IMG_PATH');//根图片根目录

        $config = array(
            'maxSize'    =>    3145728,
            'rootPath'  =>  $path,
            'savePath'   =>    'Goods/',//图片二级目录
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
        );

        if(!is_dir($path)){//如果没有这个目录就自动生成一个
            mkdir('./Public/Uploads/');
        }

        $upload = new \Think\Upload($config);// 实例化上传类
        $info   =   $upload->upload();//开始上传图片

        if($info){//上传成功生成缩略图

            //原图片文件名
            $goodsImg=$info['goods_img']['savepath'].$info['goods_img']['savename'];
             $data['goods_img']=$goodsImg;//入库


            $thumbName=$info['goods_img']['savepath'].'thumb_'.$info['goods_img']['savename'];
            $data['goods_thumb']=$thumbName;//入库

            $image = new \Think\Image();
            $image->open($path.$goodsImg);//打开原图片
            // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
            $image->thumb(350, 350,3)->save($path.$thumbName);

        }else{
            $this->error=$upload->getError();
            return false;
        }
    }

    public function search(){

        $where=('is_delete=0');

        if(I('get.gn')){
            $gn=I('get.gn');
            $where.=" and goods_name like '%$gn%' ";
        }

        //默认根据id升序
        $orderBy='goods_id';
        $orderWay='asc';

        $ob=I('get.ob');//获取排序的值（字段名）
        $ow=I('get.ow');//获取排序规则  升序或降序

        if($ob){//如果get到值  重写排序的条件（字段）
            $orderBy=$ob;
        }
        if($ow){//重写排序规则
            $orderWay=$ow;
        }

        $count      = $this->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,2);// 实例化分页类传入总记录数和每页显示的记录数(2)

        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性


        $list = $this->where($where)
            ->order("$orderBy $orderWay")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();

       return array(
           'page'=>$show,
           'lsts'=>$list
       );
    }

//前台首页获取推荐位信息
    public function getGoods($type,$num=5){
        
        $where=array(
            'is_delete'=>0,//没有删除
            'is_sale'=>1,//已经上架
        );

        if($type=='is_crazy'){//疯狂抢购
            //价格最低的商品
            return $this->where($where)->order('goods_price asc')->limit($num)->select();
        }

        if($type=='is_guess'){//猜你喜欢
            //随机商品
            return $this->where($where)->order('rand()')->limit($num)->select();
        }

        //加一个条件 其他情况
        $where[$type]=1;
        return $this->where($where)->limit($num)->select();
    }
}