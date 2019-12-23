$(function(){
	$('.item2 .left_nav').on('click', 'li', function(){
		$(this).addClass('active').siblings().removeClass('active');
		const id = $(this).attr('data-id');
		$.post()
	})
	
	$('.item2 .right_list').on('click', 'li', function(){
		$(this).addClass('active').siblings().removeClass('active');
		$('.item2').css('transform','translateX(500px)');
	})
	// 机型
	$('.t2').click(function(){
		$('.item2').css('transform','translateX(0)');
		$('body').css('overflow','hidden');
	})
	
	$('.item2').bind('click', function(){
		$('.item2').css('transform','translateX(500px)');
		$('body').css('overflow','auto');
	})
	$('.item2 .wrap').bind('click', function(e){
		e.stopPropagation();
	})
	// 筛选
	$('.t3').click(function(){
		$('.item3').css('transform','translateX(0)');
		$('body').css('overflow','hidden');
	})
	$('.item3 .wrap').on('click', 'li', function(){
		if($(this).hasClass('on')){
			$(this).removeClass('on');
		}
		else{
			$(this).addClass('on').siblings().removeClass('on');
		}
	})
	$('.item3').bind('click', function(){
		$('.item3').css('transform','translateX(600px)');
		$('body').css('overflow','auto');
	})
	$('.item3 .wrap').bind('click', function(e){
		e.stopPropagation();
	})

})

// 筛选 确认/取消
$('.bottom_c').on('click', 'span', function(){
	// 点击确认按钮
	if(this.className == 'sure'){
		let pri = '';
		pri = $('.price_range').find('li.on').text();
		const min = $('.min').val();
		const max = $('.max').val();
		const memory = $('.memory').find('li.on').text();
		const col = $('.colour').find('li.on').text();
		const cond = $('.condition').find('li.on').text();
		if(min != '' && max != ''){
			pri = min + '-' + max;
		}
		
		$.post()
	}
	// 点击取消按钮
	if(this.className == 'cancel'){
		$('.item3 .wrap').find('li').removeClass('on');
		$('.min').val('');
		$('.max').val('');
		$('.item3').css('transform','translateX(600px)');
		$('body').css('overflow','auto');
	}
})