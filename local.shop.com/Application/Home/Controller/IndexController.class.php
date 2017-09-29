<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
        public function index(){

                $cateModel=D('Admin/Category');
                $cate=$cateModel->getCate();
                
                $cates=$cateModel->where('pid =0 and is_show=1')->select();

                //调用方法获取推荐信息
                $goodsModel=D('Admin/Goods');
               
                $this->assign(array(
                'crazyData'=>$goodsModel->getGoods('is_crazy'),
                'guessData'=>$goodsModel->getGoods('is_guess'),
                'newData'=>$goodsModel->getGoods('is_new'),
                ));


                $this->assign('headCate',$cates);
                $this->assign('cate',$cate);
                $this->display();
        }

        //商品详情页
        public function detail(){

                $goods_id=I('get.goods_id');                
                $goodsModel=M('Goods');
                $data=$goodsModel->find($goods_id);

                //商品属性属性值
                $attrModel=M('goods_attrs');
                $radioData=$attrModel->field('a.*,b.attr_name')
                                    ->join('a left join sh_attr b on a.attr_id=b.attr_id')
                                    ->where("a.goods_id=$goods_id and b.attr_type=0")
                                   ->select();

                //把相同的属性放在一起
                $radio=array();
                foreach ($radioData as $k => $v){
                    $radio[$v['attr_id']][]=$v;
                }
//                dump($radio);
                $this->assign('radio',$radio);
                $this->assign('data',$data);
                $this->display();
        }
}