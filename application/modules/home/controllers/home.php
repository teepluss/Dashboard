<?php

class Home extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		//echo "Home:Index";
		
		/** Call another controller **/
		echo modules::run('welcome/welcome/index');
	}
	
}