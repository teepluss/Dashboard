<?php

class model_terms extends MY_Model {

	private $_tree = array();

	public function __construct()
	{
		parent::__construct();
	}
	
	private function getTerms($vid, $pub_id)
	{
		$ckey = 'terms_vid'.$vid.'_pubid_'.$pub_id;
		
		$sql = CIDb::select();
		$sql->from(array('t' => 'terms'), array('id', 'name', 'active', 'weight'))
			->joinLeft(array('th' => 'terms_hierarchies'), 't.id=th.term_id', array('parent_id' => 'term_parent_id'))
			->order('weight ASC');			

		if (strlen($vid) > 0) $sql->where('vocabulary_id=?', $vid);
		
		if (strlen($pub_id) > 0) $sql->where('pub_id=?', $pub_id);

		$entries = CIDb::fetchAll($sql);
		
		return $entries;
	}
	
	private function buildTree($categories)
	{	
		if (count($categories) == 0) {
			return false;
		}
		
		$entries = $categories;
		$items = $categories;
		$childs = array();

    	foreach($items as &$item) 
    	{
    		$childs[$item['parent_id']][$item['id']] = &$item;
    		unset($item);
    	}

    	foreach($items as &$item) 
    	{
    		if (isset($childs[$item['id']])) {
            	$item['childs'] = $childs[$item['id']];
            }
		}
		
		$response = array(
			'entries' => $entries,
			'tree'  => $childs			
		);   	
    	return $response;
	}
	
	public function build($vid, $pub_id=null, $status=null)
	{
		$parent_id = 0;
	
		$entries = $this->getTerms($vid, $pub_id);
		$terms = array();
		
		if (count($entries) > 0) foreach ($entries as $entry)
		{
			if (!is_null($status)) 
			{
				if (strcmp($entry['active'], $status) == 0) {
					$terms[$entry['id']] = $entry;
				}				
			}
			else 
			{
				$terms[$entry['id']] = $entry;
			}
		}
		$this->_tree = $this->buildTree($terms);
		return $this;
	}
	
	public function getTree($parent_id=0)
	{
		if (!isset($this->_tree['tree'][$parent_id])) {
			return false;
		}
		return $this->_tree['tree'][$parent_id];
	}
	
	public function getChildIds($term_id, &$paths=array())
	{
		if ($term_id <= 0) {
			return;
		}
		
		$childs = $this->getTree($term_id);

		if (is_array($childs) && count($childs) > 0) 
		{
			foreach ($childs as $key => $val)
			{
				array_push($paths, $val['id']);
				if (isset($val['childs'])) {
					$this->getChildIds($val['id'], $paths);
				}
			}			
		}
		return $paths;
	}
	
	public function getParentNodes($term_id, &$paths=array())
	{
		if ($term_id <= 0) {
			return;
		}
		
		if (!isset($this->_tree['entries'])) {
			return;
		}
		
		$response = $this->_tree['entries'];
				
		if (isset($response[$term_id]))
		{
			$item = $response[$term_id];
			if ($item['parent_id'] != 0) 
			{			
				$parent_id = $item['parent_id'];
				if (array_key_exists($parent_id, $response))
				{
					$node = $response[$parent_id];
					array_push($paths, $node);
					$this->getParentNodes($item['parent_id'], $paths);
				}
			}
		}		
		return array_reverse($paths);
	}
	
}