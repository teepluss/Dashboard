<?php

/**
 * CustomArrayObject class.
 * 
 * @extends ArrayObject
 */
class CustomArrayObject extends ArrayObject {

	/**
	 * Get an object index
	 * 
	 * @access public
	 * @param  string
	 * @return mixed
	 */
	public function get($_id)
	{
		if (parent::offsetExists($_id)){
            return $this[$_id];
        } 
        return false;
	}
	
	/**
	 * Get an object index ID
	 * 
	 * @access public
	 * @param  string
	 * @return integer
	 */
	public function getId()
	{
		return $this->get('id');
	}
    
}