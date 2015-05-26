$().ready(function(){
	validateHobby();
	addHobbyEvent();
});

function validateHobby(){

}

function addHobbyEvent(){

	$('.comUl').delegate('li','click',function(){
		if($(this).hasClass('checkBoxActive')){
			$(this).removeClass('checkBoxActive');
		}else{
			$(this).addClass('checkBoxActive');
		}
	});

	$('.submitBtn').click(function(){
		alert('点击完成按钮');
	});
}