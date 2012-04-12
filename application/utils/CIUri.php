<?php

class CIUri {

	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
		self::$CI->load->helper('url');
	}

	/**
	 * Get base url 
	 * this function is the same with site_url()
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @return string
	 */
	public static function base($uri='')
	{		
		return site_url($uri);
	}
	
	/**
	 * Get top url
	 * this function return the same host name on the address bar
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @return string
	 */
	public static function top($uri)
	{
		$base_url = self::base($uri);
		return preg_replace('|'.parse_url($base_url, PHP_URL_HOST).'|', $_SERVER['HTTP_HOST'], $base_url);
	}
	
	/**
	 * Get assests url
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @return string
	 */
	public static function assets($uri='')
	{
		return self::base('assets/'.$uri);
	}
	
	/**
	 * Get publisher url
	 * this is shortcut to look up merchant path
	 * 
	 * @access public
	 * @static
	 * @param  integer
	 * @param  string 
	 * @return string
	 */
	public static function publisher($id, $uri='')
	{
		$publisher_info = CIUser::publisherInfo($id);
		return $publisher_info['url'].'/'.ltrim($uri, '/');
	}
	
}