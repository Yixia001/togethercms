<?php
include_once('class/Config.php');
include_once('class/ServerAPI.php');

function rongimchat_token_api($uid = NULL) {
	global $user;
	if ($uid) {
		$account = user_load($uid);
	} else {
		$account = user_load($user->uid);
	}
  if($account) {
  	$token = rongimchat_get_token($account->uid);

  	$picture = file_create_url($account->picture->uri);
  	$token_obj = new stdClass();
  	if (!$token) {
  		$token_obj = ServerAPI::getInstance()->getToken($account->uid, $account->name, $picture);  
  		if (!$token_obj) {
  			throw new Exception('API Server Error');
  		}	
  		if ($token_obj->code != 200) {
  			return false;
  			//throw new ProException($token->errorMessage, $token->code);
  		}
  		$token = $token_obj->token;
  		rongimchat_add_token($account->uid, $token);
  	} else {
  		$token_obj->token = $token;
  	}
  	$token_obj->portrait = $picture;

		
		 
		$data = new stdClass();
		unset($token->code);
		//unset($token->userId);
		$name = isset($account->field_nikename[LANGUAGE_NONE][0]['value']) ? $account->field_nikename[LANGUAGE_NONE][0]['value']: $account->name;
		$token_obj->username = $name;
		$token_obj->id = $account->uid;
		$data->code = 200;
		$data->result[0] = $token_obj;
		return $data;
		
	} else {
		throw new ProException('user not found', 108);
	}
}

function rongimchat_get_token($uid) {
	return db_query('select token from {rongimchat_token} where uid = :uid', array(':uid' => $uid))->fetchField();
}

function rongimchat_add_token($uid, $token) {
	$data = (object) array(
			'uid' => $uid,
			'created' => REQUEST_TIME,
			'token' => $token,
			'remote_addr' => ip_address(),
	);
	drupal_write_record('rongimchat_token', $data);
}