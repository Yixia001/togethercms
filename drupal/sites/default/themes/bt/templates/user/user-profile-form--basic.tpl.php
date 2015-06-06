<div class="user_profile <?php print $page_class;?>">
<div class="form-item form-group form-item-profile-gender"> 
<label class="control-label">性别 </label>
<ul>
<li>
<?php print $gender_man?>
</li>
<li>
<?php print $gender_woman?>
</li>
</ul>
</div>
<div style="float:left;clear:both;margin-bottom:10px;"></div>
<div style="clear:both;">
<?php print drupal_render_children($form);?>
</div>
</div>
 

