<?php

/**
 * @see Mustache
 */
require_once('Mustache/Mustache.php');

/**
 * Mustache template parser
 * 
 * @extends Mustache
 */
class Mustache_parser extends Mustache {

	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
	}

	/**
	 * Parse view
	 * 
	 * @access public
	 * @param  string (path)
	 * @param  array
	 * @param  bool
	 * @return string HTML
	 */
	public function parse($template, $data=array(), $return=false)
	{
		$v = self::$CI->load->view($template, '', true);
		$t = parent::render($v, $data);
		
		if ($return == false)
		{
			$this->_obj =& get_instance();
			$this->_obj->output->append_output($t);
		}
		return $t;
	}
	
}