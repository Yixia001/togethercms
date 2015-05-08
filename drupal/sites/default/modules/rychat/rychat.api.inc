<?php
include_once('class/Config.php');
include_once('class/ServerAPI.php');

function rychat_token_api($uid = NULL) {
	global $user;
	if ($uid) {
		$account = user_load($uid);
	} else {
		$account = user_load($user->uid);
	}
  if($user) {
  	$picture = file_create_url($account->picture->uri);
		$token = ServerAPI::getInstance()->getToken($account->uid, $account->name, $picture);
		$token->portrait = $picture;

		if (!$token) {
			throw new Exception('API Server Error');
		}
		if ($token->code != 200) {
			throw new ProException($token->errorMessage, $token->code);
		} else {
			$data = new stdClass();
			unset($token->code);
			//unset($token->userId);
			$name = isset($account->field_nikename[LANGUAGE_NONE][0]['value']) ? $account->field_nikename[LANGUAGE_NONE][0]['value']: $account->name;
			$token->username = $name;
			$token->id = $account->uid;
			$data->code = 200;
			$data->result[0] = $token;
			return $data;
		}
	} else {
		throw new ProException('user not found', 108);
	}
}