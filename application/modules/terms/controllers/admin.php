<?php

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function manage($slug)
	{
		// admin manage items
	}
	
	public function add($slug)
	{
		// admin add item (normally don't use)
	}
	
	public function edit($slug, $id)
	{
		// admin edit item (normally don't use)
	}
	
	public function delete($slug, $id, $action=null)
	{
		// admin delete item (just flag to delete)
	}
	
	public function trash($slug, $id, $action=null)
	{
		// admin delete item (clean delete)
	}
	
}