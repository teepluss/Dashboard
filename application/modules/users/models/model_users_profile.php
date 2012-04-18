<?php

class model_users_profile extends MY_Model {

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
		$sql->from('users_profile')
			->where('user_id=?', $id);
			
		return CIDb::fetchRow($sql);
	}
	
	public function insert($data)
	{
	}
	
	public function update($data, $id)
	{
	}
	
	public function delete($id)
	{
	}
	
}