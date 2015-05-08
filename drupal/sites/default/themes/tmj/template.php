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

  $items['user_profile_form'] = array(
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

function tmj_form_element1($variables) {
  $element = $variables['element'];
  // Disable radio button N/A
  if ($element['#type'] == 'radio' && $element['#return_value'] === '_none') {
    $variables['element']['#attributes']['disabled'] = TRUE;
  }
  return theme_form_element($variables);
}

function tmj_preprocess_user_profile_form(&$vars) {	
	//用户名
	$vars['form']['name']['#attributes']['placeholder'] = '手机号或者邮箱';
	unset($vars['form']['name']['#title']);//['#title_display'] = 'invisible';
	$vars['form']['pass']['#attributes']['placeholder'] = '密码';
	unset($vars['form']['pass']['#title']);//['#title_display'] = 'invisible';
	//$vars['form']['group_basic']['field_nikename']['#attributes']['data-role'] = 'controlgroup';
	//$vars['form']['group_basic']['field_nikename']['#attributes']['data-type'] = 'horizontal';
/*	$vars['form']['group_basic']['field_nikename'] = $vars['form']['group_basic']['field_nikename']['und'];
	unset($vars['form']['group_basic']['field_nikename']['#prefix']);
	unset($vars['form']['group_basic']['field_nikename']['#suffix']);
	$vars['form']['group_basic']['field_nikename']['#attributes']['data-role'] = 'controlgroup';
	$vars['form']['group_basic']['field_nikename']['#attributes']['data-type'] = 'horizontal';
	$vars['form']['group_basic']['field_nikename']['#title_display'] = 'invisible';
	*/
	unset($vars['form']['group_basic']['field_gender'][LANGUAGE_NONE]['_none']);
	$vars['form']['group_basic']['field_gender'][LANGUAGE_NONE]['#title'] = '';
	$vars['gender_1'] = drupal_render($vars['form']['group_basic']['field_gender'][LANGUAGE_NONE][1]);
	$vars['gender_2'] = drupal_render($vars['form']['group_basic']['field_gender'][LANGUAGE_NONE][2]);
	
	$prefix_picture = $vars['form']['group_basic']['field_user_avatar'][LANGUAGE_NONE][0]['#prefix'];
	$prefix_picture = '<div class="ui-field-contain"' . substr($prefix_picture, 4);
	
	$vars['form']['group_basic']['field_user_avatar'][LANGUAGE_NONE][0]['#prefix'] = $prefix_picture;
	//unset($vars['form']['group_basic']['field_user_avatar'][LANGUAGE_NONE][0]['#title']);
	$vars['picture'] = drupal_render($vars['form']['group_basic']['field_user_avatar'][LANGUAGE_NONE]);
	
	$vars['nikename'] = drupal_render($vars['form']['group_basic']['field_nikename'][LANGUAGE_NONE]);
	
	$vars['real_name'] = drupal_render($vars['form']['group_basic']['field_real_name'][LANGUAGE_NONE]);
	//dpm($vars['form']['group_basic']['field_age'], 'd');
	$vars['age'] = drupal_render($vars['form']['group_basic']['field_age'][LANGUAGE_NONE]);
	
	$vars['address'] = drupal_render($vars['form']['group_basic']['field_address'][LANGUAGE_NONE][0]);
	
	$vars['form']['group_co']['field_focus_areas'][LANGUAGE_NONE]['#attributes']['data-native-menu'] = FALSE;
	$vars['focus_areas'] = drupal_render($vars['form']['group_co']['field_focus_areas'][LANGUAGE_NONE]);
	
	
	$elements = element_children($vars['form']);
	unset($vars['form']['group_basic']['field_work_years'][LANGUAGE_NONE]['_none']);
	unset($vars['form']['group_co']['field_work_years'][LANGUAGE_NONE]['_none']);
	unset($vars['form']['group_co']['field_focus_areas'][LANGUAGE_NONE]['_none']);
}