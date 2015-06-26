
   
 
<div class="user_profile">
<div class="title">新用户注册</div>
		<div class="phoneNoErrInfo errInfo hid">请输入正确的手机号码</div>
		<div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-phone addon-glyphicon"></span>
	      	<?php print drupal_render($form['account']['name']) ?>
	    </div>
	    <div class="submitNoErrInfo errInfo hid">请输入正确的验证码</div>
	    <div class="input-group">
	      <?php print $captcha_response?>
		  	<span class="input-group-btn">
	        	<?php print $send_button;?>
	      	</span>
		</div>
		<div class="usernameErrInfo errInfo hid">用户名不能为空</div>
	    <div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-lock addon-glyphicon"></span>
	      	<?php print drupal_render($form['group_basic']['field_real_name']) ?>
	    </div>
	    <div class="passwordErrInfo errInfo hid">密码不能为空</div>
	    <div class="input-group">
	      	<span class="input-group-addon glyphicon glyphicon-lock addon-glyphicon"></span>
	      	<?php print drupal_render($form['account']['pass']) ?>
	    </div>
	    
	    <div class="roleErrInfo errInfo hid">请选择一个您的定位</div>
	    <div class="btn-group" data-toggle="buttons">
		   	<label class="thelabel">
		   	我是
		 	</label> 
		 	
		 	<?php $select_role = $form['role']['#value'];?>

		  	<label class="btn btn-default <?php print ($select_role == ROLE_INVESTOR)? 'active':''?>">
		    	<?php print drupal_render($form['role'][ROLE_INVESTOR]) ?>
		  	</label>
		  	<label class="btn btn-default <?php print ($select_role == ROLE_PARTNER)? 'active':''?>">
		    	<?php print drupal_render($form['role'][ROLE_PARTNER]) ?>
		  	</label>
		</div>
		<div class="agreementErrInfo errInfo hid">请阅读并同意协议</div>
		<div class="thecheckbox">
			<?php print drupal_render($form['agreement']) ?>
		</div>
	    <?php print drupal_render($form['actions']) ?>
	    
	     <?php print drupal_render_children($form) ?>
	     
	     </div>