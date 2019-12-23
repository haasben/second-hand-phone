<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use app\common\logic\CartLogic;
use app\common\logic\UsersLogic;
use app\common\logic\wechat\WechatUtil;

class Base extends Controller {
    public $session_id;
    public $weixin_config;
    public $cateTrre = array();
    public $tpshop_config = array();
    public $uid;
    public $list_rows;
    /*
     * 初始化操作
     */
    public function _initialize() {
        

        $uid = session('uid');
        if($uid){
            $this->uid = $uid;
        }
        $this->list_rows = config("paginate")['list_rows'];


        $this->public_assign();
    }

//公共渲染页面数据方法
    public function fetch_view($view,$name,$data){


        if(IS_GET){
            $this->assign($name,$data);
            return $this->fetch($view);
        }

        return return_ajax(1,'success',$data);   

    }
    /**
     * 用于app直接嵌套mobile的页面
     * user_id
     * token
     * app
     */
    public function isApp()
    {
        if(!session('user')){
            $user = M('users')->where(['user_id'=>input('user_id'),'token'=>input('token')])->find();
            if($user){
                session('uid',$user['user_id']);
                session('user',$user);
            }
        }
    }

    /**
     * 保存公告变量到 smarty中 比如 导航 
     */   
    public function public_assign()
    {
  
       //  $first_login = session('first_login');
       //  $this->assign('first_login', $first_login);
       //  if (!$first_login && ACTION_NAME == 'login') {
       //      session('first_login', 1);
       //  }
       // $tp_config = Db::name('config')->cache(true, TPSHOP_CACHE_TIME, 'config')->select();
       // foreach($tp_config as $k => $v)
       // {
       // 	  if($v['name'] == 'hot_keywords'){
       // 	  	 $this->tpshop_config['hot_keywords'] = explode('|', $v['value']);
       // 	  }
       //     $this->tpshop_config[$v['inc_type'].'_'.$v['name']] = $v['value'];
       // }
       // $goods_category_tree = get_goods_category_tree();
       // $this->cateTrre = $goods_category_tree;
       // $this->assign('goods_category_tree', $goods_category_tree);                     
       // $brand_list = M('brand')->cache(true,TPSHOP_CACHE_TIME)->field('id,cat_id,logo,is_hot')->where("cat_id>0")->select();
       // $this->assign('brand_list', $brand_list);
       // $this->assign('tpshop_config', $this->tpshop_config);
       // /** 修复首次进入微商城不显示用户昵称问题 **/
       // $user_id = cookie('user_id');
       // $uname = cookie('uname');
       // if(empty($user_id) && ($users = session('user')) ){
       //     $user_id = $users['user_id'];
       //     $uname = $users['nickname'];
       // }
       // $this->assign('user_id',$user_id);
       // $this->assign('uname',$uname);
      
    }      

