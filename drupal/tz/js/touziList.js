$().ready(function(){
	addTouziListEvent();
});

function addTouziListEvent(){
	$('.hleft').click(function(){
		alert('左边点击事件');
	});

	$('.hright').click(function(){
		alert('右边点击事件');
	});

	$('.btnsUl').delegate('li','click',function(){
		alert('\''+$(this).text()+'\'点击事件');
	});
}