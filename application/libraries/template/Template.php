<?php

require_once('TemplateBase.php');

class Template extends TemplateBase {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Override _build_content()
	 *
	 * Add url to auto load regions template
	 * 
	 * @access	private
	 * @param	string	region to build
	 * @param	string	HTML element to wrap regions in; like '<div>'
	 * @param	array	Multidimensional array of HTML elements to apply to $wrapper
	 * @return	string	Output of region contents
	 */
	function _build_content($region, $wrapper = NULL, $attributes = NULL)
	{
   		if (isset($region['url'])) 
   		{
   			$path = $this->template['template'].'/'.$region['url'];
   			$view = $this->CI->load->view($path, array(), true);
   			$region['content'] = array($view);
   			unset($region['url']);
   		}
   		
   		return parent::_build_content($region, $wrapper, $attributes);
	}
	
}