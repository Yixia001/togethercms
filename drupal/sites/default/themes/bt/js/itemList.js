jQuery(document).ready(function($){
	addItemListEvent();


function addItemListEvent(){
	$('.hleft').click(function(){
	});

	$('.hright').click(function(){
		$('.queryInput').removeClass('hid');
	});

	$('.queryBtn').click(function(){
		var val = $('.submitNo').val();
	});

	$('.filter_btn').click(function(){
		$('.filterZone').toggleClass('hid');
	});

	$('.filterZone .item').delegate('li','click',function(){
		$(this).parent().find('li').removeClass('active');
		$(this).addClass('active');
	});

	$('.filterMingQ,.filterMingX').delegate('li','click',function(){
		$(this).parent().find('li').removeClass('active');
		$(this).addClass('active');
		$(this).parent().parent().addClass('hid');
		console.log('执行查询');
	});

	$('.btnsUl').delegate('li','click',function(){
		alert('\''+$(this).text()+'\'点击事件');
	});

	$('#typeListTable').delegate('td','click',function(){
		$(this).parents('.table').find('td').removeClass('active');
		$(this).addClass('active');
		var val = $(this).text();
		switch(val){
			case '名企项目':
				doMingQ();
				break;
			case '名校项目':
				doMingX();
				break;
		}
	});
}

function doMingQ(){
	$('.queryInput').addClass('hid');;
	$('.filterMingQ').removeClass('hid');
	$('.filterMingX').addClass('hid');
}

function doMingX(){
	$('.queryInput').addClass('hid');;
	$('.filterMingX').removeClass('hid');
	$('.filterMingQ').addClass('hid');
}
});