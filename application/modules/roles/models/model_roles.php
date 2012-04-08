<?php

class model_roles extends MY_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getRoles()
	{
		$sql = CIDb::select();
		$sql->from('roles')
			->order('order ASC');
			
		return CIDb::fetchAll($sql);
	}
	
}