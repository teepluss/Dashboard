<?php

require_once('Mustache/Mustache.php');

class Mustache_parser extends Mustache {
	
	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
	}

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