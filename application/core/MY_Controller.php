<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('Zend/Acl.php');

abstract class MY_Controller extends MX_Controller {
	
	public static $acl;
	
	private $_controller;
	private $_action;

	public function __construct() 
	{
		parent::__construct();
		
		// get the check list from real uri
		$this->_controller = CI::$APP->router->class;
		if (CI::$APP->router->get_module()) {
			$this->_controller = CI::$APP->router->get_module().':'.CI::$APP->router->class;
		}
		$this->_action = CI::$APP->router->method;
		
		// instance Zend_Acl
		self::$acl = new Zend_Acl();
		
		// add roles
		$this->load->model('roles/model_roles', 'roles');
		$roles = $this->roles->getRoles();
		foreach ($roles as $role) 
		{
			if ($role['inherit'] != null) {
				self::$acl->addRole($role['id'], $role['inherit']);
			} 
			else {
				self::$acl->addRole($role['id']);
			}			
		}		
		
		 // add resources
		$this->load->model('resources/model_resources', 'resources');
		$resources = $this->resources->getResources();
		foreach ($resources as $resource) 
		{
			self::$acl->addResource($resource['controller']);
		}
		
		// add relation between roles and resources
		$this->load->model('roles_resources/model_roles_resources', 'roles_resources');
		$roles_resources = $this->roles_resources->getRolesResources();
		foreach ($roles_resources as $role_id => $resources)
		{
			foreach ($resources as $resource)
			{
				// controller and action
				$controller = $resource['controller'];
				$action = $resource['action'];
				
				// allow or deny
				$allowType = (strcmp($resource['allow'], 1) == 0) ? 'allow' : 'deny';
				switch (true)
				{
					// allow or deny all site, this should give to admin
					case ($controller == '#all' and $action == '#all') :
						self::$acl->$allowType($role_id);
						break;
					// allow or deny all methods in controller specific
					case ($controller != '#all' and $action == '#all') :
						self::$acl->$allowType($role_id, $controller);
						break;
					// allow or deny case by case
					default :
						self::$acl->$allowType($role_id, $controller, $action);
						break;
				}				
			}
		}		
		
		if (!self::$acl->isAllowed('Administrator', $this->_controller, $this->_action)) {
			// do something, such as force to login page
		}
	}
	
}