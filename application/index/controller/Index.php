<?php

namespace app\index\controller;

use think\Db;
use app\common\logic\wechat\WechatUtil;

class Index extends Base {

/***********首页数据***********************/
    public function index(){
         $banner = Db::name('ad')
            ->field('ad_id,ad_name,ad_link,ad_code,content,pid')
            ->where('pid','in',[2,9,11])
            ->where('enabled',1)
            ->order('orderby')
            ->select();
        foreach ($banner as $k => $v) {
            switch ($v['pid']) {
                case '2':
                    $index_data['banner'][] = $v;
                    break;
                case '9':
                    $index_data['spike_ad'][] = $v;
                    break;
                case '11':
                    $index_data['recover_ad'][] = $v;
                    break;
            }
        }
        $index_data['cates'] = Db::name('goods_category')
            ->field('id,name,mobile_name,image')
            ->where('level',1)
            ->order('sort_order')
            ->select();
        
        $index_data['promotions'] = Db::name('prom_goods')
            ->field('id,title,subtitle,start_time,end_time,prom_img')
            ->where('is_end',0)
            ->limit($this->list_rows)
            ->order('id desc')
            ->select();
        foreach ($index_data['promotions'] as $k => $v) {
            $index_data['promotions'][$k]['days'] = intval(($v['end_time']-$v['start_time'])/(60*60*24));
        }

        return $this->fetch_view('index','index_data',$index_data);
        
    }

/****************下拉加载活动列表数据******************/
        public function promotions(){
            $page = input('page');
            if(empty($page)){
                $page = 2;
            }
            $promotions = Db::name('prom_goods')
                ->field('id,title,subtitle,start_time,end_time,prom_img')
                ->where('is_end',0)
                ->order('id desc')
                ->page($page,$this->list_rows)
                ->select();
            foreach ($promotions as $k => $v) {
                $promotions[$k]['days'] = intval(($v['end_time']-$v['start_time'])/(60*60*24));
            }
            
            return return_ajax(1,'success',$promotions);
        }
/**************搜索页面******************************/
    public function search(){

        $keywords = input('keywords');
        if(empty($keywords)){
            //历史搜索数据
            $search['history_record'] = cookie('history_record');
            if($search['history_record'] == NULL || $search['history_record'] == 'delete'){
                $search['history_record'] = array();
            }
            //热门搜索数据
            $search['hot_record'] = Db::name('search_word')
                ->field('keywords')
                ->limit($this->list_rows)
                ->order('search_num desc')
                ->select();
            $search['hot_record'] = array_column($search['hot_record'], 'keywords');

            if(IS_GET){
                $this->assign('search',$search);
                return $this->fetch();
            }
            return return_ajax(1,'success',$search);
        }else{
            //储存搜索记录
            $history_record = cookie('history_record');
            if(empty($history_record)){
                $history_record[] = $keywords;
                
            }else{
                array_unshift($history_record, $keywords);
            }
            $history_record = array_values(array_unique($history_record));
            if(count($history_record) >15){
                unset($history_record[15]);
            }
            cookie('history_record',$history_record);
            //新增到search_word表
            $this->edit_search_word($keywords);

            //返回查询到的数据
            $goods_data['keywords'] = $keywords;
            $goods_data['goods_data'] = Db::name('goods')
                ->field('goods_id,goods_name,original_img,shop_price,market_price')
                ->where('goods_name|goods_remark|goods_content|mobile_content','like','%'.$keywords.'%')
                ->where('is_on_sale',1)
                ->where('store_count','>',0)
                ->order('goods_id desc')
                ->limit($this->list_rows)
                ->select();
            $collect_data = $this->collect_list();

            foreach ($goods_data['goods_data'] as $k=> $v) {
                if(!empty($collect_data) && in_array($v['goods_id'], $collect_data)){
                    $goods_data['goods_data'][$k]['is_collect'] = 1;
                }else{
                    $goods_data['goods_data'][$k]['is_collect'] = 0;
                }
            }
            if(IS_GET){
                $this->assign('goods_data',$goods_data);
                return $this->fetch();
            }
           return return_ajax(1,'success',$goods_data);
        } 
    }
    //下拉加载搜索数据
    public function search_ajax_data(){

        $page = input('page');
        $keywords = input('keywords');
        if(empty($page))$page = 2;
        $goods_data = Db::name('goods')
                ->field('goods_id,goods_name,original_img,shop_price,market_price')
                ->where('goods_name|goods_remark|goods_content|mobile_content','like','%'.$keywords.'%')
                ->where('is_on_sale',1)
                ->where('store_count','>',0)
                ->order('goods_id desc')
                ->page($page,$this->list_rows)
                ->select();
            if(!empty($goods_data)){
                $collect_data = $this->collect_list();

                foreach ($goods_data as $k=> $v) {
                    if(!empty($collect_data) && in_array($v['goods_id'], $collect_data)){
                        $goods_data[$k]['is_collect'] = 1;
                    }else{
                        $goods_data[$k]['is_collect'] = 0;
                    }
                }
            }
        return return_ajax(1,'success',$goods_data);
    }


