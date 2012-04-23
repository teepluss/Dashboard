<?php

class model_onetime_password extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function store($data)
	{
		$token = self::_generate_token();
		
		$values = serialize($data);
		
		return $token;
	}
	
	public function fetch($token)
	{
		$sql = CIDb::select();
		$sql->from('onetime_password')
			->where('token=?', $token);
			
		$entry = CIDb::fetchRow($sql);
		if (!is_array($entry) || $entry['active'] == 0) {
			return false;
		}
				
		$data = unserialize($entry['values']);
		
		// mark as used (deleted)
		$this->update(array(
			'active'=>0, 
			'flags'=>'deleted'
		), $entry['id']);
		
		return $data;
	}
	
	public function update($data, $id)
	{
		CIDb::update('onetime_password', $data, array(
			CIDb::quoteInto('id=?', $id)
		));
		return true;
	}
	
	private function _generate_token()
	{
		$this->load->helper('security');
		
		do
		{
			$token = do_hash(time().mt_rand());
		}
		while (self::_token_exists($token));

		return $token;
	}
	
	private function _token_exists($token)
	{
		$sql = CIDb::select();
		$sql->from('onetime_password', array('COUNT(*)'))->where('token=?', $token);
		return CIDb::fetchOne($sql) > 0;
	}
	
}