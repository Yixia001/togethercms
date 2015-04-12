<?php
/**
 * @file
 */

define('LOG_FILE', 'php.log');

function debug_msg($message) {
	try {
		// can also use drupal_debug here
		require_once 'Log.php';
		Log::singleton('file', file_directory_temp().'/'.LOG_FILE, 'php')
		->log($message);
	}
	catch(Exception $e) {
		print 'Debug message failed: '.$e->getMessage();
	}
}

function debug_var($var, $msg='') {
	try {
		$traces = debug_backtrace();
		$self = array_shift($traces);
		$caller_function = $self['function'];
		$caller_file = $self['file'];
		while(!empty($traces)){
			$trace = array_shift($traces);
			if (isset($trace['file']) && strpos($trace['file'], $caller_file) === false) {
				$caller_function = $trace['function'];
				$caller_file = $trace['file'];
				$trace = array_shift($traces);
				if ($trace && isset($trace['function'])) {
					$caller_function = $trace['function'];
				}
				break;
			}
		}
		debug_msg($caller_file.' '.$caller_function.' '.$msg.': '.print_r($var, true));
	}
	catch(Exception $e) {
		print 'Debug var failed: '.$e->getMessage();
	}
}

/**
 * http://stackoverflow.com/questions/1423157/print-php-call-stack
 */
function debug_stacktrace($msg='') {
	try {
		$e = new Exception;
		debug_var($e->getTraceAsString(), $msg);
	}
	catch(Exception $e) {
		print 'Debug stack trace failed: '.$e->getMessage();
	}
}

function valid_ssa_id($id) {
	return (bool)filter_var($id, FILTER_VALIDATE_INT, array("options" => array("min_range" => 0)));
}

/**
 * http://drupal.stackexchange.com/questions/8537/how-can-i-tell-that-my-hook-nodeapi-function-is-being-called-by-cron-and-not-a-u
 */
function main_is_running_under_cron() {
  global $user;
  return strpos(request_uri(), "/cron.php") === 0 && $user->uid == 0;
}

/**
 * Whether we're running as SPP portal
 * @return boolean
 */
function main_is_spp() {
  global $theme_key;
  return $theme_key == 'spp';
}

function node_exists($nid) {
	$sql  = 'SELECT * FROM node n WHERE n.nid = :nid';
	$sql_params = array(':nid' => $nid);
	return db_query($sql, $sql_params)->rowCount() > 0;
}

function get_node_type($nid) {
	$sql  = 'SELECT n.type FROM node n WHERE n.nid = :nid';
	$sql_params = array(':nid' => $nid);
	return db_query($sql, $sql_params)->fetchField();
}

function is_date_expired($date_str) {
	$date_ts = strtotime($date_str);
	if ($date_ts !== FALSE && $date_ts < time()) {
		return TRUE;
	}
	return FALSE;
}
