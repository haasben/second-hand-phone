<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:43:"./application/admin/view/index\welcome.html";i:1575957111;}*/ ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="/public/static/css/index.css" rel="stylesheet" type="text/css">
    <link href="/public/static/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
    <link href="/public/static/css/purebox.css" rel="stylesheet" type="text/css">
    <link href="/public/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/public/static/js/jquery.js"></script>
    <script type="text/javascript" src="/public/static/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/public/static/js/jquery.cookie.js"></script>
</head>

<body class="iframe_body">
<div class="warpper">
	<div class="index-leftpt">
<!--     	<div class="index-bisinfo">
        	<h3>基本信息<em></em></h3>
            <div class="bisinfo-con">
            	<span>店铺名称：<b><?php echo $tpshop_config['shop_info_store_name']; ?></b></span>

            </div>
        </div> -->
        <div class="index-busiinfo">
        	<div class="indbus-tit">
            	<h3>经营概括<a href="javascript:void(0)" id="date-vis"></a></h3>
                <span>更新时间：<?php echo date('Y-m-d');?><!--<a href="javascript:void(0);">更多数据&gt;&gt;</a>--></span>
            </div>
            <div class="busiinfo-con">
            	<div class="cont h-cont">
                	<img src="/public/static/images/busiic01.png" alt="">
                    <span><b onclick="javascript:openItem('index|Order');"><?php echo $count['new_order']; ?></b><i>今日订单</i></span>
                    <!--<span><b>0.00</b><i>今日交易额</i></span>-->
                    <span><b onclick="javascript:openItem('user|Report');"><?php echo $count['new_users']; ?></b><i>今日会员数</i></span>
                    <span><b onclick="javascript:openItem('index|Order');"><?php echo $count['today_login']; ?></b><i>今日访问量</i></span>
                    <span><b onclick="javascript:openItem('goodsList|Goods');"><?php echo $count['goods']; ?></b><i>商品数量</i></span>
                    <span><b onclick="javascript:openItem('articleList|Article');"><?php echo $count['article']; ?></b><i>文章数量</i></span>
                </div>
                <div class="cont diffcolor b-cont">
                	<img src="/public/static/images/busiic02.png" alt="">
                    <span><b onclick="javascript:openItem('index|Order');"><?php echo $count['handle_order']; ?></b><i>待处理订单</i></span>
                    <span><b onclick="javascript:openItem('index|Comment');"><?php echo $count['comment']; ?></b><i>待审核评论数</i></span>
                    <span><b onclick="javascript:openItem('lowStockWarn|Goods');"><?php echo $count['stock']; ?></b><i>库存预警</i></span>
                    <!--<span><b>2</b><i>待回复消息</i></span>-->
                </div>
            </div>
        </div>
        <div class="index-commfunc">
        	<h3>常用功能</h3>
            <div class="commfunc-con">
                <?php if($is_saas == 1): ?>
            	    <a href="javascript:openItem('index|Miniapp');"><img src="/public/static/images/commfunc01.png" alt=""><i>小程序</i></a>
                <?php endif; ?>
                <a href="javascript:openItem('goodsList|Goods');"><img src="/public/static/images/commfunc02.png" alt=""><i>商品管理</i></a>
                <a href="javascript:openItem('index|Order');"><img src="/public/static/images/commfunc03.png" alt=""><i>订单管理</i></a>
 <!--                <a href="javascript:openItem('change|Template');"><img src="/public/static/images/commfunc04.png" alt=""><i>店铺模板</i></a>
                <a href="javascript:openItem('templateList|Block');"><img src="/public/static/images/commfunc05.png" alt=""><i>首页装修</i></a> -->
                <a href="javascript:openItem('index|User');"><img src="/public/static/images/commfunc06.png" alt=""><i>会员列表</i></a>
                <a href="javascript:openItem('index|System');"><img src="/public/static/images/commfunc07.png" alt=""><i>商城设置</i></a>
            </div>
        </div>