    //增加搜索关键词/搜索次数
    public function edit_search_word($keywords){
        //查询数据库是否有该条关键词搜索记录
        $search_word_model = Db::name('search_word');
        $is_hava_keywords = $search_word_model
            ->where('keywords',$keywords)
            ->count();
        if($is_hava_keywords > 0){
            $search_word_model->where('keywords',$keywords)
                ->setInc('search_num');
        }else{
            $search_word_model->insert([
                'keywords'=>$keywords,
                'search_num'=>1
            ]);
        }
    }
    //获取用户收藏商品
    public function collect_list(){

        $collect_list = array();
        if($this->uid){
            $collect_list = Db::name('goods_collect')
                ->field('goods_id')
                ->where('user_id',$this->uid)
                ->select();
            if(count($collect_list) >0)
                $collect_list = array_column($collect_list,'goods_id');
        } 
        return $collect_list;


    }

    public function index2(){
        $id=I('get.id');  
        $role=I('get.role'); 

        if($role){
            $arr=M('industry_template')->where('id='.$id)->field('template_html,block_info')->find();
        }else{
            if($id){
                $arr=M('mobile_template')->where('id='.$id)->field('template_name ,template_html,block_info,is_index')->find();
            }else{
                $arr=M('mobile_template')->order('id DESC')->limit(1)->field('template_name ,template_html,block_info,is_index')->find();
            } 
        }

        $html=htmlspecialchars_decode($arr['template_html']);
        $logo=tpCache('shop_info.wap_home_logo');
        $this->assign('wap_logo',$logo);
        $this->assign('html',$html);
        $this->assign('is_index',$arr['is_index']); //是否为首页, 如果不是首页, 则显示"返回"按钮
        $this->assign('info',$arr['block_info']);
        $this->assign('template_name',$arr['template_name']);
        return $this->fetch();
    }

    //商品列表板块参数设置
    public function goods_list_block(){
        $data=I('post.');
        $sql_where = input('sql_where');//dump($sql_where);exit;
        // 13时，轮播传的是sql_where
        if($sql_where){
            if(!empty($sql_where['label']) && !isset($data['label'])){
                $data['label'] = $sql_where['label'];
            }
            if(!empty($sql_where['ids']) && !isset($data['ids'])){
                $data['ids'] = $sql_where['ids'];
            }
            if(!empty($sql_where['min_price']) && !empty($sql_where['max_price']) && $sql_where['min_price'] < $sql_where['max_price']){
                $data['min_price'] = $sql_where['min_price'];
                $data['max_price'] = $sql_where['max_price'];
            }
        }

        $block = new \app\common\logic\Block();
        $goodsList = $block->goods_list_block($data);

        $html='';
        if($data['block_type']==13){
            foreach ($goodsList as $k => $v) {
                $html.='<div class="containers-slider-item">';
                $html.='<div class="seckill-item-img">';
                $html.='<a href="/Mobile/Goods/goodsInfo/id/'.$v["goods_id"].'"><img src="'.$v["original_img"].'" /></a>';
                $html.='</div>';
                $html.='<div class="seckill-item-name"><p>'.$v["goods_name"].'</p></div>';
                $html.='<div class="seckill-item-price" class="p"><span class="fl">￥<em>'.$v['shop_price'].'</em></span>';
                $html.='</div></div>';
            }
        }else{
            foreach ($goodsList as $k => $v) {
                $num = $v['sales_sum']+$v['virtual_sales_sum'];
                $html.='<li>';
                $html.='<a class="tpdm-goods-pic" href="/Mobile/Goods/goodsInfo/id/'.$v["goods_id"].'"><img src="'.$v["original_img"].'" alt="" /></a>';
                $html.='<a href="/Mobile/Goods/goodsInfo/id/'.$v["goods_id"].'" class="tpdm-goods-name">'.$v["goods_name"].'</a>';
                $html.= $v['label_name'] ? '<span class="rx-sp">'.$v['label_name'].'</span>' :  '<span class="rx-sp"  style="height: 0.747rem;border:none"></span>';
                $html.='<div class="tpdm-goods-des">';
                $html.='<div class="tpdm-goods-price">￥<em>'.explode_price($v['shop_price'],0).'</em>.<em>'.explode_price($v['shop_price'],1).'</em>'.'</div>';
                $html.='<a class="tpdm-goods-like">已售'.$num.'件</a>';
                $html.='</div>';
                $html.='</li>';
            } 
        }
        $this->ajaxReturn(['status' => 1, 'msg' => '成功', 'result' =>$html,'data'=>$data,'goods_list'=>$goodsList]);
    }


