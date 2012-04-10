<?php

class Terms extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function records($slug)
	{
		// manage term with filter user_id
	}
	
	public function add($slug)
	{
		if ($this->input->is_post()) 
		{
			// action
		}
		// template render
	}
	
	public function edit($slug, $id)
	{
		echo $slug;
	}
	
	public function delete($slug, $id, $action=null)
	{
		echo $slug;
	}
	
}