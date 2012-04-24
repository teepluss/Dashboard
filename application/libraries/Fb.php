<?php

require_once('facebook/src/facebook.php');

class Fb extends Facebook {

	/**
	 * Load all config
	 * 
	 * @access public
	 * @param  array $config (default: array())
	 * @return void
	 */
	public function __construct($config=array())
	{
		if (count($config) == 0)
		{
			$CI =& get_instance();
			$CI->load->config('api');
			$config = $CI->config->item('facebook');
		}
		parent::__construct($config);
	}
	
	/**
	 * Remove persistance data in session
	 * 
	 * @access public
	 * @return void
	 */
	public function clear() 
	{
		$this->clearAllPersistentData();
	}
	
}