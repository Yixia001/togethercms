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
	<div class="upPart">
		<?php print $fields['field_project_logo']->content?>
		<div class="name"><?php print $fields['title']->content?></div>
		<div class="type item">电子商务 O2O</div>
		<div class="status item">上海/天使轮/测试阶段</div>
		<div class="desc item">面向95和00后的偶像养成移动社区</div>
	</div>
	<div class="jindutiao">
		<div class="curJindu"></div>
	</div>
	<div class="rongziInfo clear">
		<div class="rongzi fl">已融资50万（预融资150万）</div>
		<div class="time fr">剩余<span>30</span>天</div>
	</div>
	<div class="downPart clear">
		<div class="btn-group fr" role="group">
		  	<button type="button" class="btn btn-default">
		  		<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="content">26</span>
		 	</button>
		  	<button type="button" class="btn btn-default">
		  		<span class="glyphicon glyphicon-comment" aria-hidden="true"></span><span class="content">199</span>
		  	</button>
		  	<button type="button" class="btn btn-default">
		  		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span class="content">212</span>
		  	</button>
		  	<button type="button" class="btn btn-default">
		  		<span class="glyphicon glyphicon-time" aria-hidden="true"></span><span class="content">2015.2.15</span>
		  	</button>
		</div>
	</div>

</li>
