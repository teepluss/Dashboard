<?php

/**
 * Get an success message in flashdata
 * 
 * @access public
 * @return string
 */
function validation_success()
{
	$CI =& get_instance();
	$CI->load->library('form_validation');
	return $CI->form_validation->get_success_message();
}