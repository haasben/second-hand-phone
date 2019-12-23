<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:54:"D:\WWW\shop/application/index\view\category\index.html";i:1576741491;s:53:"D:\WWW\shop\application\index\view\common\footer.html";i:1576741059;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>分类</title>
		<link rel="stylesheet" type="text/css" href="/public/static/index/css/style.css"/>
	</head>
	<body>
		<div class="container">
			<header>
				<input type="search" class="to_search" placeholder="搜索商品,获得更多好货">
			</header>
			
			<main class="contents mall">
				<div class="aside">
					<ul>
						<?php if(is_array($cates['category_list']) || $cates['category_list'] instanceof \think\Collection || $cates['category_list'] instanceof \think\Paginator): $k = 0; $__LIST__ = $cates['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
							
						<li <?php if($k == 1): ?>class="active"<?php endif; ?> data-id="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<div class="conts">
					<ul>
						<?php if(is_array($cates['child_list']) || $cates['child_list'] instanceof \think\Collection || $cates['child_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cates['child_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<li>
							<a href="list.html">
								<img src="<?php echo $v['image']; ?>" >
								<span><?php echo $v['name']; ?></span>
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
<script type="text/javascript">
	$(function(){
		$('.to_search').on('click',function(){
			window.location.href= "<?php echo url('index/index/search'); ?>";
		})
	})


</script>
		<script type="text/javascript">
			$('.aside').on('click', 'li', function(){
				const id = $(this).attr('data-id');
				$(this).addClass('active').siblings().removeClass('active');
				$.post('<?php echo url("index/category/cate_child_list"); ?>',{id:id},function(data){
					if(data.code == 1){
						var html = '';
						$.each(data.data,function(item,v){
							html+='<li><a href="list.html"><img src="'+v.image+'">';
							html+='<span>'+v.name+'</span></a></li>';
						})
						$('.conts>ul').html(html);

					}else{
						alert('接口信息错误');
					}

				})
				return false;
			})
		</script>
	</body>
</html>
