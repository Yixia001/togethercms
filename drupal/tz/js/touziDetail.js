$().ready(function(){
	addEvent();
});

function addEvent(){
	$('.hleft').click(function(){
		alert('返回');
	});
	$('.hright').click(function(){
		alert('收藏');
	});
	$('.footer').click(function(){
		alert('提交项目事件');
	});
}