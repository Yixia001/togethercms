
<div class="title">新用户注册</div>
		<div class="phoneNoErrInfo errInfo hid">请输入正确的手机号码</div>
		<div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-phone addon-glyphicon"></span>
	      	<input type="text" class="form-control phoneNo" placeholder="请输入11位手机号码" name="phoneNo">
	    </div>
	    <div class="submitNoErrInfo errInfo hid">请输入正确的验证码</div>
	    <div class="input-group">
		  	<input type="text" class="form-control submitNo" placeholder="请输入手机获取的验证码" aria-describedby="basic-addon2">
		  	<span class="input-group-btn">
	        	<button class="btn btn-default" type="button">重新发送验证码</button>
	      	</span>
		</div>
		<div class="usernameErrInfo errInfo hid">用户名不能为空||该用户名已存在</div>
	    <div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-lock addon-glyphicon"></span>
	      	<input type="text" class="form-control username" placeholder="请输入用户名" name="username">
	    </div>
	    <div class="passwordErrInfo errInfo hid">密码长度为6到12位</div>
	    <div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-lock addon-glyphicon"></span>
	      	<input type="password" class="form-control password" placeholder="请输入密码" name="password">
	    </div>
	    <div class="btn-group" data-toggle="buttons">
		   	<label class="thelabel">
		   	我是
		 	</label> 

		  	<label class="btn btn-default">
		    	<input type="radio" name="options" id="option2" autocomplete="off">投资人
		  	</label>
		  	<label class="btn btn-default">
		    	<input type="radio" name="options" id="option3" autocomplete="off">创业者
		  	</label>
		</div>
		<div class="thecheckbox">
			<input type="checkbox" class="agreeYesOrNo" name="agreeYesOrNo">我已阅读并同意<span>《萌牙创投服务协议》</span>
		</div>
	    <button type="button" class="btn btn-primary btn-block registerBtn">完成</button>