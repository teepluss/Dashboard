<?php

class model_open_ids extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getItemFromService($service, $uid)
	{
		$sql = CIDb::select();
		$sql->from('open_ids')
			->where('service=?', $service)
			->where('uid=?', $uid);
			
		return CIDb::fetchRow($sql);
	}
	
	public function insert($data)
	{
		return CIDb::insert('open_ids', $data);
	}
	
}