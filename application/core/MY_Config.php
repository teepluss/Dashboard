<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'third_party/MX/Config.php';

class MY_Config extends MX_Config {

	/**
	 * Override site_url 
	 *
	 * Add language segment to the base path
	 * 
	 * @access public
	 * @param  string $uri (default: '')
	 * @return string
	 */
	public function site_url($uri = '')
	{	
		if (is_array($uri)) {
			$uri = implode('/', $uri);
		}
		
		if (function_exists('get_instance'))
		{
			$CI =& get_instance();
			$uri = $CI->lang->localized($uri);			
		}		
		return parent::site_url($uri);
	}
	
}