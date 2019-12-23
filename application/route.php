<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//
return [
  '__pattern__' => [
      'name' => '\w+',
  ],
  '[hello]'     => [
       ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
       ':name' => ['index/hello', ['method' => 'post']],
  ],

  // 'index'=>'index/index/index',//首页
  // 'search'=>'index/index/search',//搜索页面
  // 'promotions'=>'index/index/promotions',//下拉加载推荐产品
  // 'clear_history'=>'index/index/clear_history',//清空搜索记录



  //  //登陆路由
  // 'login'=>'index/login/index',//登陆页面
  // 'register'=>'index/login/register',//注册页面
  // 'send_msg'=>'index/login/send_msg',//发送验证码
  // 'reset'=>'index/login/reset',//重置密码
  // 'reset_send_msg'=>'index/login/reset_send_msg',//重置密码发送验证码

  //  //商品路由
  // 'collect'=>'index/goods/collect',//收藏商品
  // 'cart'=>'index/goods/cart',
  // 'detail'=>'index/goods/detail',

  // //分类列表
  // 'cate_list'=>'index/category/cate_list',//分类列表详情
  // 'cate_child_list'=>'index/category/cate_child_list',//获取分类子集




   //'goodsInfo/[:id]' => ['Home/Goods/goodsInfo',['method' => 'get', 'ext' => 'html'],'cache'=>3600]
   //Home/Goods/goodsInfo/id/104.html
];
//use think\Route;
// 注册路由到index模块的News控制器的read操作
//Route::get('goodsInfo/:id','home/goods/goodsInfo',['cache'=>['Home/Goods/goodsInfo',300]]);// 访问方式 http://www.tpshop2.0.com/goodsInfo/77.html

// http://www.tpshop2.0.com/home/goods/goodsInfo/id/77.html
