<?php

class MY_Form_validation extends CI_Form_validation {

	protected $_error_prefix = '<div>';
	protected $_error_suffix = '</div>';
	
	/**
	 * Single line error string with tag wrap
	 * 
	 * @access public
	 * @param  string $message
	 * @return string
	 */
	public function wrap_error_string($message)
	{
		$message = $this->_translate_fieldname($message);
		return $this->_error_prefix.$message.$this->_error_suffix;
	}
	
	/**
	 * Set flashdata success message
	 * 
	 * @access public
	 * @param  string
	 * @param  string $key (default: 'success')
	 * @return void
	 */
	public function set_success_message($message, $key='success')
	{
		$this->CI->load->library('session');
		$message = $this->_translate_fieldname($message);		
		$this->CI->session->set_flashdata($key, $message);
	}
	
	/**
	 * Get flashdata message with erap
	 * 
	 * @access public
	 * @param  bool $wrap (default: true)
	 * @param  string $key (default: 'success')
	 * @return string
	 */
	public function get_success_message($wrap=true, $key='success')
	{
		$this->CI->load->library('session');
		$message = $this->CI->session->flashdata($key);
		if ($wrap == false) {
			return $message
		}
		return $this->_error_prefix.$message.$this->_error_suffix;
	}

}