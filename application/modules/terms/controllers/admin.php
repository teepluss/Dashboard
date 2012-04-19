<?php

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function manage()
	{
		$this->load->model('model_terms', 'terms');
		
		$tree = $this->terms->build(1)->getTree(0);
		//alert( $tree );
		
		$childIds = $this->terms->build(1)->getChildIds(2);
		//alert( $childIds, true );
		
		$parentPathIds = $this->terms->build(1)->getParentNodes(8);
		alert( $parentPathIds, true );
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