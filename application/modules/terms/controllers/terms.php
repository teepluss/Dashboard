<?php

/**
 * Terms Controller.
 * this controller is just abstract, 
 * so you need to implement another controller to inherit.
 *
 * EXAMPLE USAGE:
 * 
 	public function records()
	{
		$content = modules::run('terms/_records', 'products');
		$this->template->write('content', $content);
		$this->template->render();
	}
 * 
 * @extends MX_Controller
 */
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
		
		//alert( CIUser::authInfo()->get('info')->get('first_name') ); 
		
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