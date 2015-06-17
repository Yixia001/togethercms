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
$name = isset($user_profile['field_nikename'])?$user_profile['field_nikename']:$user_profile['field_real_name'];
?>
<div class="userinfo_div">
    <div class="userInfoZone clear">
			<?php print render($user_profile['user_picture'])?>
			<div class="userInfo">
				<div class="name"><?php print render($name)?></div>
				<p class="job">
					<?php print $visitorcompany;?>&nbsp;
				</p>
				<p class="introduce">
					<?php print render($user_profile['field_personal_description'])?>&nbsp;
				</p>
				<!-- <ul>
					<li class="weizhi"><?php print $user_profile['field_address']['#items'][0]['administrative_area']?>.<?php print $user_profile['field_address']['#items'][0]['locality']?></li>
					<li class="liaotian">199</li>
					<li class="liulan">212</li>
					<li class="shoucang">26</li>
				</ul> -->
				
				<div class="smallIcons clear">
					<div class="btn-group fl" role="group">
					  	<button type="button" class="btn btn-default">
					  		<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><span class="content"><?php print $user_profile['field_address']['#items'][0]['locality']?></span>
					 	</button>
					  	<button type="button" class="btn btn-default">
					  		<span class="glyphicon glyphicon-star" aria-hidden="true"></span><span class="content"><?php print $user_profile['flags']['soucang']['#markup'] ?></span>
					 	  </button>					 	
					  	<button type="button" class="btn btn-default">
					  		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><span class="content"><?php print $user_profile['flags']['friend']['#markup'] ?></span>
					  	</button>
					</div>
				</div>
			</div>
		</div>
		<div class="itemListZone clear" style="display:none;">
			<div class="title">投资项目：</div>
			<?php print $projects_html;?>
		</div>
		<?php if ($investregion_html):?>
		<div class="scly clear">
			<div class="title">投资地域：</div>
			<p>
				<?php print $investregion_html;?>
			</p>
		</div>
		<?php endif;?>
		<div class="scly clear">
			<div class="title">投资领域：</div>
			<p>
				<?php print $invest_html;?>
			</p>
		</div>
		<div class="tzln">
			<div class="title">投资理念：</div>
			<p>
				<?php print $investconcept;?>
			</p>
		</div>
		<div class="scly clear" style="display:none;">
			<div class="title">擅长领域：</div>
			<?php print $know_html;?>
		</div>
		<div class="fjjz">
			<div class="title">附加价值：</div>
			<p>
				<?php print $extra_value;?>
			</p>
		</div>
		<div class="taGZ" style="display:none;">
			<div class="title">TA关注：</div>
			<ul class="itemUl">
				<li>
					<img src="./img/2.jpg" alt="">
					<div class="itemName">北斗天使</div>
				</li>
				<li>
					<img src="./img/2.jpg" alt="">
					<div class="itemName">北斗天使北斗天使</div>
				</li>
				<li>
					<img src="./img/2.jpg" alt="">
					<div class="itemName">北斗天使</div>
				</li>
				<li>
					<img src="./img/2.jpg" alt="">
					<div class="itemName">北斗天使</div>
				</li>
			</ul>
		</div>
</div>