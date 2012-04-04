<?php

class Home extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		/** Call another controller **/
		echo modules::run('welcome/welcome/index');
	}
	
}