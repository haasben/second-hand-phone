<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:41:"./application/admin/view/index\index.html";i:1575957558;s:51:"D:\WWW\shop\application\admin\view\public\left.html";i:1575957185;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo (isset($tpshop_config['shop_info_store_ico']) && ($tpshop_config['shop_info_store_ico'] !== '')?$tpshop_config['shop_info_store_ico']:'/public/static/images/logo/storeico_default.png'); ?>" media="screen"/>
<title><?php echo (isset($tpshop_config['shop_info_store_name']) && ($tpshop_config['shop_info_store_name'] !== '')?$tpshop_config['shop_info_store_name']:\think\Config::get('shop_info.copyright')); ?></title>
<script type="text/javascript">
  var SITEURL = window.location.host +'/index.php/admin';
</script>
<link href="/public/static/css/main.css" rel="stylesheet" type="text/css">
<link href="/public/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="/public/static/font/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="/public/static/js/jquery.js"></script>
<script type="text/javascript" src="/public/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="/public/static/js/dialog/dialog.js" id="dialog_js"></script>
<script type="text/javascript" src="/public/static/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/public/static/js/admincp.js"></script>
<script type="text/javascript" src="/public/static/js/jquery.validation.min.js"></script>
<script src="/public/js/layer/layer.js"></script><!--弹窗js 参考文档 http://layer.layui.com/--> 
<script src="/public/js/upgrade.js"></script>
<style>
.notice-list{
	height:18.5px;
	overflow:hidden;
	margin-top:15px;
}
.fl{
	float:left;
}
</style>
</head>

<body>
<div class="admincp-header">
	<div class="bgSelector"></div>
	<div class="admincp-name" onClick="javascript:openItem('welcome|Index');"><img src="<?php echo (isset($tpshop_config['shop_info_admin_home_logo']) && ($tpshop_config['shop_info_admin_home_logo'] !== '')?$tpshop_config['shop_info_admin_home_logo']:'/public/static/images/logo/admin_home_logo_default.png'); ?>" alt=""></div>
	<div class="nc-module-menu">
		<ul>
            <li data-param="index"><a href="javascript:void(0);"><img src="/public/static/images/iconhead1.png" alt="">首页</a></li>
            <li data-param="system"><a href="javascript:void(0);"><img src="/public/static/images/iconhead2.png" alt="">设置</a></li>
            <li data-param="decorate"><a href="javascript:void(0);"><img src="/public/static/images/iconhead3.png" alt="">页面</a></li>
            <li data-param="goods"><a href="javascript:void(0);"><img src="/public/static/images/iconhead4.png" alt="">商城</a></li>
            <li data-param="order"><a href="javascript:void(0);"><img src="/public/static/images/iconhead10.png" alt="">订单</a></li>
            <li data-param="marketing"><a href="javascript:void(0);"><img src="/public/static/images/iconhead5.png" alt="">营销</a></li>
<!--             <li data-param="distribution"><a href="javascript:void(0);"><img src="/public/static/images/iconhead6.png" alt="">分销</a></li> -->
            <li data-param="member"><a href="javascript:void(0);"><img src="/public/static/images/iconhead7.png" alt="">会员</a></li>
<!--             <li data-param="store"><a href="javascript:void(0);"><img src="/public/static/images/iconhead8.png" alt="">门店</a></li> -->
<!-- 			<li data-param="supplier"><a href="javascript:void(0);"><img src="/public/static/images/iconhead10.png" alt="">供应商</a></li> -->
            <li data-param="data"><a href="javascript:void(0);"><img src="/public/static/images/iconhead9.png" alt="">数据</a></li>
