<?php

class Products extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		// portal list items
	}
	
	public function id($id)
	{
		// portal show item
	}
	
	public function records()
	{
		// user manage items 
	}
	
	public function add()
	{
		// user add item
	}
	
	public function edit($id)
	{
		// user edit item
	}
	
	public function delete($id, $action=null)
	{
		// user delete item (just flag to delete)
	}
	
}