<!--         <div class="index-markfunc">
        	<h3>营销工具</h3>
            <div class="markfunc-con">
            	<a href="javascript:openItem('flash_sale|Promotion');"><b>抢购</b><i>火爆营销抢购商品</i></a>
                <a href="javascript:openItem('group_buy_list|Promotion');"><b>团购</b><i>陌生人社交营销玩法</i></a>
                <a href="javascript:openItem('prom_goods_list|Promotion');"><b>优惠促销</b><i>降价、满减、打折等营销策略</i></a>
                <a href="javascript:openItem('prom_order_list|Promotion');"><b>订单促销</b><i>满赠、买一送二等优惠</i></a>
                <a href="javascript:openItem('index|PreSell');"><b>预售</b><i>预售玩法，充分吸引消费者注意力</i></a>
                <a href="javascript:openItem('index|Team');"><b>拼团</b><i>最新最潮流的熟人社交营销</i></a>
                <a href="javascript:openItem('index|Combination');"><b>搭配购</b><i>不同商品组合搭配，以货带货</i></a>
                <a href="javascript:openItem('index|Coupon');"><b>优惠券</b><i>不同优惠券策略吸引用户参加</i></a>
                <a href="javascript:openItem('index|IntegralMall');"><b>积分兑换</b><i>积分制度极大增加了用户黏性</i></a>
                <a href="javascript:openItem('index|Miniapp');"><b>会员卡</b><i>增加核心用户的必备功能</i></a>
            </div>
        </div> -->
    </div>
    <div class="index-rightpt">
    	<!--<div class="index-adpt"><img src="/public/static/images/indexad.png" alt=""></div>-->
        <!--<div class="index-custom">-->
        	<!--<span>-->
            	<!--<img src="/public/static/images/iconcustomer.png" alt="">-->
                <!--<em><b>遇到问题？</b><i>我们将竭诚为您服务</i></em>-->
            <!--</span>-->
            <!--<a href="javascript:void(0);">在线客服</a>-->
        <!--</div>-->
<!--         <div class="index-problem">
        	<h3>常见问题<a href="http://help.tp-shop.cn/Index/Help/channel/cat_id/5.html">更多解答</a></h3>
            <ul>
            	<li><a href="http://help.tp-shop.cn/Index/Help/info/cat_id/5/id/594.html">1. 小程序/公众号微信支付对接问题</a></li>
                <li><a href="http://help.tp-shop.cn/Index/Help/info/cat_id/2/id/380.html">2. 如何发布微信小程序</a></li>
                <li><a href="http://help.tp-shop.cn/Index/Help/info/cat_id/2/id/494.html">3. 小程序部署与安装</a></li>
                <li><a href="http://help.tp-shop.cn/Index/Help/info/cat_id/5/id/561.html">4. 如何装修商城首页</a></li>
            </ul>
        </div> -->
        <!--<div class="index-updatelog">-->
        	<!--<h3>更新日志<a href="javascript:void(0)">更多内容</a></h3>-->
            <!--<ul>-->
            	<!--<li><a href="javascript:void(0)">1. 更新日志标题</a></li>-->
                <!--<li><a href="javascript:void(0)">2. 更新日志</a></li>-->
                <!--<li><a href="javascript:void(0)">3. 今日更新</a></li>-->
                <!--<li><a href="javascript:void(0)">4. 日志详情</a></li>-->
            <!--</ul>-->
        <!--</div>-->
    </div>
</div>
<script>
$("#date-vis").addClass("vis");
$("#date-vis").click(function(){
	$(this).toggleClass("vis").toggleClass("hid");
    var data_eyes = {
        parameter:['<?php echo $count['new_order']; ?>','<?php echo $count['new_users']; ?>','<?php echo $count['today_login']; ?>','<?php echo $count['goods']; ?>','<?php echo $count['article']; ?>'],
        ptitle:['今日订单','今日会员数','今日访问量','商品数量','文章数量'],
        bSummary:['<?php echo $count['handle_order']; ?>','<?php echo $count['comment']; ?>','<?php echo $count['stock']; ?>'],
        bTitle:['待处理订单','待审核评论数','库存预警']
    };
    var de_html = '<img src="/public/static/images/busiic01.png" alt="">';
    var b_html = '<img src="/public/static/images/busiic02.png" alt="">';
    if($(this).hasClass('vis')){
        for(var i in data_eyes.parameter){
            de_html += ` <span><b>${data_eyes.parameter[i]}</b><i>${data_eyes.ptitle[i]}</i></span>`
        }
        $('.h-cont').html(de_html)
        for(var i in data_eyes.bSummary){
            b_html += `<span><b>${data_eyes.bSummary[i]}</b><i>${data_eyes.bTitle[i]}</i></span>`
        }
        $('.b-cont').html(b_html)
    }else{
        for(var i in data_eyes.parameter){
            de_html += ` <span><b>**</b><i>${data_eyes.ptitle[i]}</i></span>`
        }
        $('.h-cont').html(de_html)
        for(var i in data_eyes.bSummary){
            b_html += ` <span><b>**</b><i>${data_eyes.bTitle[i]}</i></span>`
        }
        $('.b-cont').html(b_html)
    }
})

function openItem(param) {
    data_str = param.split('|');
    $.cookie('workspaceParam', data_str[0] + '|' + data_str[1], { expires: 1 ,path:"/"});
    top.location.reload()
}
</script>
</body>
</html>