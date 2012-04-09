<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Input extends CI_Input {

	/**
	 * Check GET
	 * 
	 * @access public
	 * @return bool
	 */
	public function is_get()
	{
		return (isset($_GET) && count($_GET) > 0);
	}
	
	/**
	 * Check POST
	 * 
	 * @access public
	 * @return bool
	 */
	public function is_post()
	{
		return (isset($_POST) && count($_POST) > 0);
	}
	
	/**
	 * Check GET or POST
	 * 
	 * @access public
	 * @return bool
	 */
	public function is_get_post()
	{
		return ($this->is_get() || $this->is_post());
	}

}