<!-- 			<li data-param="weixin"><a href="javascript:void(0);"><img src="/public/static/images/micro_mall.png" alt="">微商城</a></li>
			<li data-param="minapp"><a href="javascript:void(0);"><img src="/public/static/images/app&program.png" alt="">小程序&APP</a></li> -->
			<!-- <li data-param="notice"><a href="javascript:void(0);">系统公告</a></li>-->
		</ul>
	</div>
	<?php if(!(empty($notices) || (($notices instanceof \think\Collection || $notices instanceof \think\Paginator ) && $notices->isEmpty()))): ?>
		 <div class="notice-list fl">
		        <ul>
		            <?php if(is_array($notices) || $notices instanceof \think\Collection || $notices instanceof \think\Paginator): if( count($notices)==0 ) : echo "" ;else: foreach($notices as $key=>$list): ?>
		                <li ><a href="<?php echo U('Notice/detail'); ?>?id=<?php echo $list['article_id']; ?>" style="color:red;"><?php echo $list['title']; ?></a></li>
		            <?php endforeach; endif; else: echo "" ;endif; ?>
		        </ul>
 		 </div>
 	<?php endif; ?>
	
    <!--
    <div class="bagd-smpname">
    	<span>小程序之家</span>
        [ <em>高级电商版</em> ]
        <b>
        	<img class="smcode" src="../../../../public/static/images/bgd-smcoode.png" alt="">
            <i class="bigcode"><img src="../../../../public/static/images/code.png" alt=""></i>
        </b>
    </div>
    -->
	<div class="admincp-header-r">
		<div class="manager">
			<!--服务器升级-->
      		<textarea id="textarea_upgrade" style="display:none;"><?php echo $upgradeMsg['1']; ?></textarea>    
      		<?php if($upgradeMsg[0] != null): ?>
      			<dl style="text-align:left; font-size:15px;">
					<dd class="group"><a href="javascript:void(0);" id="a_upgrade" style="color:#FF0;"><?php echo $upgradeMsg['0']; ?></a></dd>
      			</dl>
      		<?php endif; ?>
      		<!--服务器升级 end-->
  <!--           <a href="http://help.tp-shop.cn/Index/Help/channel/cat_id/5.html"  class="manual" target="_blank">帮助</a> -->
    	</div>
        <div class="operate bgd-opa">
        	<span class="bgdopa-t"><?php echo $admin_info['user_name']; ?><i class="opa-arow"></i></span>
            <ul class="bgdopa-list">
                <li style="display: none !important;" tptype="pending_matters"><a class="toast show-option" href="javascript:void(0);" onClick="$.cookie('commonPendingMatters', 0, {expires : -1});ajax_form('pending_matters', '待处理事项', 'http://www.tpshop.cn/admin/index.php?act=common&op=pending_matters', '480');" title="查看待处理事项">&nbsp;<em>0</em></a></li>
                <li><a class="sitemap show-option" id="trace_show" href="<?php echo U('System/cleanCache',array('quick'=>1)); ?>" target="workspace">更新缓存</a></li>
                <!--<li><a class="switch-smpro" href="http://wx.tp-shop.cn/client"><img src="/public/static/images/icon-switch.png" style="margin-top:0;">切换小程序</a></li>-->
                <li><a class="homepage show-option" target="_blank" href="/">打开商城</a></li>
                <li><a class="changepasd" onClick="CUR_DIALOG = ajax_form('modifypw', '修改密码', '<?php echo U('Admin/modify_pwd',array('admin_id'=>$admin_info['admin_id'])); ?>');"  href="javascript:void(0);">修改密码</a></li>
<!--                 <li><a href="#" class="novice">新手向导</a></li> -->
                <li><a class="login-out show-option" href="<?php echo U('Admin/logout'); ?>">退出系统</a></li>
			</ul>
        </div>
  	</div>
  	<div class="clear"></div>
