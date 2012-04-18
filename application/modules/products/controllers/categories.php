<?php

class Categories extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function records()
	{
		// user manage items  
		echo modules::run('terms/records', 'products');
	}
	
	public function add()
	{
		// user add item
		echo modules::run('terms/add', 'products');
	}
	
	public function edit($id)
	{
		// user edit item
		echo modules::run('terms/edit', 'products', $id);
	}
	
	public function delete($id, $action=null)
	{
		// user delete item
		echo modules::run('terms/delete', 'products', $id, $action);
	}
	
}