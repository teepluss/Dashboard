<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'third_party/MX/Router.php');

class MY_Router extends MX_Router {
	
	public function _parse_routes()
	{
		// include lang config
		require_once(APPPATH.'/config/lang.php');
		
		// assign to global use in MY_Lang.php		
		$GLOBALS['LNG'] = (object)$config;
		
		// append language routes
		$langs = implode('|', array_keys($config['lang_availables']));
		$routes = array(
			'^('.$langs.')/(.+)$' => '$2',
			'^('.$langs.')$'      => $this->routes['default_controller']
		);
		$this->routes = array_merge($this->routes, $routes);
		
		parent::_parse_routes();		
	}
	
}