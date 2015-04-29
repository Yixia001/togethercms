<?php //print_r($form['account']); ?>
   <div class="account_note_wrap">
    	<span>个人信息修改</span>
    </div><!--account_note_wrap-->
    <div class="account_table_wrap account_content_wrap">
		<?php 
               // print render($form['account']['name']);
                print drupal_render($form['field_real_name']);
                print render($form['account']['current_pass']);
                print drupal_render($form['field_mobile']);
                print drupal_render($form['account']['mail']);
                print drupal_render($form['account']['pass']);
              //  print drupal_render($form['field_invite_count']);
                print render($form['form_build_id']);
                print render($form['form_id']);
                print render($form['form_token']);
                print drupal_render($form['actions']);
                ?>
        <div style="clear:both"></div>
    </div><!--account_table_wrap-->


 