    //自定义页面获取秒杀商品数据
    public function get_flash(){
        $now_time = time();  //当前时间
        if(is_int($now_time/7200)){      //双整点时间，如：10:00, 12:00
            $start_time = $now_time;
        }else{
            $start_time = floor($now_time/7200)*7200; //取得前一个双整点时间
        }
        $end_time = $start_time+7200;   //结束时间
        $flash_sale_list = M('goods')->alias('g')
            ->field('g.goods_id,g.goods_name,g.original_img,g.shop_price,f.price,s.item_id')
            ->join('flash_sale f','g.goods_id = f.goods_id','LEFT')
            ->join('__SPEC_GOODS_PRICE__ s','s.prom_id = f.id AND g.goods_id = s.goods_id','LEFT')
            ->where("start_time = $start_time and end_time = $end_time and is_end = 0")
            ->limit(4)->select();
        $str='';
        if($flash_sale_list){
            foreach ($flash_sale_list as $k => $v) {
                $str.='<a href="'.U('Mobile/Activity/flash_sale_list').'">';
                if(strpos($v['original_img'],'/public') === 0 ){
                    if(!file_exists('.'.$v['original_img'])){
                        $v['original_img'] = '/public/images/icon_goods_thumb_empty_300.png';
                    }
                }elseif(empty($v['original_img'])){
                    $v['original_img'] = '/public/images/icon_goods_thumb_empty_300.png';
                }
                $str.='<img src="'.$v['original_img'].'" alt="" />';
                $str.='<p>'.$v['goods_name'].'</p>';
                $str.='<span>￥'.$v['price'].'</span>';
                $str.='<i>￥'.$v['shop_price'].'</i></a>';
            }
        }
        $time=date('H',$start_time);
        $this->ajaxReturn(['status' => 1, 'msg' => '成功','html' => $str, 'start_time'=>$time, 'end_time'=>$end_time]);
    }

    /**
     * 智能表单提交
     */
    public function save_form(){
        $block = new \app\common\logic\Block();
        $data = $block->add_form(input('post.'));
        $this->ajaxReturn($data);
    }

    /**
     * 分类列表显示
     */
    public function categoryList(){
        return $this->fetch();
    }

    /**
     * 模板列表
     */
    public function mobanlist(){
        $arr = glob("D:/wamp/www/svn_tpshop/mobile--html/*.html");
        foreach($arr as $key => $val)
        {
            $html = end(explode('/', $val));
            echo "<a href='http://www.php.com/svn_tpshop/mobile--html/{$html}' target='_blank'>{$html}</a> <br/>";            
        }        
    }

