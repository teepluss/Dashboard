<?php

class model_products extends MY_Model {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getItems($filters=array(), $p, $limit, $order=array())
	{
		$sql = CIDb::select();
		$sql->from('products')
			->order($orders);
			
		if (isset($filters['some'])) {
			$some = $filters['some'];
			if (strlen($some) > 0) $sql->where('some=?', $some);
		}
		
		return CIDb::fetchPage($sql, array(), $p, $limit);
	}
	
	public function getItem($id)
	{
		$sql = CIDb::select();
		$sql->from('products')
			->where('id=?', $id);
			
		return CIDb::fetchRow($sql);
	}
	
	public function insert($data)
	{
		return CIDb::insert('products', $data);
	}
		
	public function update($data, $id)
	{
		$this->updateSpecific($data, array(
			CIDb::quoteInto('id=?', $id);
		));
		// clear cache
	}
	
	public function updateSpecific($data, $criteria)
	{
		return CIDb::update('products', $data, $criteria);
	}
	
	public function delete($id)
	{
		$this->deleteSpecific(array(
			CIDb::quoteInto('id=?', $id);
		));
		// clear cache
	}
	
	public function deleteSpecific($criteria)
	{
		return CIDb::delete('products', $criteria);
	}
	
}