<?php

namespace app\index\controller;
use think\Controller;
use think\Db;
/**
*@param 分类控制器
*/
class Category extends Base {

    protected $goods_category_model;
    public function _initialize() {

      	parent::_initialize();
        $this->goods_category_model = M('goods_category');
    
    }

    /*********分类列表*************/
    public function index(){

        $data['category_list'] = $this->goods_category_model
            ->field('id,name,mobile_name,image')
            ->where('parent_id',0)
            ->where('is_show',1)
            ->where('name','not like','%'.'秒杀')
            ->order('sort_order')
            ->select();
        foreach ($data['category_list'] as $k => $v) {
            $data['child_list'] = Db::name('goods_category')
                ->field('id,name,mobile_name,image')
                ->where('parent_id',$v['id'])
                ->where('is_show',1)
                ->order('sort_order')
                ->select();
           break;
        }
        return $this->fetch_view('index','cates',$data);

    }

    /*********获取分类子集*************/
    public function cate_child_list(){

        $id = input('id');
        if(empty($id)){
            return return_ajax(2,'缺少必要参数');
        }
         $child_list = $this->goods_category_model
                ->field('id,name,mobile_name,image')
                ->where('parent_id',$id)
                ->where('is_show',1)
                ->order('sort_order')
                ->select();
        return return_ajax(1,'success',$child_list);

    }


}