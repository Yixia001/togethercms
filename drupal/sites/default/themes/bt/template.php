<?php

/**
 * @file
 * template.php
 */
/**
 * Implementation of template_preprocess
 * We added a variable called theme_path so that tpl.php
 * can use images in theme images directory
 */
function bt_preprocess(&$vars) {
	global $base_url;
	$vars['base_path'] = $base_url;
	$vars['theme_path'] = $base_url .'/'. path_to_theme();
}

function bt_preprocess_page(&$vars) {
	$path = current_path();
	switch ($path) {
		case 'projects':
			drupal_add_css(drupal_get_path('theme', 'bt') . '/css/itemList.css', array('group'=>CSS_THEME));
			break;
		case 'partnerlist':
		case 'investors':
			drupal_add_css(drupal_get_path('theme', 'bt') . '/css/touziList.css', array('group'=>CSS_THEME));
			break;
	}
	if (isset($vars['user'])) {
		drupal_add_css(drupal_get_path('theme', 'bt') . '/css/touziDetail.css', array('group'=>CSS_THEME));
	}
	if (isset($vars['node'])) { //project
		drupal_add_css(drupal_get_path('theme', 'bt') . '/css/touziDetail.css', array('group'=>CSS_THEME));
	}
	
}

function bt_theme(&$existing, $type, $theme, $path) {
  $hooks['user_login'] = array(
    'template' => 'templates/user/user_login',
    'render element' => 'form',
  );
  $hooks['user_register_form'] = array(
  		'template' => 'templates/user/user_register_form',
  		'render element' => 'form',
  );
  $hooks['user_profile_form'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'bt') . '/templates',
    'template' => 'user/user-edit',
  );
  return $hooks;
}
 

function bt_preprocess_user_login(&$var) {
	drupal_add_css(drupal_get_path('theme', 'bt') . '/css/login.css', array('group'=>CSS_THEME));
  //$variables['intro_text'] = t('This is my awesome login form');
	$var['form']['name']['#title_display'] = 'invisible';
	unset($var['form']['name']['#description']);
  $var['form']['name']['#attributes']['placeholder'] = t('请输入11位手机号码');
  $var['form']['pass']['#title_display'] = 'invisible';
  unset($var['form']['pass']['#description']);
  ///$variables['rendered'] = drupal_render_children($variables['form']);
  $var['form']['actions']['submit']['#attributes']['class'] = array('btn-primary', 'btn-block', 'loginBtn');
  
}

function bt_preprocess_user_register_form(&$var) {
	drupal_add_css(drupal_get_path('theme', 'bt') . '/css/register.css', array('group'=>CSS_THEME));
	drupal_add_js(drupal_get_path('theme', 'bt') . '/js/register.js', array('group'=>CSS_THEME));
	//$variables['intro_text'] = t('This is my awesome login form');
	
	///$variables['rendered'] = drupal_render_children($variables['form']);
//	$var['form']['role'][6]['#title_display'] = 'none';
	//dpm($var['form'], 'x');
}

function bt_preprocess_user_profile_form(&$vars) {		
	unset($vars['form']['group_basic']['field_gender'][LANGUAGE_NONE]['_none']);
}

