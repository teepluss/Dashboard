<?php

class CIUser {

	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
	}

	public static function authInfo()
	{
	}

	public static function info($id)
	{
		
	}
	
}