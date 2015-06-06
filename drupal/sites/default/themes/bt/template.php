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
	$vars ['base_path'] = $base_url;
	$vars ['theme_path'] = $base_url . '/' . path_to_theme ();
}
function bt_preprocess_page(&$vars) {
	$path = current_path ();
	switch ($path) {
		case 'projects' :
			drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/itemList.css', array (
					'group' => CSS_THEME 
			) );
			break;
		case 'partnerlist' :
		case 'investors' :
			drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/touziList.css', array (
					'group' => CSS_THEME 
			) );
			break;
	}
	
	if (strpos ( $path, 'user' ) === 0 && is_numeric ( arg ( 1 ) )) {
		
	}
	if (isset ( $vars ['node'] )) { // project
		drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/touziDetail.css', array (
				'group' => CSS_THEME 
		) );
	}
}
function bt_theme(&$existing, $type, $theme, $path) {
	$hooks ['user_login'] = array (
			'template' => 'templates/user/user_login',
			'render element' => 'form' 
	);
	$hooks ['user_register_form'] = array (
			'template' => 'templates/user/user_register_form',
			'render element' => 'form' 
	);
	$hooks ['user_profile_form'] = array (
			'render element' => 'form',
			'path' => drupal_get_path ( 'theme', 'bt' ) . '/templates',
	//		'template' => 'user/user-edit' 
	);
	return $hooks;
}
function bt_preprocess_user_login(&$var) {
	drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/login.css', array (
			'group' => CSS_THEME 
	) );
	// $variables['intro_text'] = t('This is my awesome login form');
	$var ['form'] ['name'] ['#title_display'] = 'invisible';
	unset ( $var ['form'] ['name'] ['#description'] );
	$var ['form'] ['name'] ['#attributes'] ['placeholder'] = t ( '请输入11位手机号码' );
	$var ['form'] ['pass'] ['#title_display'] = 'invisible';
	unset ( $var ['form'] ['pass'] ['#description'] );
	// /$variables['rendered'] = drupal_render_children($variables['form']);
	$var ['form'] ['actions'] ['submit'] ['#attributes'] ['class'] = array (
			'btn-primary',
			'btn-block',
			'loginBtn' 
	);
}
function bt_preprocess_user_register_form(&$var) {
	drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/register.css', array (
			'group' => CSS_THEME 
	) );
	drupal_add_js ( drupal_get_path ( 'theme', 'bt' ) . '/js/register.js', array (
			'group' => CSS_THEME 
	) );
	// $variables['intro_text'] = t('This is my awesome login form');
	
	// /$variables['rendered'] = drupal_render_children($variables['form']);
	// $var['form']['role'][6]['#title_display'] = 'none';
	// dpm($var['form'], 'x');
}
function bt_preprocess_user_profile_form(&$vars) {
	drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/useredit.css', array (
			'group' => CSS_THEME
	) );
	unset ( $vars ['form'] ['group_basic'] ['field_gender'] [LANGUAGE_NONE] ['_none'] );
	
	$catogary = $vars['form']['#user_category'];
	//dpm($vars, 'd');
	switch ($catogary){
		case 'basic_profile':
			$vars['page_class'] = 'user_profile_basic' ;
			$vars['theme_hook_suggestions'][] = 'user_profile_form__basic';
			$vars['gender_man'] = drupal_render($vars['form']['profile_basic_profile']['field_gender'][LANGUAGE_NONE][1]);
			$vars['gender_woman'] = drupal_render($vars['form']['profile_basic_profile']['field_gender'][LANGUAGE_NONE][2]);
			hide($vars['form']['profile_basic_profile']['field_gender']);
			break;
		case 'preference_setting':
			$vars['page_class'] = 'user_profile_preference' ;
			$vars['theme_hook_suggestions'][] = 'user_profile_form__preference';
			$vars['investlimitfrom'] = drupal_render($vars['form']['profile_preference_setting']['field_prefer_investlimit'][LANGUAGE_NONE][0]['from']);
			$vars['investlimitto'] = drupal_render($vars['form']['profile_preference_setting']['field_prefer_investlimit'][LANGUAGE_NONE][0]['to']);
			hide($vars['form']['profile_preference_setting']['field_prefer_investlimit']);
			
			break;
		default:
			$vars['page_class'] = '' ;
	}
}
function bt_preprocess_user_profile(&$vars) {
	global $user;
	$account = $vars ['elements'] ['#account'];
	$vars['uid'] = $account->uid;
	if (in_array ( 'partner', $account->roles )) {
		if ($user->uid == $account->uid) {
			//drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/chuangyeConf.css', array (
			//		'group' => CSS_THEME
			//) );
			drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/hehuorenDetail.css', array (
					'group' => CSS_THEME
			) );
			$vars ['theme_hook_suggestions'] [] = 'user_profile__partner__self';
		} else {
			drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/hehuorenDetail.css', array (
					'group' => CSS_THEME
			) );
			$vars ['theme_hook_suggestions'] [] = 'user_profile__partner';
		}
	} elseif (in_array ( 'investor', $account->roles )) {
		if ($user->uid == $account->uid) {
			drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/touzirenConf.css', array (
					'group' => CSS_THEME
			) );
			$vars ['theme_hook_suggestions'] [] = 'user_profile__investor__self';
		} else {
			drupal_add_css ( drupal_get_path ( 'theme', 'bt' ) . '/css/touziDetail.css', array (
					'group' => CSS_THEME
			) );
			$vars ['theme_hook_suggestions'] [] = 'user_profile__investor';
		}
	}
	
	if (in_array ( 'investor', $account->roles )) {
		if ($user->uid != $account->uid) {
			$profile_object = profile2_load_by_user ( $account, 'investor_profile' );
			// $profile = profile2_load_by_user($account, 'basic_profile');
			// $profile = profile2_load_by_user($account, 'preference_setting');
			// dpm($profile_object, 'p');
			// $wrap = entity_metadata_wrapper('Profile', $profile_object);
			// 公司职位
			$visitorcompany = isset ( $profile_object->field_visitorcompany [LANGUAGE_NONE] ) ? $profile_object->field_visitorcompany [LANGUAGE_NONE] [0] ['value'] : '';
			$visitorposition = isset ( $profile_object->field_visitorposition [LANGUAGE_NONE] ) ? $profile_object->field_visitorposition [LANGUAGE_NONE] [0] ['value'] : '';
			if ($visitorcompany && $visitorposition) {
				$visitorcompany .= ' . ';
			}
			$visitorcompany .= $visitorposition;
			$vars ['visitorcompany'] = $visitorcompany;
			// 投资理念
			$visitordesc = isset ( $profile_object->field_visitordesc [LANGUAGE_NONE] ) ? $profile_object->field_visitordesc [LANGUAGE_NONE] [0] ['value'] : '';
			$vars ['visitordesc'] = $visitordesc;
			// 投资理念
			$investconcept = isset ( $profile_object->field_investconcept [LANGUAGE_NONE] ) ? $profile_object->field_investconcept [LANGUAGE_NONE] [0] ['value'] : '';
			$vars ['investconcept'] = $investconcept;
			// 附加价值
			$extra_value = isset ( $profile_object->field_extra_value [LANGUAGE_NONE] ) ? $profile_object->field_extra_value [LANGUAGE_NONE] [0] ['value'] : '';
			$vars ['extra_value'] = $extra_value;
			
			// 擅长的领域
			if (isset ( $profile_object->field_knowfield [LANGUAGE_NONE] )) {
				$knowfields = $profile_object->field_knowfield [LANGUAGE_NONE];
				$know_html = '';
				foreach ( $knowfields as $term ) {
					if (! isset ( $term ['taxonomy_term'] )) {
						$term ['taxonomy_term'] = taxonomy_term_load ( $term ['tid'] );
					}
					$know_html .= '<li>' . $term ['taxonomy_term']->name . '</li>';
				}
				$vars ['know_html'] = '<ul class="sclyUl">' . $know_html . '</ul>';
			} else {
				$vars ['know_html'] = '';
			}
			
			// 投资的项目
			if (isset ( $profile_object->field_investproject [LANGUAGE_NONE] )) {
				$invest_projects = $profile_object->field_investproject [LANGUAGE_NONE];
				$projects_html = '';
				foreach ( $invest_projects as $project ) {
					$project ['entity']->field_project_logo [LANGUAGE_NONE] [0] ['path'] = $project ['entity']->field_project_logo [LANGUAGE_NONE] [0] ['uri'];
					$project ['entity']->field_project_logo [LANGUAGE_NONE] [0] ['style_name'] = 'image_logo';
					$thumbnail = theme_image_style ( $project ['entity']->field_project_logo [LANGUAGE_NONE] [0] );
					
					// $image = l($thumbnail, file_create_url($image_path), array('html'=>TRUE, 'attributes' => array('class'=>array('colorbox'), 'type' => $file->filemime, 'target'=>'_blank')));
					$projects_html .= '<li>' . $thumbnail . '<div class="itemName">' . $project ['entity']->title . '</div> </li>';
				}
				$vars ['projects_html'] = '<ul class="itemUl">' . $projects_html . '</ul>';
			} else {
				$vars ['projects_html'] = '';
			}
		} else { //touziren self
			$vars['preference_setting_url'] = '/user/' . $user->uid . '/edit/preference_setting';
		}
	// 创业者
	} else {
		//if ($user->uid == $account->uid) {
			
		//} else {
			$profile_object = profile2_load_by_user ( $account, 'partner_profile' );
				
		  $vars['field_co_status'] = _get_term_name($profile_object, 'field_co_status');
	
	    $vars['field_role_type'] = _get_term_name($profile_object, 'field_role_type');
		
		  
		  if (isset ( $account->field_focus_areas [LANGUAGE_NONE] )) {
		  	$focus_areas_fields = $account->field_focus_areas [LANGUAGE_NONE];
		  	$focus_areas_html = '';
		  	foreach ( $focus_areas_fields as $term ) {
		  		if (! isset ( $term ['taxonomy_term'] )) {
		  			$term ['taxonomy_term'] = taxonomy_term_load ( $term ['tid'] );
		  		}
		  		if ($focus_areas_html) {
		  			$focus_areas_html .= '、';
		  		}
		  		$focus_areas_html .= $term ['taxonomy_term']->name;
		  	}
		  	$vars ['focus_areas_html'] = '<ul class="sclyUl">' . $focus_areas_html . '</ul>';
		  } else {
		  	$vars ['focus_areas_html'] = '';
		  }
		  
	    $vars['field_nopay_period'] = _get_term_name($profile_object, 'field_nopay_period');
		  
	    $vars['field_venture_funding'] = _get_term_name($profile_object, 'field_venture_funding');
		  
		  $vars['field_expectation'] = _get_term_name($profile_object, 'field_expectation');
			
			
		  $profile_object = profile2_load_by_user ( $account, 'basic_profile' );
		  $vars['field_qq_info'] = isset($profile_object->field_qq_info[LANGUAGE_NONE])? $profile_object->field_qq_info[LANGUAGE_NONE][0]['value']:'';
		  $vars['field_weixin_info'] = isset($profile_object->field_weixin_info[LANGUAGE_NONE])? $profile_object->field_weixin_info[LANGUAGE_NONE][0]['value']:'';
		  $field_education_collection = isset($profile_object->field_education_collection[LANGUAGE_NONE]) ? $profile_object->field_education_collection[LANGUAGE_NONE]:'';
		  $education_html = '';
		  if ($field_education_collection) {	  	
		  	foreach ($field_education_collection as $collection) {
		  		$id = $collection['value'];
		  		$collection_obj = field_collection_item_load($id);
		  		$fc_wrapper = entity_metadata_wrapper('field_collection_item', $collection_obj);
		  		$begin = format_date($fc_wrapper->field_education_start->value(), 'date_ym');
		  		$end = format_date($fc_wrapper->field_education_end->value(), 'date_ym');
		  		$school = $fc_wrapper->field_school_name->value();
		  		$specialty = $fc_wrapper->field_specialty->value();
		  		if ($education_html) {
		  			$education_html .= '<br/>';
		  		}
		  		$education_html .= $begin . '-' . $end . ' ' . $school . ' ' . $specialty;
		  	}
		  }
		  $vars['education_html'] = $education_html;
		  
		  $field_work_experience = isset($profile_object->field_work_experience[LANGUAGE_NONE]) ? $profile_object->field_work_experience[LANGUAGE_NONE]:'';
		  $work_experience_html = '';
		  if ($field_work_experience) {
		  	foreach ($field_work_experience as $collection) {
		  		$id = $collection['value'];
		  		$collection_obj = field_collection_item_load($id);
		  		$fc_wrapper = entity_metadata_wrapper('field_collection_item', $collection_obj);
		  		$begin = format_date($fc_wrapper->field_work_start->value(), 'date_ym');
		  		$end = format_date($fc_wrapper->field_work_end->value(), 'date_ym');
		  		$company = $fc_wrapper->field_company_name->value();
		  		$position = $fc_wrapper->field_position->value();
		  		if ($work_experience_html) {
		  			$work_experience_html .= '<br/>';
		  		}
		  		$work_experience_html .= $begin . '-' . $end . ' ' . $company . ' ' . $position;
		  	}
		  }
		  
		  $vars['work_experience_html'] = $work_experience_html;
		//}
	}
}


/**
 * Overrides theme_menu_tree().
 */
function bt_menu_tree(&$variables) {
	return '<ul class="menu btnsUl">' . $variables ['tree'] . '</ul>';
}