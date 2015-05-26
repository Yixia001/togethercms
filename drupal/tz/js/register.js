$().ready(function(){
	validate();
	addRegisterEvent();
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

	//请输入正确的验证码
	$('.submitNo').blur(function(){
		var $this = $(this);
		if($this.val()!='1234'){
			$this.addClass('redBorder');
			$('.submitNoErrInfo').removeClass('hid');
		}else{
			$this.removeClass('redBorder');
			$('.submitNoErrInfo').addClass('hid');
		}
	});

	//请输入正确的验证码
	$('.username').blur(function(){
		var $this = $(this);
		if($this.val()!='testrx'){
			$this.addClass('redBorder');
			$('.usernameErrInfo').removeClass('hid');
		}else{
			$this.removeClass('redBorder');
			$('.usernameErrInfo').addClass('hid');
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

function addRegisterEvent(){
	$('.registerBtn').click(function(){
		alert('点击完成按钮');
	});
}