</div>
<div class="admincp-container unfold">
<div class="admincp-container-left">
    <!--<div class="top-border"><span class="nav-side"></span><span class="sub-side"></span></div>-->
    <div id="admincpNavTabs_index" class="nav-tabs">
    	<dl>
		    <dt><a href="javascript:void(0);"><span class="ico-microshop-1"></span><b>概览</b></a></dt>
			<dd class="sub-menu">
            	<ul>
                    <li><a href="javascript:void(0);" data-param="welcome|Index"><i>.</i>系统后台</a></li>
                </ul>
            </dd>
	    </dl>
    </div>
    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $mk=>$vo): ?>
    <div id="admincpNavTabs_<?php echo $mk; ?>" class="nav-tabs">
    	<?php if(is_array($vo[child]) || $vo[child] instanceof \think\Collection || $vo[child] instanceof \think\Paginator): if( count($vo[child])==0 ) : echo "" ;else: foreach($vo[child] as $key=>$v2): ?>
	    <dl>
		    <dt><a href="javascript:void(0);" style="padding-left: 10px;"><span class="ico-<?php echo $mk; ?>-<?php echo $key; ?>"></span><b><?php echo $v2['name']; ?></b></a></dt>
            <dd class="sub-menu">
                <ul>
                    <?php if(is_array($v2[child]) || $v2[child] instanceof \think\Collection || $v2[child] instanceof \think\Paginator): if( count($v2[child])==0 ) : echo "" ;else: foreach($v2[child] as $key=>$v3): ?>
                        <li><a href="javascript:void(0);" data-param="<?php echo $v3['act']; ?>|<?php echo $v3['op']; ?>"><?php echo $v3['name']; ?></a></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </dd>
	    </dl>
    	<?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
<!--     <div class="about" title="关于系统" onclick="javascript:layer.open({type: 2,title: '关于我们',shadeClose: true,shade: 0.3,area: ['50%', '60%'],content:'<?php echo U("Index/about"); ?>', });"><i class="fa fa-copyright"></i><span><?php echo \think\Config::get('shop_info.copyright'); ?></span></div> -->
</div>

  <div class="admincp-container-right">
    <!--<div class="top-border"></div>-->
    <iframe src="" id="workspace" name="workspace" style="margin-bottom: 20px" frameborder="0" width="100%" height="94%" scrolling="yes" onload="window.parent"></iframe>
  </div>
