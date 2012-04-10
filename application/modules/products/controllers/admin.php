<?php

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('products/admin/manage');
	}
	
	public function manage()
	{
		// admin manage items
	}
	
	public function add()
	{
		// admin add item (normally don't use)
	}
	
	public function edit($id)
	{
		// admin edit item (normally don't use)
	}
	
	public function delete($id, $action=null)
	{
		// admin delete item (just flag to delete)
	}
	
	public function trash($id, $action=null)
	{
		// admin delete item (clean delete)
	}
	
}