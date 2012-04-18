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
	public function get($_id='')
	{
		if (parent::offsetExists($_id)) 
		{
            if (is_array($this[$_id])) {
            	return new CustomArrayObject($this[$_id]);
            }
            return $this[$_id];
        } 
        return '';
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
	
	/**
	 * Magic method __get
	 * 
	 * @access public
	 * @param  string
	 * @return mixed
	 */
	public function __get($_id)
	{
		if (parent::offsetExists($_id)) {
			return $this[$_id];
		}
		return false;
	}
    
}