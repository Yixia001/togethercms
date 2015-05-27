$().ready(function(){
	addUserBaseEvent();
});

function addUserBaseEvent(){
	$('.thebtn').click(function(){
		alert('修改密码');
	});
}