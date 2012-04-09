<?php

require_once('Zend/Acl.php');

/**
 * Access Control Class
 */
class Access_control {

	/**
	 * Acl static variable
	 */
	public static $acl;

	/**
	 * The default role name for guest
	 */
	public $defaultRole = 'Guest';
	
	/**
	 * Allow if resources is not exists
	 */
	public $allowOnControllerNotExists = true;
	
	/**
	 * Construct
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		self::$acl = new Zend_Acl();
	}
	
	/**
	 * Set default role name for guest
	 * 
	 * @access public
	 * @param  string
	 * @return void
	 */
	public function setDefaultRole($val)
	{
		$this->defaultRole = $val;
	}
	
	/**
	 * Get default role name
	 * 
	 * @access public
	 * @return string
	 */
	public function getDefaultRole()
	{
		return $this->defaultRole;
	}
	
	/**
	 * Set permission if resources is not exists
	 * 
	 * @access public
	 * @param  bool
	 * @return void
	 */
	public function setAllowOnControllerNotExists($val)
	{
		$this->allowOnControllerNotExists = $val;
	}
	
	/**
	 * Get permission if resources is not exists
	 * 
	 * @access public
	 * @return bool
	 */
	public function getAllowOnControllerNotExists()
	{
		return $this->allowOnControllerNotExists;
	}
	
	/**
	 * Add role
	 * 
	 * @access public
	 * @param  string 
	 * @param  string
	 * @return void
	 */
	public function addRole($role, $inheritFromRole=null)
	{
		if (!is_null($inheritFromRole)) {			
			self::$acl->addRole(new Zend_Acl_Role($role), $inheritFromRole);
		}
		else {
			self::$acl->addRole(new Zend_Acl_Role($role));
		}
	}
	
	/**
	 * Add resource (controller)
	 * 
	 * @access public
	 * @param  string
	 * @return void
	 */
	public function addResource($resource)
	{
		self::$acl->add(new Zend_Acl_Resource($resource));
	}
	
	/**
	 * Set allow permission 
	 * 
	 * @access public
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return bool
	 */
	public function allowPermission($role, $contoller=null, $action=null)
	{
		return $this->permission('allow', $role, $controller, $action);
	}
	
	/**
	 * Set deny permission 
	 * 
	 * @access public
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return bool
	 */
	public function denyPermission($role, $contoller=null, $action=null)
	{
		return $this->permission('deny', $role, $controller, $action);
	}
	
	/**
	 * Set permission for controller and action
	 * 
	 * @access public
	 * @param  string
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return void
	 */
	public function permission($type, $role, $controller=null, $action=null)
	{
		if (!in_array($type, array('allow', 'deny'))) {
			throw new Exception('The type of permission is incorrect.');
		}
		
		if (!self::$acl->hasRole($role)) {
			throw new Exception('The role name '.$role.' not found.');
		}
		
		if (!self::$acl->has($controller)) {
			$this->addResource($controller);
		}
				
		self::$acl->$type($role, $controller, $action);
	}
	
	/**
	 * Check allow permission
	 * 
	 * @access public
	 * @param  string
	 * @param  string
	 * @param  string
	 * @return bool
	 */
	public function isAllowed($role, $controller, $action)
	{
		$role = (self::$acl->hasRole($role)) ? $role : $this->getDefaultRole();
		
		if (!self::$acl->has($controller)) {
			return ($this->getAllowOnControllerNotExists()) ? true : false;
		}
		
		return self::$acl->isAllowed($role, $controller, $action);
	}
	
}