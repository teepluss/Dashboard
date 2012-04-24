<?php

class model_roles_has_resources extends MY_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getRolesResources()
	{
		$sql = CIDb::select();
		$sql->from('roles_has_resources')
			->join('resources', 'roles_has_resources.resource_id=resources.id', array('controller', 'action'))
			->where('resources.active=?', 1);			
				
		return CIDb::fetchGroup($sql, array(), 'role_id');
	}
	
	public function insert($data)
	{
		return CIDb::insert('roles_has_resources', $data);
	}
	
	public function deleteSpecificCretiria($criteria)
	{
		return CIDb::delete('roles_has_resources', $criteria);
	}
	
}