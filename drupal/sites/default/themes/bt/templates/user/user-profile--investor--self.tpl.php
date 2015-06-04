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
<div class="userinfoself_div">
    <div class="photoZone">
			<div class="photo">
				<?php print render($user_profile['user_picture'])?>
				<div><?php print render($user_profile['field_nikename'])?></div>
			</div>
		</div>
		<div class="menuZone">
			<ul class="clear">
				<li>
					<div class="num">1</div>
					<div class="subject">约谈</div>
				</li>
				<li>
					<div class="num">6</div>
					<div class="subject">关注</div>
				</li>
				<li>
					<div class="num">2</div>
					<div class="subject">粉丝</div>
				</li>
			</ul>
		</div>
		<div class="contentZone">
			<ul>
				<li class="clear">
					<div class="fl">
						<span class="glyphicon glyphicon-tint" aria-hidden="true"></span>
						<strong>投资人认证</strong>
					</div>
					<div class="fr">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</div>
					<div class="fr">未认证</div>
				</li>
				<a href="<?php print $preference_setting_url;?>">
				<li class="clear">
					<div class="fl">
						<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
						<strong>投资偏好</strong>
					</div>
					<div class="fr">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</div>
					<div class="fr">已设置</div>
				</li>
				</a>
				<li class="clear">
					<div class="fl">
						<span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
						<strong>投融须知</strong>
					</div>
					<div class="fr">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</div>
				</li>
				<li class="clear">
					<div class="fl">
						<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
						<strong>反馈建议</strong>
					</div>
					<div class="fr">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</div>
				</li>
				<li class="clear">
					<div class="fl">
						<span class="glyphicon glyphicon-share" aria-hidden="true"></span>
						<strong>推荐给好友</strong>
					</div>
					<div class="fr">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</div>
				</li>
				<li class="clear">
					<div class="fl">
						<span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>
						<strong>我的人脉</strong>
					</div>
					<div class="fr">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</div>
				</li>
			</ul>
		</div>
</div>