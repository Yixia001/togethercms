<?php

/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($user_profile['user_picture']). Always call
 * render($user_profile) at the end in order to print all remaining items. If
 * the item is a category, it will contain all its profile items. By default,
 * $user_profile['summary'] is provided, which contains data on the user's
 * history. Other data can be included by modules. $user_profile['user_picture']
 * is available for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $account->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $account->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 *
 * @ingroup themeable
 */

?>
<div class="userinfo_div">


		<div class="contentZone">
			<ul>
			  
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>头像</strong>
					</div>
					<div class="fr huifont partner_photo"><div class="photo">
				<?php print render($user_profile['user_picture'])?></div></div>
				</li>
				
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>真实姓名</strong>
					</div>
					<div class="fr huifont "><?php print render($user_profile['field_real_name']);?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>昵称</strong>
					</div>
					<div class="fr huifont "><?php print render($user_profile['field_nikename']);?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>地区</strong>
					</div>
					<div class="fr huifont "><?php if (isset($user_profile['field_address']['#items'][0]['administrative_area'])):?>
					<?php if ($user_profile['field_address']['#items'][0]['administrative_area'] == $user_profile['field_address']['#items'][0]['locality']):?>
					<?php print $user_profile['field_address']['#items'][0]['administrative_area']?>
					<?php else:?>
					<?php print $user_profile['field_address']['#items'][0]['administrative_area']?>.<?php print $user_profile['field_address']['#items'][0]['locality']?>
					<?php endif;?>
					<?php endif;?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>所在公司</strong>
					</div>
					<div class="fr huifont "><?php print render($user_profile['field_current_company']);?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>担任职务</strong>
					</div>
					<div class="fr huifont "><?php print render($user_profile['field_current_position']);?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>手机号</strong>
					</div>
					<div class="fr huifont "><?php print render($user_profile['field_phone_number']);?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>QQ</strong>
					</div>
					<div class="fr huifont "><?php print $field_qq_info;?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>微信</strong>
					</div>
					<div class="fr huifont "><?php print $field_weixin_info;?></div>
				</li>
				
				<li class="title_item">
					创业档案
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>目前状态</strong>
					</div>
					<div class="fr huifont "><?php print $field_co_status;?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>个人定位</strong>
					</div>
					<div class="fr huifont"><?php print $field_role_type;?></div>
				</li>
				<li class="clear marginleftright20 noborderbottom">
					<div class="fl">
						<strong>关注领域</strong>
					</div>
					<div class="fr huifont">
						<?php print $focus_areas_html?>
					</div>
				</li>
				
				<li class="title_item">
					创业背景
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>无薪可维持</strong>
					</div>
					<div class="fr huifont"><?php print $field_nopay_period;?></div>
				</li>
				<li class="clear marginleftright20">
					<div class="fl">
						<strong>创业出资</strong>
					</div>
					<div class="fr huifont"><?php print $field_venture_funding;?></div>
				</li>
				<li class="clear marginleftright20 noborderbottom">
					<div class="fl">
						<strong>期望保障</strong>
					</div>
					<div class="fr huifont">
						<?php print $field_expectation;?>
					</div>
				</li>
				<li class="title_item">
					工作经验
				</li>
				<li class="marginleftright20 huifont noborderbottom">
					<?php print $work_experience_html?>
				</li>
				<li class="title_item">
					教育经历
				</li>
				<li class="marginleftright20 huifont noborderbottom">
					<?php print $education_html;?>
				</li>
				<li class="title_item">
					个人简介
				</li>
				<li class="marginleftright20 huifont noborderbottom">
					<?php print render($user_profile['field_personal_description'])?>
				</li>
			</ul>
			<div class="connectBtn btn btn-default btn-block">
				<a href="<?php print '/user/' .$uid . '/edit'?>" >修改我的信息</a>
			</div>
		</div>
</div>