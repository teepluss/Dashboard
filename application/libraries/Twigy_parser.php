<?php

require_once('Twig/Autoloader.php'); 
Twig_Autoloader::register();

class Twigy_parser {

	public static $CI;
	
	public static $twig;

	public function __construct()
	{
		$loader = new Twig_Loader_String();
		self::$twig = new Twig_Environment($loader);
		self::$CI =& get_instance();	
		
		/**
		 * How to add global
		 */	
		self::$twig->addGlobal('any', new Any);
		
		/**
		 * How to add filter to twig
		 */		
		/*function call($data)
		{
			return $name;
		}
		$filter = new Twig_Filter_Function('call');
		self::$twig->addFilter('call', $filter);*/
	}

	public function parse($template, $data=array(), $return=false)
	{
		$data = (array)$data;

		$v = self::$CI->load->view($template, '', true);
		$t = self::$twig->render($v, $data);
		if ($return == false)
		{
			$this->_obj =& get_instance();
			$this->_obj->output->append_output($t);
		}
		return $t;
	}
	
}

/**
 * Any load anything from CI environment.
 */
class Any {

	public function helper($what)
	{
		$args = func_get_args();
		unset($args[0]);
		return call_user_func_array($what, $args);
	}
	
}