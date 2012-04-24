<?php

class model_resources extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getToGroups($filters)
	{
		$sql = CIDb::select();
		$sql->from('resources')
			->order('group ASC');
			
		if (isset($filters['active'])) {
			$active = $filters['active'];
			if (strlen($active) > 0) $sql->where('active=?', $active);
		}

		return CIDb::fetchGroup($sql, array(), 'group');
	}
	
	public function getResources()
	{
		$sql = CIDb::select()->distinct();
		$sql->from('resources', 'controller')
			->where('active=?', 1);
		
		return CIDb::fetchAll($sql);
	}
	
}