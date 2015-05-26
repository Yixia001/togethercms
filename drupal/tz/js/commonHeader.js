$().ready(function(){
	addCommonHeaderEvent();
});

function addCommonHeaderEvent(){
	$('.userList').click(function(){
		alert('跳转到投资人列表页面');
	});
	$('.itemList').click(function(){
		alert('跳转到项目列表页面');
	});
	$('.config').click(function(){
		alert('点击设置1');
	});
}