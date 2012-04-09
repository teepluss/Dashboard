<?php

/**
 * To check environment
 * If you want allow all, pass any words except existing
 * Default is allow all cases
 *
 *
 * @access	 public
 * @param string (development, production, testing)
 * @return	bool
 */
function is_environment($mode='any')
{
	// Any mode
	if (!in_array($mode, array('development', 'production', 'testing'))) {
		return true;
	}

	// Exact mode
	if (strcasecmp(constant('ENVIRONMENT'), $mode) == 0) {
		return true;
	}
	return false;
}

/**
 * To check allow permission
 * 
 * @access public
 * @param  string
 * @param  string
 * @param  string
 * @return bool
 */
function is_allowed($controller, $action, $role=null)
{
	// if the role is null, look up for the user session info.
	if (is_null($role)) {
		$role = 'Guest';
	}	
	$CI =& get_instance();
	return $CI->access_control->isAllowed($role, $controller, $action);
}