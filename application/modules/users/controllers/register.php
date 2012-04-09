<?php

class Register extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function user()
	{
		if ($this->input->is_post())
		{
			echo 'DO';
		}
	}
	
	public function publisher()
	{
		if ($this->input->is_post())
		{
			echo 'DO';
		}
	}
	
	public function connect($service='facebook')
	{
	}
	
}