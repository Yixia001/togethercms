<?php
/**
 * @file
 */
function _is_partner($user) {
	return in_array('partner', $user->roles);
}

function _is_investor($user) {
	return in_array('investor', $user->roles);
}

function _get_term_name($object, $field) {	
	$field_array = $object->$field;
	$tid = isset ( $field_array[LANGUAGE_NONE] ) ? $field_array[LANGUAGE_NONE] [0] ['tid'] : '';

	if ($tid) {
		$term = taxonomy_term_load ( $tid );
		return $term->name;
	} else {
		return '';
	}
}