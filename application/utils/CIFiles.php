<?php

class CIFiles {

	public static $CI;
	
	public function __construct()
	{
		self::$CI =& get_instance();
	}

	public static function transfer()
	{
		self::$CI->load->model('files/model_files', 'files');
	}
	
}
