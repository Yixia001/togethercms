$().ready(function(){
	validate();
	addLoginEvent();
});

function validate(){
	
	$('.phoneNo').blur(function(){
		var $this = $(this);
		if(!isPhone($this.val())){
			$this.addClass('redBorder');
			$('.phoneNoErrInfo').removeClass('hid');
		}else{
			$this.removeClass('redBorder');
			$('.phoneNoErrInfo').addClass('hid');
		}
	});

	$('.password').blur(function(){
		var $this = $(this);
		if($.trim($this.val())==''||$this.val().length<6||$this.val().length>12){
			$this.addClass('redBorder');
			$('.passwordErrInfo').removeClass('hid');
		}else{
			$this.removeClass('redBorder');
			$('.passwordErrInfo').addClass('hid');
		}
	});
}

function addLoginEvent(){

	$('.loginBtn').click(function(){
		alert('点击登陆按钮');
	});
}