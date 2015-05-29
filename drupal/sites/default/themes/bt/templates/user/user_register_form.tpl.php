
   
 

<div class="title">新用户注册</div>
		<div class="phoneNoErrInfo errInfo hid">请输入正确的手机号码</div>
		<div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-phone addon-glyphicon"></span>
	      	<?php print drupal_render($form['account']['name']) ?>
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
	      	<?php print drupal_render($form['group_basic']['field_real_name']) ?>
	    </div>
	    <div class="passwordErrInfo errInfo hid">密码长度为6到12位</div>
	    <div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-lock addon-glyphicon"></span>
	      	<?php print drupal_render($form['account']['pass']) ?>
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
	    <?php print drupal_render($form['actions']) ?>
	    
	     <?php print drupal_render_children($form) ?>