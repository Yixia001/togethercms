
<div class="container">
	<div class="phoneNoErrInfo errInfo hid">请输入正确的手机号码</div>
	<div class="input-group">
      	<span class="input-group-addon glyphicon glyphicon-phone addon-glyphicon"></span>
      	<?php print drupal_render($form['name']) ?>
    </div>
    <div class="passwordErrInfo errInfo hid">密码长度为6到12位</div>
    <div class="input-group">
      	<span class="input-group-addon glyphicon glyphicon-lock addon-glyphicon"></span>
      	<?php print drupal_render($form['pass']) ?>
    </div>
    <?php print drupal_render($form['actions']) ?>
</div>
<?php print drupal_render_children($form) ?>
<div class="container">
	<div class="phoneNoErrInfo errInfo hid">请输入正确的手机号码</div>
	<div class="input-group">
      	<span class="input-group-addon glyphicon glyphicon-phone addon-glyphicon"></span>
      	<input type="text" class="form-control phoneNo" placeholder="请输入11位手机号码" name="phoneNo">
    </div>
    <div class="passwordErrInfo errInfo hid">密码长度为6到12位</div>
    <div class="input-group">
      	<span class="input-group-addon glyphicon glyphicon-lock addon-glyphicon"></span>
      	<input type="password" class="form-control password" placeholder="请输入密码" name="password">
    </div>
    <button type="button" class="btn btn-primary btn-block loginBtn">登录</button>
</div>