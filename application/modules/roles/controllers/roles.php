<?php

class Roles extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function manage()
	{
	}
	
	public function add()
	{
		if ($this->input->is_post()) 
		{
			echo 'DO';
		}
	}
	
	public function edit($id)
	{
		if ($this->input->is_post()) 
		{
			echo 'DO';
		}
	}
	
	public function delete($id='', $action=null)
	{
		if ($action == 'action')
		{
			echo 'DO';
		}
		// preview what I am deleting
	}
	
}