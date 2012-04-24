<?php

class model_roles extends MY_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getItems($filters=array(), $p=1, $limit=20, $orders=array())
	{
		$sql = CIDb::select();
		$sql->from('roles')
			->order($orders);
			
		if (isset($filters['active'])) {
			$active = $filters['active'];
			if (strlen($active) > 0) $sql->where('active=?', $active);
		}
		
		if (isset($filters['flags'])) {
			$flags = $filters['flags'];
			if (strlen($flags) > 0) $sql->where('flags=?', $flags);
		}
		
		return CIDb::fetchPage($sql, array(), $p, $limit);
	}
	
	public function getItem($id)
	{
		$sql = CIDb::select();
		$sql->from('roles')
			->where('id=?', $id);
			
		return CIDb::fetchRow($sql);
	}
	
	public function getRoles()
	{
		$sql = CIDb::select();
		$sql->from('roles')
			->order('order ASC');
			
		return CIDb::fetchAll($sql);
	}
	
}