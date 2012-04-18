<?php

class MY_Form_validation extends CI_Form_validation {

	protected $_error_prefix = '<div>';
	protected $_error_suffix = '</div>';
	
	public function wrap_error_string($error_msg)
	{
		$error_msg = $this->_translate_fieldname($error_msg);
		return $this->_error_prefix.$error_msg.$this->_error_suffix;
	}

}