<?php

require_once('facebook/src/facebook.php');

class Fb extends Facebook {

	public function __construct($config=array())
	{
		if (count($config) == 0)
		{
			$CI =& get_instance();
			$CI->load->config('api');
			$config = $CI->config->item('facebook');
		}
		parent::__construct($config);
	}
	
}