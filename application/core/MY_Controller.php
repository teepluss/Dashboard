<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class MY_Controller extends MX_Controller {

	private $_controller;
	private $_method;

	public function __construct() 
	{
		parent::__construct();
		
		$this->_controller = $this->uri->segment(1);
		$this->_method = $this->uri->segment(2);
		
		// acl code here
	}
	
}