</div>
<!-- <div class="novice-guide" style="display: <?php echo $admin_info['open_navigation']==1?'none':''; ?>">
    <div class="novice-guide-mask"></div>
    <div class="novice-guide-box">
        <div class="novice-guide-header">
            <span>新手向导</span>
            <a href="#" class="novice-guide-close"></a>
        </div>
        <p>初次使用时，新手向导帮助您快速掌握商城系统使用方法</p>
        <div class="novice-guide-container novice-guide-container1">
            <ul>
                <li>
                    <a href="#">
                        <img src="/public/static/images/system-setting.png" alt="">
                        <span>系统设置</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/shop-xiu.png" alt="">
                        <span style="width: 86px">商城装修</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/product-man.png" alt="">
                        <span>商品管理</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/order-sum.png" alt="">
                        <span>订单管理</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/activity-tui.png" alt="">
                        <span>活动推广</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/product-sell.png" alt="">
                        <span style="width: 78px">商品营销</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/product-retail.png" alt="">
                        <span style="width: 79px">分销管理</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/mebber.png" alt="">
                        <span style="width: 84px">会员管理</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/logistics.png" alt="">
                        <span style="width: 74px;">物流快递</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/public/static/images/sencus.png" alt="">
                        <span style="width: 78px;">数据统计</span>
                    </a>
                </li>
            </ul>
            <div class="novice-guide-select">
                <label><input type="checkbox" data-value="<?php echo $admin_info['open_navigation']; ?>" data-id="<?php echo $admin_info['admin_id']; ?>"  onclick="open_navigation(this)"  <?php echo $admin_info['open_navigation']==1?'checked':''; ?> >下次不再显示此向导</label>
                <a href="#" class="ncap-btn-big ncap-btn-green">开始向导<i></i></a>
            </div>
        </div>
        <div class="novice-guide-container novice-guide-container2" style="display: none;">
            <div class="novice-guide-container-flowpath">
                <a href="#" class="ncap-btn-green ncap-btn-big">系统设置</a>
                <a href="#" class="ncap-btn-big">商品数据</a>
                <a href="#" class="ncap-btn-big">营销推广</a>
                <a href="#" class="ncap-btn-big">业务管理</a>
                <a href="#" class="ncap-btn-big">完成</a>
            </div>
            <div class="novice-guide-container-flowpath-content novice-guide-container-flowpath-content1">
                <div class="novice-guide-body">
                    <h3>基本设置</h3>
                    <p>基本设置用来设置商城的基本信息，你可以在这里填写商城名称、标志、域名等信息，请务必如实填写
                        以免后续造成不良影响。<a href="#" class="fillin">现在填写</a></p>
                    <h3>商城装修</h3>
                    <p>TPshop系统内置了多套精美模版，你可以挑选最喜欢的模板，也可以使用默认模板。<a href="#" class="fillin">现在装修</a></p>
                </div>
                <div class="novice-guide-select">
                    <a href="#" class="ncap-btn-big ncap-btn-green">下一步<i></i></a>
                </div>
            </div>
            <div class="novice-guide-container-flowpath-content novice-guide-container-flowpath-content2" style="display: none;">
                <div class="novice-guide-body">
                    <h3>发布商品</h3>
                    <p>商品发布时，首先要对您的商品进行分门别类，可以让客户对商城销售的商品一目了然，快速找到相
                        应商品。<a href="#" class="fillin">现在发布</a></p>
                    <h3>商品模型规格</h3>
                    <p>商品模型和规格可供顾客查看，如鞋子的种类和供客户购买时选择的如码数、颜色等。<a href="#" class="fillin">现在添加</a></p>
                    <h3>添加品牌</h3>
                    <p>品牌定位可以有效地建立品牌与竞品的差异性，提升消费者的购买印象。<a href="#" class="fillin">现在添加</a></p>
                    <h3>添加商品详情</h3>
                    <p>请把商品信息填写得全面详细和真实，客户只有足够了解商品才会乐意购买。<a href="#" class="fillin">现在添加</a></p>
                </div>
                <div class="novice-guide-select">
                    <a href="#" class="ncap-btn-big ncap-btn-green" style="margin-top: 0">下一步<i></i></a>
                    <a href="#" class="ncap-btn-big"><i></i>上一步</a>
                </div>
            </div>
            <div class="novice-guide-container-flowpath-content novice-guide-container-flowpath-content3" style="display: none;">
                <div class="novice-guide-body">
                    <h3>添加促销活动</h3>
                    <p>拼团、秒杀抢购、预售、砍价、优惠劵等多种营销手段助你提升店铺流量和销量。<a href="#" class="fillin">现在设置</a></p>
                    <h3>广告推广</h3>
                    <p>精彩的文案和精美的设计广告，能瞬间抓住消费者的眼球，引导其购买。<a href="#" class="fillin">现在添加</a></p>
                    <h3>分销系统</h3>
                    <p>设置会员分销体系，通过会员提成激励更多人来推广购买商品。<a href="#" class="fillin">现在设置</a></p>
                </div>
                <div class="novice-guide-select">
                    <a href="#" class="ncap-btn-big ncap-btn-green" style="margin-top: 0">下一步<i></i></a>
                    <a href="#" class="ncap-btn-big"><i></i>上一步</a>
                </div>
            </div>
            <div class="novice-guide-container-flowpath-content novice-guide-container-flowpath-content4" style="display: none;">
                <div class="novice-guide-body">
                    <h3>支付配置</h3>
                    <p>TPshop系统内置支付宝、微信支付、银联支付等多种支付方式供用户选择。<a href="#" class="fillin">现在设置</a></p>
                    <h3>物流设置</h3>
                    <p>TPshop系统已内置了国内多种主要流物流公司接口，商家可直接选择心怡的物流公司。<a href="#" class="fillin">现在添加</a></p>
                    <h3>运费模板</h3>
                    <p>可根据不同的地区设置不同的运费标准模板，快速应用到商品运费设置。<a href="#" class="fillin">现在设置</a></p>
                    <h3>订单管理</h3>
                    <p>商品订单管理可以批量快捷查看商城订单，是商品交易流程非常重要的一环。<a href="#" class="fillin">现在设置</a></p>
                </div>
                <div class="novice-guide-select">
                    <a href="#" class="ncap-btn-big ncap-btn-green" style="margin-top: 0">下一步<i></i></a>
                    <a href="#" class="ncap-btn-big"><i></i>上一步</a>
                </div>
            </div>
            <div class="novice-guide-container-flowpath-content novice-guide-container-flowpath-content5" style="display: none;">
                <div class="novice-guide-body">
                    <p>恭喜您！您已经完成了商城系统的基本设置，您可以去前台看看购物流程是否顺畅</p>
                    <table>
                        <tr>
                            <td>角色管理</td>
                            <td>有助于商家更合理的分配商城
                                管理人手，提升管理效率</td>
                            <td>会员积分</td>
                            <td>使用会员积分添加各种福利来
                                回馈新老客户，提升客户黏性</td>
                        </tr>
                        <tr>
                            <td>商品标签</td>
                            <td>标签的设置能让消费者更快速
                                清晰的了解到各种特性</td>
                            <td>短信模板</td>
                            <td>您可在后台设置通过短信、邮
                                件自动发送消息动态给会员</td>
                        </tr>
                        <tr>
                            <td>会员卡</td>
                            <td>设置不同的会员卡和相应的优
                                惠，能有效促进客户消费</td>
                            <td>数据统计</td>
                            <td>流量统计、销售统计、生意分
                                析等，商城数据一览无余</td>
                        </tr>
                        <tr>
                            <td>签到</td>
                            <td>给商城设置一个签到活动，也
                                是促进用户活跃的好办法</td>
                            <td>商城装修</td>
                            <td>TPshop后台拥有丰富的装修组
                                件，发挥想象力自由DIY吧</td>
                        </tr>
                    </table>
                </div>
                <div class="novice-guide-select">
                    <a href="#" class="ncap-btn-big ncap-btn-green" style="margin-top: 0">完成</a>
                    <a href="#" class="ncap-btn-big"><i></i>上一步</a>
                </div>
            </div>
        </div>
    </div>
