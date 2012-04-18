<?php

class model_terms extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getItems($filters=array(), $p=1, $limit=20, $order=array())
	{
		$sql = CIDb::select();
		$sql->from('users');
		
		return CIDb::fetchAll($sql);
	}
	
}