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
						<span class="name"><?php print $fields['field_nikename']->content?$fields['field_nikename']->content:$fields['field_real_name']->content?></span>
						<span class="weizhi"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><?php print $fields['field_address_locality']->content?></span></span>
					</div>
					<div class="introduce">
					  <?php if (mb_strlen($fields['field_personal_description']->content, 'utf-8') < 50) :?>
					    <?php print $fields['field_personal_description']->content?>
					  <?php elseif(strlen($fields['field_personal_description']->content) > 20 && $fields['field_current_position']->content):?>
					    <?php print $fields['field_current_company']->content?>&nbsp;<?php print $fields['field_current_position']->content?>
					  <?php else:?>
					    <?php print mb_substr($fields['field_personal_description']->content, 0, 50, 'utf-8') . '...' ?>
					  <?php endif;?>
						
						
						
					</div>
					<div class="ly">
						<span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span><?php print $fields['field_investfield']->content?>&nbsp;</span>
					</div>
				</div>
</li>

<?php print $fields['ops']->content?><br>
<?php print $fields['friend_link']->content?><br>
<a href="/rychat/<?php print $row->uid?>" target="_blank">联系合伙人</a>
