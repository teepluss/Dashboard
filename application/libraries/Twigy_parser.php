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
		self::$twig->addGlobal('any', new Twigy_tools);
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
class Twigy_tools {

	public function helper($what)
	{
		$args = func_get_args();
		unset($args[0]);
		return call_user_func_array($what, $args);
	}
	
	public function util($what)
	{
		$args = func_get_args();
		unset($args[0]);
		return call_user_func($what, $args);
	}
	
}