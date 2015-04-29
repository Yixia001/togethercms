<?php


?>
<div class="login_wrap">
    	<div class="login_bar_head"><span class="span_login">普通方式</span>|<span class="span_login">手机动态密码</span></div>
       
                  
      <?php
    print drupal_render($form['name']);
    print drupal_render($form['pass']);
    ?>  
       
   <?php
    print drupal_render($form['form_build_id']);
    print drupal_render($form['form_id']);
    print drupal_render($form['actions']);
    ?> 
        <div class="login_bar_bottom">
        <ul>
           <li><a href="/user/register">注册</a></li>
        </ul>
        </div>
</div>


 

