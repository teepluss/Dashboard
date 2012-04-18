<?php

class Terms extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function _records($slug)
	{
		$this->load->model('model_terms', 'terms');
		$view['entries'] = $this->terms->getItems();
		// manage term with filter user_id
		
		//alert( CIUser::authInfo()->get() ); exit(0);
		
		return $this->load->view('admin-add', $view, true);
	}
	
	public function _add($slug)
	{
		if ($this->input->is_post()) 
		{
			// do something
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