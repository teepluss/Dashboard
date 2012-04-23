<?php

class model_users extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getItems($filters, $page=1, $limit=20, $order=array())
	{
	}
	
	public function getItem($id)
	{
		$sql = CIDb::select();
		$sql->from('users')
			->where('id=?', $id);
			
		return CIDb::fetchRow($sql);
	}
	
	public function insert($data)
	{
		return CIDb::insert('users', $data);
	}
	
	public function update($data, $id)
	{
		CIDb::update('users', $data, array(
			CIDb::quoteInto('id=?', $id)
		));
		return true;
	}
	
	public function delete($id)
	{
	}
	
	public function getUserIdFromDuplicate($field, $value)
	{
		$sql = CIDb::select();
		$sql->from('users', 'id')
			->where($field.'=?', $value);
		
		return CIDb::fetchOne($sql);
	}
	
}