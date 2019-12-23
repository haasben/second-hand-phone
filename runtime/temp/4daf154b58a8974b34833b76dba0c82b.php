<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"D:\WWW\shop/application/index\view\index\index.html";i:1576739871;s:53:"D:\WWW\shop\application\index\view\common\footer.html";i:1576739977;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>首页</title>
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/style.css"/>
		<link rel="stylesheet" type="text/css" href="/public/static/index/js/swiper/css/swiper.min.css"/>
	</head>
	<body>
		<div class="container">
			<header>
				<input type="search" class="to_search" placeholder="搜索商品,获得更多好货">
			</header>
			<main class="contents">
				<!-- banner -->
				<div class="banner">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php if(is_array($index_data['banner']) || $index_data['banner'] instanceof \think\Collection || $index_data['banner'] instanceof \think\Paginator): $i = 0; $__LIST__ = $index_data['banner'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<div class="swiper-slide">
								<img src="<?php echo $v['ad_code']; ?>" >
							</div>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
				</div>
				<!-- 分类 -->
				<div class="category">
					<ul>
						<?php if(is_array($index_data['cates']) || $index_data['cates'] instanceof \think\Collection || $index_data['cates'] instanceof \think\Paginator): $i = 0; $__LIST__ = $index_data['cates'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="javascript:">
								<img src="<?php echo $v['image']; ?>" >
								<span><?php echo $v['name']; ?></span>
							</a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						
					</ul>
				</div>
				
				<!-- 今日秒杀 -->
				<div class="adv">
					<div class="adv_seckill">
						<span>限时秒杀</span>
						<div class="img-box">
							<?php if(is_array($index_data['spike_ad']) || $index_data['spike_ad'] instanceof \think\Collection || $index_data['spike_ad'] instanceof \think\Paginator): $i = 0; $__LIST__ = $index_data['spike_ad'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<img src="<?php echo $v['ad_code']; ?>" >
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						
					</div>
					<div class="adv_recovery">
						<span>手机回收</span>
						<div class="wrap">
							<p>极速打款有保障,最高加价20%</p>
							<?php if(is_array($index_data['recover_ad']) || $index_data['recover_ad'] instanceof \think\Collection || $index_data['recover_ad'] instanceof \think\Paginator): $i = 0; $__LIST__ = $index_data['recover_ad'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<img src="<?php echo $v['ad_code']; ?>" >
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						
					</div>
				</div>
				<!-- 为你推荐 -->
				<div class="goods_list">
					<div class="img-title">
						<img src="/public/static/index/img/rec.png" >
					</div>
					<ul>
					<?php if(is_array($index_data['promotions']) || $index_data['promotions'] instanceof \think\Collection || $index_data['promotions'] instanceof \think\Paginator): $i = 0; $__LIST__ = $index_data['promotions'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="javascript:">
								<div class="img-box">
									<img src="<?php echo $v['prom_img']; ?>" >
								</div>
								<div class="title">
									<p><?php echo $v['title']; ?></p>
									<span>剩余<?php echo $v['days']; ?>天</span>
								</div>
								<p class="explain"><?php echo $v['subtitle']; ?></p>
							</a>
						</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			
			</main>
<footer>
	<dl>
		<a href="/">
			<dt class="i">&#xe65b;</dt>
			<dd>首页</dd>
		</a>
	</dl>
	<dl>
		<a href="<?php echo url('index/category/index'); ?>">
			<dt class="i">&#xe659;</dt>
			<dd>分类</dd>
		</a>
	</dl>
	<dl>
		<a href="cart.html">
			<dt class="i">&#xe658;</dt>
			<dd>购物车</dd>
		</a>
	</dl>
	<dl>
		<a href="mine">
			<dt class="i">&#xe65d;</dt>
			<dd>我的</dd>
		</a>
	</dl>
</footer>
</div>

<script src="/public/static/index/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/public/static/index/js/public.js" type="text/javascript" charset="utf-8"></script>			
			
		<script src="/public/static/index/js/swiper/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			var myMobileSwiper = new Swiper ('.swiper-container', {
				direction: 'horizontal', // 垂直切换选项
				loop: true, // 循环模式选项
				autoplay: true,
				
				// 如果需要分页器
				pagination: {
				  el: '.swiper-pagination',
				},
			})
			$(function(){
				$('.to_search').on('click',function(){
					window.location.href= "<?php echo url('index/index/search'); ?>";
				})


			})
		</script>
	</body>
</html>