function bt_preprocess_user_profile(&$vars) {
	global $user;	
	$account = $vars['elements']['#account'];		
	
	if(in_array('partner', $account->roles)) {		
		if ($user->uid == $account->uid) {
			$vars['theme_hook_suggestions'][] = 'user_profile__partner__self';
		} else {
			$vars['theme_hook_suggestions'][] = 'user_profile__partner';
		}
	}
	elseif(in_array('investor', $account->roles)) {
		if ($user->uid == $account->uid) {
			$vars['theme_hook_suggestions'][] = 'user_profile__investor__self';
		} else {
			$vars['theme_hook_suggestions'][] = 'user_profile__investor';
		}
		
	}

	
	if(in_array('investor', $account->roles)) {
		$profile = profile2_load_by_user($account);
		if (is_array($profile) && count($profile) > 0) {
			//dpm($profile, 'd');
			$profile_object = reset($profile);
			//dpm($profile_object, 'p');
			//$wrap = entity_metadata_wrapper('Profile', $profile_object);
			//公司职位
			$visitorcompany = isset($profile_object->field_visitorcompany[LANGUAGE_NONE])? $profile_object->field_visitorcompany[LANGUAGE_NONE][0]['value']:'';
			$visitorposition = isset($profile_object->field_visitorposition[LANGUAGE_NONE])? $profile_object->field_visitorposition[LANGUAGE_NONE][0]['value']:'';
			if ($visitorcompany && $visitorposition) {
				$visitorcompany .= ' . ';
			}
			$visitorcompany .= $visitorposition;		
			$vars['visitorcompany'] = $visitorcompany;
			// 投资理念
			$visitordesc = isset($profile_object->field_visitordesc[LANGUAGE_NONE])? $profile_object->field_visitordesc[LANGUAGE_NONE][0]['value']:'';
			$vars['visitordesc'] = $visitordesc;
			// 投资理念
			$investconcept = isset($profile_object->field_investconcept[LANGUAGE_NONE])? $profile_object->field_investconcept[LANGUAGE_NONE][0]['value']:'';
			$vars['investconcept'] = $investconcept;
			// 附加价值
			$extra_value = isset($profile_object->field_extra_value[LANGUAGE_NONE])? $profile_object->field_extra_value[LANGUAGE_NONE][0]['value']:'';
			$vars['extra_value'] = $extra_value;
	
			//擅长的领域
			if (isset($profile_object->field_knowfield[LANGUAGE_NONE])) {
				$knowfields = $profile_object->field_knowfield[LANGUAGE_NONE];
				$know_html = '';
				foreach ($knowfields as $term) {
					$know_html .= '<li>' . $term['taxonomy_term']->name . '</li>';
				}
				$vars['know_html'] = '<ul class="sclyUl">' . $know_html . '</ul>';
			} else {
				$vars['know_html'] = '';
			}
			
			//投资的项目
			if (isset($profile_object->field_investproject[LANGUAGE_NONE])) {
				$invest_projects = $profile_object->field_investproject[LANGUAGE_NONE];
				$projects_html = '';
				foreach ($invest_projects as $project) {
					$project['entity']->field_project_logo[LANGUAGE_NONE][0]['path'] = $project['entity']->field_project_logo[LANGUAGE_NONE][0]['uri'];
					$project['entity']->field_project_logo[LANGUAGE_NONE][0]['style_name'] = 'image_logo';
					$thumbnail = theme_image_style($project['entity']->field_project_logo[LANGUAGE_NONE][0]);
					
					//$image = l($thumbnail, file_create_url($image_path), array('html'=>TRUE, 'attributes' => array('class'=>array('colorbox'), 'type' => $file->filemime, 'target'=>'_blank')));
					$projects_html .= '<li>' . $thumbnail . '<div class="itemName">' . $project['entity']->title  . '</div> </li>';
				}
				$vars['projects_html'] = '<ul class="itemUl">' . $projects_html . '</ul>';
			} else {
				$vars['projects_html'] = '';
			}
		}
		
	}
}
//add class to buttons
function bt_button1($variables) {
	$element = $variables['element'];
	$element['#attributes']['type'] = 'submit';
	element_set_attributes($element, array('id', 'name', 'value'));

	$element['#attributes']['class'][] = 'form-' . $element['#button_type'];
	$element['#attributes']['class'][] = 'btn';
	// adding bootstrap classes.
	if($element['#button_type'] == 'submit'){
		$element['#attributes']['class'][] = 'btn-primary';
		$element['#attributes']['class'][] = 'btn-lg';
	}
	if (!empty($element['#attributes']['disabled'])) {
		$element['#attributes']['class'][] = 'form-button-disabled';
	}

	return '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/**** theme form textfields. ***/
function bt_textfield1($variables) {

	$element = $variables['element'];
	$output = '';
	// login form adding glyphicon.
	if($element['#name'] == 'name') {
		$output = '<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>';
	}

	// force type.
	$element['#attributes']['type'] = 'text';
	// set placeholder.
	//if(isset($variables['element']['#description'])){
		$element['#attributes']['placeholder'] = $variables['element']['#title'];
	//}

	element_set_attributes($element, array('id', 'name', 'value', 'size', 'maxlength'));
	// adding bootstrap classes.
	_form_set_class($element, array('form-text', 'form-control', 'input-lg-3'));

	$extra = '';
	if ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
		drupal_add_library('system', 'drupal.autocomplete');
		$element['#attributes']['class'][] = 'form-autocomplete';

		$attributes = array();
		$attributes['type'] = 'hidden';
		$attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
		$attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
		$attributes['disabled'] = 'disabled';
		$attributes['class'][] = 'autocomplete';
		$extra = '<input' . drupal_attributes($attributes) . ' />';
	}

	$output .= '<input' . drupal_attributes($element['#attributes']) . ' />';

	return $output . $extra;
}

/*** theme password field ***/
function bt_password1($variables) {
	$element = $variables['element'];
	$element['#attributes']['type'] = 'password';
	$element['#attributes']['placeholder'] = $variables['element']['#title'];
	element_set_attributes($element, array('id', 'name', 'size', 'maxlength'));
	_form_set_class($element, array('form-text', 'form-control'));

	$output = '';
	// login form adding glyphicon.
	if($element['#name'] == 'pass') {
		$output = '<span class="input-group-addon"><span class="glyphicon glyphicon-eye-close"></span></span>';
	}

	return $output . '<input' . drupal_attributes($element['#attributes']) . ' />';
}

/** Theme form element **/
function bt_form_element1($variables) {
$element = &$variables['element'];

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title']) || empty($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  
  return theme_form_element($variables);

}

/**
 * Overrides theme_menu_tree().
 */
function bt_menu_tree(&$variables) {
	return '<ul class="menu btnsUl">' . $variables['tree'] . '</ul>';
}