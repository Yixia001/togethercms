<?php
require_once 'Log.php';
/*
 * hook_theme
 */
function tmj_theme() {
	global $user;
	$items = array();
	$items['user_login'] = array(
      'render element' => 'form',
      'path' => drupal_get_path('theme', 'tmj') . '/templates',
      'template' => 'user/user-login',
  );

  $items['user_profile_form1'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'tmj') . '/templates',
    'template' => 'user/user-edit',
  );
  return $items;
}

function tmj_preprocess_user_login(&$vars) {	
	//用户名
	$vars['form']['name']['#attributes']['placeholder'] = '手机号或者邮箱';
	unset($vars['form']['name']['#title']);//['#title_display'] = 'invisible';
	$vars['form']['pass']['#attributes']['placeholder'] = '密码';
	unset($vars['form']['pass']['#title']);//['#title_display'] = 'invisible';
}