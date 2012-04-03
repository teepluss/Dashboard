<?php

class CIUri {

	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
		self::$CI->load->helper('url');
	}

	public static function base($uri='')
	{		
		return site_url($uri);
	}
	
	public static function assets($uri='')
	{
	}
	
}