    /**
     * 门店列表
     * province,如果有省名，传省名字
     * lng,lat,search_radius，经伟度，查找半径范围内的门店
     */
    public function shopList(){
        $data = input('param.');
        if(isset($data['province'])){
            $province_id = Db::name('region')->where('name',$data['province'])->value('id');
            if($province_id){
                $where['province_id'] = $province_id;
            }
        }
        $where['deleted'] = 0;
        $where['shop_status'] = 1;
        $shop_list = Db::name('shop')->field('shop_id,shop_name,province_id,city_id,district_id,shop_address,longitude,latitude,deleted,shop_desc')->where($where)->select();
        $shop_logic = new \app\common\logic\Shop();
        $shop_list = $shop_logic->filterDistance($shop_list,$data['lng'], $data['lat'],$data['search_radius']);
        $this->ajaxReturn(['status' => 1, 'result' => $shop_list]);
    }
    public function newsList(){
        $ids = input('ids');
        if($ids){
            $ids_arr = explode(',',$ids);
            $where['article_id'] = ['in', $ids_arr];
        }
        $num = input('new_num/d', 2);
        $num = $num > 10 ? $num : $num;
        $where['publish_time'] = ['elt',time()];
        $where['is_open'] = 1;
        $list= Db::view('news')
            ->view('newsCat','cat_name','newsCat.cat_id=news.cat_id','left')
            ->where($where)
            ->order('publish_time DESC')
            ->limit($num)
            ->select();
        foreach($list as $k=>$v){
            $list[$k]['content'] = htmlspecialchars_decode($list[$k]['content']);
            if(strpos($v['thumb'],'/public') === 0 ){
                if(!file_exists('.'.$v['thumb'])){
                    $list[$k]['thumb'] = '/public/images/icon_goods_thumb_empty_300.png';
                }
            }elseif(empty($v['thumb'])){

                $list[$k]['thumb'] = '/public/images/icon_goods_thumb_empty_300.png';
            }
        }
        $this->ajaxReturn(['status' => 1, 'result' => $list]);
    }
    public function news_list(){
        return $this->fetch();
    }
    public function ajax_news_list(){
        $page = input('page/d', 1);
        $where['publish_time'] = ['elt',time()];
        $where['is_open'] = 1;
        $list= Db::view('news')
            ->view('newsCat','cat_name','newsCat.cat_id=news.cat_id','left')
            ->where($where)
            ->order('publish_time DESC')
            ->page($page, 10)
            ->select();
        foreach($list as $k=>$v){
            $list[$k]['content'] = htmlspecialchars_decode($list[$k]['content']);
        }
        $this->ajaxReturn(['status' => 1, 'result' => $list]);
    }

    /**
     * 商品列表页
     */
    public function goodsList(){
        $id = I('get.id/d',0); // 当前分类id
        $lists = getCatGrandson($id);
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    
    public function ajaxGetMore(){
    	$p = I('p/d',1);
        $where = [
            'a.is_hot' => 1,
            'a.exchange_integral'=>0,  //积分商品不显示
            'a.is_on_sale' => 1
        ];

    	$favourite_goods = M('goods')->alias('a')->where($where)->order('a.sort DESC')->page($p,C('PAGESIZE'))->cache(true,TPSHOP_CACHE_TIME)->join('__GOODS_LABEL__ b','a.label_id = b.label_id','left')->select();//首页推荐商品
        set_goods_label_name($favourite_goods);
    	$this->assign('favourite_goods',$favourite_goods);
    	return $this->fetch();
    }
    
    //微信Jssdk 操作类 用分享朋友圈 JS
    public function ajaxGetWxConfig()
    {
        $askUrl = input('askUrl');//分享URL
        $askUrl = urldecode($askUrl);

        $wechat = new WechatUtil;
        $signPackage = $wechat->getSignPackage($askUrl);
        if (!$signPackage) {
            exit($wechat->getError());
        }

        $this->ajaxReturn($signPackage);
    }
    /**
     * APP下载地址, 如果APP不存在则显示WAP端地址
     * @return \think\mixed
     */
    public function app_down(){

        $server_host = 'http://'.$_SERVER['HTTP_HOST'];
        $showTip = false;
        if(tpCache('ios.app_path') && strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
            //苹果:直接指向AppStore下载
            $down_url = tpCache('ios.app_path');
        }else if(tpCache('android.app_path') && strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
            // 安卓:需要拼接下载地址
            $down_url = $server_host.'/'.tpCache('android.app_path');
            //如果是安卓手机微信打开, 则显示"其他浏览器打开"提示
            (strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') && strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) && $showTip = true;
        }

        $wap_url = $server_host.'/Mobile';
        /*  echo "down_url : ".$down_url;
         echo "wap_url : ".wap_url;
         echo "<br/>showTip : ".$showTip; */
        $this->assign('showTip' , $showTip);
        $this->assign('down_url' , $down_url);
        $this->assign('wap_url' , $wap_url);
        return $this->fetch();
    }
}