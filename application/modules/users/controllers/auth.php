<?php

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function sign_in()
	{
		if ($this->input->is_post()) 
		{
			echo 'DO';
		}
	}
	
	public function sign_out()
	{
		echo 'DO';
	}
	
	public function connect($service='facebook')
	{
	}
	
}