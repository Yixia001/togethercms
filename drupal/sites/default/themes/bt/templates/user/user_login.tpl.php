
<div class="user_login">
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
    <?php print drupal_render_children($form) ?>
</div>
