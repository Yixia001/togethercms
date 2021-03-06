<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

?>
<li>
				<?php print $fields['picture']->content?>
				<div class="userInfo">
					<div>
						<span class="name"><a href="<?php print '/user/' . $row->uid?>"><?php print $fields['field_nikename']->content?$fields['field_nikename']->content:$fields['field_real_name']->content?></a></span>
						<span class="weizhi"><?php print $fields['field_address_locality']->content?></span>
					</div>
					<div class="introduce">
						<?php print $fields['field_role_type']->content?>
					</div>
					<div class="ly">
						互联网金融/O2O/智能硬件/互联网金融
					</div>
					<div><?php print $fields['ops']->content?></div>
					<div><?php print $fields['friend_link']->content?></div>
				</div>
</li>
<!--  
<div class="user_basic_role">
<?php print $fields['field_role_type']->content?>
</div>
</div>
<div>
<?php print "移动互联网 O2O"?>
</div>
</div>

<div class="chuangye_info">
 工作状态：<?php print $fields['field_co_status']->content?>
</div>
<div class="chuangye_info">
<?php print "工作年限： " . $fields['field_work_years']->content?>
</div>
<div class="chuangye_info">
<?php print "创业状态： ". $fields['field_nopay_period']->content?>
</div>
<div class="chuangye_info">
<?php print "期望保障： ". $fields['field_expectation']->content?>
</div>
<?php print $fields['ops']->content?><br>
<?php print $fields['friend_link']->content?><br>
<a href="/rychat/<?php print $row->uid?>" target="_blank">联系合伙人</a>
</div>

-->