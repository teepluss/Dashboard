<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH.'third_party/MX/Router.php');

class MY_Router extends MX_Router {
	
	public function _parse_routes()
	{
		// add language routes
		require_once(APPPATH.'/config/lang.php');
		
		$GLOBALS['LNG'] = (object)$config;
		$langs = array_keys($config['lang_availables']);
		$langs = implode('|', $langs);
		$routes['^('.$langs.')/(.+)$'] = '$2';
		$routes['^('.$langs.')$'] = $this->routes['default_controller'];
		$this->routes = array_merge($this->routes, $routes);
		
		parent::_parse_routes();		
	}
	
}