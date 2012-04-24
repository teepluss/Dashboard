<?php

class CIWidget {

	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
	}
	
	public static function navigator($region, $data=array())
	{
		return self::$CI->load->view('navigators/'.$region, $data, true);
	}
	
	public static function widget($widget, $params=array())
	{
		$data = self::$widget($params);
		return self::$CI->load->view('widgets/'.$widget, $data, true);
	}
	
}