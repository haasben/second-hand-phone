~function (designWidth) {
	let devW=''
   let computed= function () {
		let desW=750;//设计稿宽度
		devW=document.documentElement.clientWidth;//当前设备的宽度
		if(devW>=750){
			document.documentElement.style.fontSize="100px";
			return false;
		}else{
			document.documentElement.style.fontSize=devW/desW*100+"px";
		}
	}
	computed();
	window.addEventListener("resize",computed,false)
}();


// 监听滚动条位置,显示返回顶部按钮
$(window).scroll(function(){
	let scrollTop = $(this).scrollTop();
	if(scrollTop > 500){
		$('.to_top').show();
	}
	else{
		$('.to_top').hide();
	}
})
// 返回顶部
$('.to_top').on('click', function(){
	$(window).scrollTop(0);
})




// 头部菜单按钮事件
$('.mobile_header').on('click','.menu', function(e){
	$('.mobile_header .nav').css({
		'transform': 'translateX(0px)'
	});
	e.stopPropagation();
})

$(document).bind('click', function(){
	$('.mobile_header .nav').css('transform', 'translateX(500px)');
	$('.mobile_header .children').css('display','none');
})
$('.mobile_header .nav').bind("click", function(e){
	e.stopPropagation();
})


// 移动端子类菜单显示
$('.mobile_header .nav').on('click', '.par', function(){
	const child = $(this).find('.children');
	const href = $(this).find()
	if(child.length > 0){
		child.toggle()
	}
	else{
		
	}
})