    // 网页授权登录获取 OpendId
    public function GetOpenid()
    {
        if($_SESSION['openid'])
            return $_SESSION['data'];
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            //$baseUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            $baseUrl = urlencode($this->get_url());
            $url = $this->__CreateOauthUrlForCode($baseUrl); // 获取 code地址
            Header("Location: $url"); // 跳转到微信授权页面 需要用户确认登录的页面
            exit();
        } else {
            //上面获取到code后这里跳转回来
            $code = $_GET['code'];
            $data = $this->getOpenidFromMp($code);//获取网页授权access_token和用户openid
            $data2 = $this->GetUserInfo($data['access_token'],$data['openid']);//获取微信用户信息
            $data['nickname'] = empty($data2['nickname']) ? '微信用户' : trim($data2['nickname']);
            $data['sex'] = $data2['sex'];
            $data['head_pic'] = $data2['headimgurl']; 
            $data['subscribe'] = $data2['subscribe'];      
            $data['oauth_child'] = 'mp';
            $_SESSION['openid'] = $data['openid'];
            $data['oauth'] = 'weixin';
            $user_id = Db::name('oauth_users')->where('openid',$data['openid'])->value('user_id');
            if($user_id){
                Db::name('users')->where('user_id',$user_id)->update(['head_pic'=>$data['head_pic']]);
            }
            if(isset($data2['unionid'])){
            	$data['unionid'] = $data2['unionid'];
            }
            $_SESSION['data'] =$data;
            return $data;
        }
    }

    /**
     * 获取当前的url 地址
     * @return type
     */
    private function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }    
    
    /**
     *
     * 通过code从工作平台获取openid机器access_token
     * @param string $code 微信跳转回来带上的code
     *
     * @return openid
     */
    public function GetOpenidFromMp($code)
    {
        //通过code获取网页授权access_token 和 openid 。网页授权access_token是一次性的，而基础支持的access_token的是有时间限制的：7200s。
    	//1、微信网页授权是通过OAuth2.0机制实现的，在用户授权给公众号后，公众号可以获取到一个网页授权特有的接口调用凭证（网页授权access_token），通过网页授权access_token可以进行授权后接口调用，如获取用户基本信息；
    	//2、其他微信接口，需要通过基础支持中的“获取access_token”接口来获取到的普通access_token调用。
        $url = $this->__CreateOauthUrlForOpenid($code);       
        $ch = curl_init();//初始化curl        
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);//设置超时
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);         
        $res = curl_exec($ch);//运行curl，结果以jason形式返回            
        $data = json_decode($res,true);         
        curl_close($ch);
        return $data;
    }
    
    
        /**
     *
     * 通过access_token openid 从工作平台获取UserInfo      
     * @return openid
     */
    public function GetUserInfo($access_token,$openid)
    {         
        // 获取用户 信息
        $url = $this->__CreateOauthUrlForUserinfo($access_token,$openid);
        $ch = curl_init();//初始化curl        
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);//设置超时
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);         
        $res = curl_exec($ch);//运行curl，结果以jason形式返回            
        $data = json_decode($res,true);            
        curl_close($ch);
        //获取用户是否关注了微信公众号， 再来判断是否提示用户 关注
        //if(!isset($data['unionid'])){
            $wechat = new WechatUtil($this->weixin_config);
            $fan = $wechat->getFanInfo($openid);//获取基础支持的access_token
            if ($fan !== false) {
                $data['subscribe'] = $fan['subscribe'];
            }
        //}
        return $data;
    }

    /**
     *
     * 构造获取code的url连接
     * @param string $redirectUrl 微信服务器回跳的url，需要url编码
     *
     * @return 返回构造好的url
     */
    private function __CreateOauthUrlForCode($redirectUrl)
    {
        $urlObj["appid"] = $this->weixin_config['appid'];
        $urlObj["redirect_uri"] = "$redirectUrl";
        $urlObj["response_type"] = "code";
//        $urlObj["scope"] = "snsapi_base";
        $urlObj["scope"] = "snsapi_userinfo";
        $urlObj["state"] = "STATE"."#wechat_redirect";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
    }

    /**
     *
     * 构造获取open和access_toke的url地址
     * @param string $code，微信跳转带回的code
     *
     * @return 请求的url
     */
    private function __CreateOauthUrlForOpenid($code)
    {
        $urlObj["appid"] = $this->weixin_config['appid'];
        $urlObj["secret"] = $this->weixin_config['appsecret'];
        $urlObj["code"] = $code;
        $urlObj["grant_type"] = "authorization_code";
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
    }

    /**
     *
     * 构造获取拉取用户信息(需scope为 snsapi_userinfo)的url地址     
     * @return 请求的url
     */
    private function __CreateOauthUrlForUserinfo($access_token,$openid)
    {
        $urlObj["access_token"] = $access_token;
        $urlObj["openid"] = $openid;
        $urlObj["lang"] = 'zh_CN';        
        $bizString = $this->ToUrlParams($urlObj);
        return "https://api.weixin.qq.com/sns/userinfo?".$bizString;                    
    }    
    
    /**
     *
     * 拼接签名字符串
     * @param array $urlObj
     *
     * @return 返回已经拼接好的字符串
     */
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign"){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
    public function ajaxReturn($data){
        exit(json_encode($data));
    }

}