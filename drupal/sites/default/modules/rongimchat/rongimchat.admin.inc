<?php
/**
 * @file
 * rongimchat admin pages.
 */

function rongimchat_config_form($form, $form_state) {
	$form['rongimchat_apiurl'] = array(
			'#type' => 'textfield',
			'#title' => t('Token'),
			'#description' => t('The api url of Rong yun, default http://api.cn.rong.io.'),
			'#default_value' => variable_get('rongimchat_apiurl', ''),
			'#required' => TRUE,
	);
	$form['rongimchat_appid'] = array(
			'#type' => 'textfield',
			'#title' => t('AppID'),
			'#description' => t('Account APPID'),
			'#default_value' => variable_get('rongimchat_appid', ""),
			'#required' => TRUE,
	);
	$form['rongimchat_appsecret'] = array(
			'#type' => 'textfield',
			'#title' => t('AppSecret'),
			'#description' => t('Account AppSecret'),
			'#default_value' => variable_get('rongimchat_appsecret', ""),
			'#required' => TRUE,
	);
	return system_settings_form($form);
}