<?php

/**
 * @see Autoloader
 */
require_once('Twig/Autoloader.php'); 
Twig_Autoloader::register();

/**
 * Twig template parser
 */
class Twigy_parser {

	public static $CI;
	
	public static $twig;

	public function __construct()
	{
		$loader = new Twig_Loader_String();
		self::$twig = new Twig_Environment($loader);
		self::$CI =& get_instance();
	}
	
	/**
	 * Parse view
	 * 
	 * @access public
	 * @param  string (path)
	 * @param  array
	 * @param  bool
	 * @return string HTML
	 */
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