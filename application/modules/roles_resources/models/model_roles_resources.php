<?php

class model_roles_resources extends MY_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getRolesResources()
	{
		$sql = CIDb::select();
		$sql->from('roles_resources')
			->join('resources', 'roles_resources.resource_id=resources.id', array('controller', 'action'))
			->where('resources.active=?', 1);			
				
		return CIDb::fetchGroup($sql, array(), 'role_id');
	}
	
}