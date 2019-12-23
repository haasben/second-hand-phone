<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"D:\WWW\shop/application/index\view\index\search.html";i:1576123308;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>搜索</title>
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/style.css"/>
	</head>
	<body>
		<div class="container">
			<header>
				<a href="javascript:" onclick="history.go(-1)" class="back"></a>
				<input type="search" class="to_search" placeholder="搜索商品,获得更多好货" value="<?php echo $goods_data['keywords']; ?>">
				<button type="button" class="btn_search">搜索</button>
			</header>
			<div class="contents search">
				<?php if(empty($goods_data['keywords']) || (($goods_data['keywords'] instanceof \think\Collection || $goods_data['keywords'] instanceof \think\Paginator ) && $goods_data['keywords']->isEmpty())): ?>
				<div class="search_box">
					<?php if(!(empty($search['history_record']) || (($search['history_record'] instanceof \think\Collection || $search['history_record'] instanceof \think\Paginator ) && $search['history_record']->isEmpty()))): ?>
					<div class="search_history">
						<h3>历史记录:</h3>
						<ul class="history_list">
							<?php if(is_array($search['history_record']) || $search['history_record'] instanceof \think\Collection || $search['history_record'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($search['history_record']) ? array_slice($search['history_record'],0,6, true) : $search['history_record']->slice(0,6, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="<?php echo url('index/index/search'); ?>?keywords=<?php echo $v; ?>"><?php echo $v; ?></a>
							</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						
						</ul>
						<div class="empty">清空搜索记录</div>
					</div>
					<?php endif; ?>
					<div class="hot_search">
						<h3>热门搜索:</h3>
						<ul class="hot_list">
							<?php if(is_array($search['hot_record']) || $search['hot_record'] instanceof \think\Collection || $search['hot_record'] instanceof \think\Paginator): $i = 0; $__LIST__ = $search['hot_record'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
							<li>
								<a href="<?php echo url('index/index/search'); ?>?keywords=<?php echo $v; ?>"><?php echo $v; ?></a>
							</li>
							
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
				<?php else: ?>
				<div class="result_list" style="">
					<div class="sort">
						<div class="item t1">
							<span>综合</span>
						</div>
						<span>|</span>
						<div class="item t2">销量</div>
						<span>|</span>
						<div class="item t3">筛选</div>
						<ul class="item1">
							<li class="on">综合</li>
							<li>价格最高</li>
							<li>价格最低</li>
						</ul>
					</div>
					<ul>
						<?php if(is_array($goods_data['goods_data']) || $goods_data['goods_data'] instanceof \think\Collection || $goods_data['goods_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $goods_data['goods_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<div class="img">
								<a href="detail.html">
									<img src="<?php echo $v['original_img']; ?>" >
								</a>
							</div>
							<div class="info">
								<a href="detail.html">
									<p class="title"><?php echo $v['goods_name']; ?></p>
									<p class="price">
										<span>￥<?php echo $v['shop_price']; ?></span>
										<span>￥<?php echo $v['market_price']; ?></span>
									</p>
								</a>
								<p class="collect">
										<?php if($v['is_collect'] == 1): ?>
											<img src="/public/static/index/img/collection.png" >
										<?php else: ?>
											<img src="/public/static/index/img/collection1.png" >
										<?php endif; ?>
								</p>
							</div>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
			<!-- 返回顶部 -->
			<div class="to_top"></div>
		</div>
		
		<script src="/public/static/index/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/index/js/public.js" type="text/javascript" charset="utf-8"></script>
		<script src="/public/static/index/js/layer/layer.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			// 清空历史记录
			$('.empty').on('click', function(){
				layer.confirm('确定要清空历史记录吗?', {
					btn:['确定','取消']
				},function(){
					$.post('<?php echo url("index/index/clear_history"); ?>',function(data){
						if(data.code == 1){
							$('.history_list').empty();
							$('.search_history').hide();
						}
						layer.msg(data.msg);
					})
				})
			})
			// 搜索
			$('.btn_search').on('click', function(){
				let keyword = $('.to_search').val();
				if(keyword == ''){
					layer.msg('请输入搜索条件');
					return false;
				}
				window.location.href = "<?php echo url('index/index/search'); ?>?keywords="+keyword;
				// $.post('<?php echo url(""); ?>')
			})
		
			let isBool = false;
			$('.sort').on('click', '.t1', function(){
				if(!isBool){
					$('.item1').slideDown();
				}
				else{
					$('.item1').slideUp();
				}
				isBool = !isBool;
			})
		</script>
	</body>
</html>
