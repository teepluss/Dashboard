<?php

class Categories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function records()
	{
		// user manage items  
		$content = modules::run('terms/_records', 'products');
		$this->template->write('content', $content);
		$this->template->render();
	}
	
	public function add()
	{
		// user add item
		echo modules::run('terms/_add', 'products');
	}
	
	public function edit($id)
	{
		// user edit item
		echo modules::run('terms/_edit', 'products', $id);
	}
	
	public function delete($id, $action=null)
	{
		// user delete item
		echo modules::run('terms/_delete', 'products', $id, $action);
	}
	
}