<?php

class model_resources extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getResources()
	{
		$sql = CIDb::select()->distinct();
		$sql->from('resources', 'controller')
			->where('active=?', 1);
		
		return CIDb::fetchAll($sql);
	}
	
}