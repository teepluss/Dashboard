<?php

class Terms extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function _records($slug)
	{
		// manage term with filter user_id
		$this->template->write_view('content', 'admin-add');
		$this->template->render();
	}
	
	public function _add($slug)
	{
		if ($this->input->is_post()) 
		{
			// action
			echo "Hey";
		}
		// template render
	}
	
	public function _edit($slug, $id)
	{
		echo $slug;
	}
	
	public function _delete($slug, $id, $action=null)
	{
		echo $slug;
	}
	
}