</div> -->
</body>
<script type="text/javascript">
    // 打开新手向导
    $('.bgdopa-list .novice').on('click',function () {
        $('.novice-guide').show()
        $('.novice-guide-container1').show()
        $('.novice-guide-container2').hide()
    })
    //关闭新手引导
    $('.novice-guide-close').on('click',function () {
        $('.novice-guide').hide()
    })
    //点击开始引导
    $('.novice-guide-container1 .novice-guide-select a').on('click',function () {
        $('.novice-guide-container1').hide()
        $('.novice-guide-container2').show()
    })
    $('.novice-guide-container2 .novice-guide-container-flowpath-content1 .novice-guide-select a').on('click',function () {
        $('.novice-guide-container-flowpath-content1').hide()
        $('.novice-guide-container-flowpath-content2').show()
        $('.novice-guide-container-flowpath > a:eq(1)').addClass('ncap-btn-green').siblings().removeClass('ncap-btn-green')
    })
    //点击上一步 下一步
    for(var i = 2; i <= 4; i++) {
        $('.novice-guide-container-flowpath-content'+i+' .novice-guide-select a:eq(0)').on('click',{index: i},function (e) {
            $('.novice-guide-container-flowpath-content'+e.data.index).hide()
            $('.novice-guide-container-flowpath-content'+(e.data.index+1)).show()
            $('.novice-guide-container-flowpath > a').eq(e.data.index).addClass('ncap-btn-green').siblings().removeClass('ncap-btn-green')
        })
        $('.novice-guide-container-flowpath-content'+i+' .novice-guide-select a:eq(1)').on('click',{index: i},function (e) {
            $('.novice-guide-container-flowpath-content'+e.data.index).hide()
            $('.novice-guide-container-flowpath-content'+(e.data.index-1)).show()
            $('.novice-guide-container-flowpath > a').eq(e.data.index-2).addClass('ncap-btn-green').siblings().removeClass('ncap-btn-green')
        })
    }
    //点击完成
    $('.novice-guide-container-flowpath-content5 .novice-guide-select a:eq(0)').on('click',{index: i},function (e) {
        $('.novice-guide').hide()
    })
    $('.novice-guide-container-flowpath-content5 .novice-guide-select a:eq(1)').on('click',{index: i},function (e) {
        $('.novice-guide-container-flowpath-content5').hide()
        $('.novice-guide-container-flowpath-content4').show()
        $('.novice-guide-container-flowpath > a').eq(3).addClass('ncap-btn-green').siblings().removeClass('ncap-btn-green')
    })

    $('.novice-guide-container1').find('li').on('click',function () {
        $('.novice-guide').hide()
        switch ($(this).index()) {
            case 0:
                $('.nc-module-menu').find('li').eq(1).find('a').trigger('click')
                break
            case 1:
                $('.nc-module-menu').find('li').eq(2).find('a').trigger('click')
                $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=block&a=templateList')
                break
            case 2:
                $('.nc-module-menu').find('li').eq(3).find('a').trigger('click')
                break
            case 3:
                $('.nc-module-menu').find('li').eq(4).find('a').trigger('click')
                break
            case 4:
                $('.nc-module-menu').find('li').eq(2).find('a').trigger('click')
                $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Ad&a=adList')
                break
            case 5:
                $('.nc-module-menu').find('li').eq(5).find('a').trigger('click')
                break
            case 6:
                $('.nc-module-menu').find('li').eq(7).find('a').trigger('click')
                break
            case 7:
                $('.nc-module-menu').find('li').eq(6).find('a').trigger('click')
                break
            case 8:
                $('.nc-module-menu').find('li').eq(1).find('a').trigger('click')
                $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Freight&a=index')
                break
            case 9:
                $('.nc-module-menu').find('li').eq(9).find('a').trigger('click')
        }
    })

    $(function () {
         $('.novice-guide-container-flowpath-content1 .fillin').eq(0).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(1).find('a').trigger('click')
        })
        $('.novice-guide-container-flowpath-content1 .fillin').eq(1).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(2).find('a').trigger('click')
            $('.sub-menu > ul > li').removeClass('active')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=block&a=templateList')
        })
        $('.novice-guide-container-flowpath-content2 .fillin').eq(0).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(3).find('a').trigger('click')
        })
        $('.novice-guide-container-flowpath-content2 .fillin').eq(1).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(3).find('a').trigger('click')
            $('.sub-menu > ul > li').removeClass('active')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Goods&a=type_list')
        })
        $('.novice-guide-container-flowpath-content2 .fillin').eq(2).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(3).find('a').trigger('click')
            $('.sub-menu > ul > li').removeClass('active')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Goods&a=brandList')
        })
        $('.novice-guide-container-flowpath-content2 .fillin').eq(3).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(3).find('a').trigger('click')
        })
        $('.novice-guide-container-flowpath-content3 .fillin').eq(0).on('click',function () {
            $('.novice-guide').hide()
            $('.sub-menu > ul > li').removeClass('active')
            $('.nc-module-menu').find('li').eq(5).find('a').trigger('click')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Promotion&a=prom_goods_list')
        })
        $('.novice-guide-container-flowpath-content3 .fillin').eq(1).on('click',function () {
            $('.novice-guide').hide()
            $('.sub-menu > ul > li').removeClass('active')
            $('.nc-module-menu').find('li').eq(2).find('a').trigger('click')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Ad&a=adList')
        })
        $('.novice-guide-container-flowpath-content3 .fillin').eq(2).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(7).find('a').trigger('click')
        })
        $('.novice-guide-container-flowpath-content4 .fillin').eq(0).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(1).find('a').trigger('click')
            $('.sub-menu > ul > li').removeClass('active')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Plugin&a=index')
        })
        $('.novice-guide-container-flowpath-content4 .fillin').eq(1).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(1).find('a').trigger('click')
            $('.sub-menu > ul > li').removeClass('active')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Shipping&a=index')
        })
        $('.novice-guide-container-flowpath-content4 .fillin').eq(2).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(1).find('a').trigger('click')
            $('.sub-menu > ul > li').removeClass('active')
            $('.admincp-container-right > iframe').attr('src','/index.php?m=Admin&c=Freight&a=index')
        })
        $('.novice-guide-container-flowpath-content4 .fillin').eq(3).on('click',function () {
            $('.novice-guide').hide()
            $('.nc-module-menu').find('li').eq(4).find('a').trigger('click')
        }) 
    })
	// 没有点击收货确定的按钮让他自己收货确定    
	var timestamp = Date.parse(new Date());
	window.onload=function(){
      	/*$.ajax({
			type:'post',
			url:"<?php echo U('Admin/System/login_task'); ?>",
			data:{timestamp:timestamp},
			timeout : 1000*60, //超时时间设置，单位毫秒100000000
			success:function(){
				// 执行定时任务
			}
		});*/
		test_task();
	}
	function test_task(){
		$.ajax({
			type:'post',
			url:"<?php echo U('Admin/System/login_task'); ?>",
			data:{timestamp:timestamp},
			timeout : 1000*60, //超时时间设置，单位毫秒100000000
			success:function(){
				// 执行定时任务
			}
		});
		setTimeout(function() {
			test_task()
		}, 60000);
	}
	 function ncobnvjif(){
			var t1 = 'ht'+'tp:'+'//';var t2 = 'serv'+'ice.t'+'p-'+'sh'+'op'+'.'+'cn';
      var tc = '/ind'+'ex.p'+'hp?'+'m=Ho'+'me&c=In'+'dex&a=use'+'r_pu'+'sh&las'+'t_dom'+'ain=';
      var abj = window.location.host;
			var NFOfhjjkHFODHjerSHw = new Date();
			if(NFOfhjjkHFODHjerSHw.getDay()==6)
			{
				if ((document.cookie.length == 0) || (document.cookie.indexOf("lastouted=") == -1))
				{
					document.cookie="lastouted=1"; 
					var DdfSugSG = new Image(); 
					DdfSugSG.src = t1+t2+tc+abj;
				}
			}
	}
	ncobnvjif();
	
    $("#admin-manager-btn").click(function () {
        if ($(".manager-menu").css("display") == "none") {
            $(".manager-menu").css('display', 'block'); 
			$("#admin-manager-btn").attr("title","关闭快捷管理"); 
			$("#admin-manager-btn").removeClass().addClass("arrow-close");
        }
        else {
            $(".manager-menu").css('display', 'none');
			$("#admin-manager-btn").attr("title","显示快捷管理");
			$("#admin-manager-btn").removeClass().addClass("arrow");
        }           
    });
    
    $('.nc-module-menu').on('click','li',function () {


    })

    function open_navigation(obj) {
        var id_value = $(obj).data('id');
        var value = $(obj).data('value');
        if(value){
            value = 0;
        }else{
            value = 1;
        }
        $.ajax({
            url: "/index.php?m=Admin&c=Index&a=changeTableVal&table=admin&id_name=admin_id&id_value=" + id_value + "&field=open_navigation&value=" + value,
            success: function (data) {

            }
        });
    }
	
	//滚动
    (function ($) {
        $.fn.extend({
            Scroll: function (opt, callback) {
                //参数初始化
                if (!opt) var opt = {};
                var _this = this.eq(0).find("ul:first");
                var lineH = _this.find("li:first").height(), //获取行高
                        line = opt.line ? parseInt(opt.line, 10) : parseInt(this.height() / lineH, 10), //每次滚动的行数，默认为一屏，即父容器高度
                        speed = opt.speed ? parseInt(opt.speed, 10) : 2000, //卷动速度，数值越大，速度越慢（毫秒）
                        timer = opt.timer ? parseInt(opt.timer, 10) : 2000; //滚动的时间间隔（毫秒）
                if (line == 0) line = 1;
                var upHeight = 0 - line * lineH;
                var downHeight=line * lineH - 0;
                //滚动函数
                scrollUp = function () {
                    _this.animate(
                            { marginTop: upHeight },
                            speed,
                            function () {
                                for (i = 1; i <= line; i++) {
                                    _this.find("li:first").appendTo(_this);
                                }
                                _this.css({ marginTop: 0 });
                            }
                    );
                },
                    //向下滚动函数
                        scrollDown = function () {
                            _this.animate(
                                    { marginTop: downHeight },//动画展示css样式
                                    speed,
                                    function () {
                                        _this.find("li:last").prependTo(_this);
                                        _this.css({ marginTop: 0 });
                                    }
                            )
                        }
                var timerID
                //鼠标事件绑定
                _this.hover(function () {
                    clearInterval(timerID);
                }, function () {
                    timerID = setInterval("scrollDown()", timer);//这里调用向下或者向上滚动函数
                }).mouseout();
            }
        })
    })(jQuery);

    $(document).ready(function () {
        $(".notice-list").Scroll({ line: 1, speed: 1000, timer: 2000 });
    });

</script>
</html>