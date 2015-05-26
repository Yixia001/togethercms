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