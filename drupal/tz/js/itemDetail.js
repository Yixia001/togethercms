$().ready(function(){
	init();
	addItemDetailEvent();
});

function addItemDetailEvent(){
	$('.touziBtn').click(function(){
		alert('我要投资');
		//$('.head span').text('我要投资');
	});

	$('.xiangqingUl').delegate('li','click',function(){
		$('.gongsi,.rongzi').removeClass('active');
		$(this).addClass('active');
		$('.tabgongsi,.tabrongzi').addClass('hid');
		$('.tab'+$(this).attr('data')).removeClass('hid');
	});

	$('.gongsiUl').delegate('.title','click',function(){
		var _this = this;
		$(this).parents('li').find('.content').fadeToggle("slow",function(){
			var btntext = $(_this).find('.btnStatus').text();
			if(btntext=='展开'){
				$(_this).find('.btnStatus').text('关闭');
			}else{
				$(_this).find('.btnStatus').text('展开');
			}
		});

	});

	$('.left').click(function(){
		var $active = $('.zhaoxianUl .active');
		if($active.prev().attr('data')){
			$active.removeClass('active');
			$active.prev().addClass('active');
			showZhaoxianUlTab();
		}
		
	});
	$('.right').click(function(){
		var $active = $('.zhaoxianUl .active');
		if($active.next().attr('data')){
			$active.removeClass('active');
			$active.next().addClass('active');
			showZhaoxianUlTab();
		}
	});
	$('.zhaoxianUl').delegate('li','click',function(){
		$('.zhaoxianUl li').removeClass('active');
		$(this).addClass('active');
		showZhaoxianUlTab();
	});

	$('.btnsUl').delegate('span','click',function(){
		$(this).addClass('active').siblings().removeClass('active');
	});
}

function showZhaoxianUlTab(){
	var index = $('.zhaoxianUl li').index($('.zhaoxianUl .active'));
	$('.zhaoxianUlContent .tab').addClass('hid');
	$('.zhaoxianUlContent .tab').eq(index).removeClass('hid');
}

function init(){
}