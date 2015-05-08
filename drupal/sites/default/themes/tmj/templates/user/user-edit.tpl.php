<div class="user_profile">
<div>
<?php print $picture;?>
</div>

<label>性别</label>
<fieldset data-role="controlgroup" data-type="horizontal">

<?php print $gender_1;?>
<?php print $gender_2;?>
</fieldset>



<?php print $nikename?>


<?php print $real_name?>

<?php print $age?>


<?php print $address?>

<?php 

?>

<div class="ui-field-contain">
<?php print $focus_areas;?>
</div>
<?php print drupal_render_children($form);?>
</div>
 

