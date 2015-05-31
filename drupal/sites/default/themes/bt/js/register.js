jQuery(document).ready(function($){
	validate();
	addRegisterEvent();


function validate(){
	
	$('.username').blur(function(){
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
		if($this.val()==''){
			$this.addClass('redBorder');
			$('.submitNoErrInfo').removeClass('hid');
		}else{
			$this.removeClass('redBorder');
			$('.submitNoErrInfo').addClass('hid');
		}
	});

	//用户名不能为空
	$('.edit-field-real-name-und-0-value').blur(function(){
		var $this = $(this);
		if($this.val()==''){
			$this.addClass('redBorder');
			$('.usernameErrInfo').removeClass('hid');
		}else{
			$this.removeClass('redBorder');
			$('.usernameErrInfo').addClass('hid');
		}
	});

	$('#edit-pass').blur(function(){
		var $this = $(this);
		if($.trim($this.val())==''){
			$this.addClass('redBorder');
			$('.passwordErrInfo').removeClass('hid');
		}else{
			$this.removeClass('redBorder');
			$('.passwordErrInfo').addClass('hid');
		}
	});
}

function addRegisterEvent(){
	$('#edit-submit').click(function(){

			if(!isPhone($('.username').val())){
				$('.username').addClass('redBorder');
				$('.phoneNoErrInfo').removeClass('hid');
				return false;
			}
			if($('#edit-field-real-name-und-0-value').val() == ''){
				$('#edit-field-real-name-und-0-value').addClass('redBorder');
				$('.usernameErrInfo').removeClass('hid');
				return false;
			}
			if($('#edit-pass').val() == ''){
				$('#edit-pass').addClass('redBorder');
				$('.passwordErrInfo').removeClass('hid');
				return false;
			}
			if(!$("input:radio[name='role']:checked").length) {
				$('.roleErrInfo').removeClass('hid');
				return false;
			} else {
				$('.roleErrInfo').addClass('hid');
			}
			
			if(!$("input:checkbox[name='agreement']:checked").length) {
				$('.agreementErrInfo').removeClass('hid');
				return false;
			} else {
				$('.agreementErrInfo').addClass('hid');
			}
			
		return true;
	});
}

});