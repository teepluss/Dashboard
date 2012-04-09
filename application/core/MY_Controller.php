<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	
	/**
	 * ACL variable
	 */
	public $acl;

	/**
	 * Controller segment
	 */
	private $_controller;	
	
	/**
	 * Action segment
	 */
	private $_action;

	public function __construct() 
	{
		parent::__construct();
		
		// get the check list from real uri
		$this->_controller = CI::$APP->router->class;
		if ($module = CI::$APP->router->get_module()) {
			$this->_controller = $module.':'.CI::$APP->router->class;
		}
		$this->_action = CI::$APP->router->method;
		
		// instance Zend_Acl
		$this->load->library('access_control');
		$this->acl = $this->access_control;
		
		// add roles
		$this->load->model('roles/model_roles', 'roles');
		$roles = $this->roles->getRoles();
		foreach ($roles as $role) 
		{
			$this->acl->addRole($role['id'], $role['inherit']);
		}		
		
		 // add resources
		$this->load->model('roles/model_resources', 'resources');
		$resources = $this->resources->getResources();
		foreach ($resources as $resource) 
		{
			$this->acl->addResource($resource['controller']);
		}
		
		// add relation between roles and resources
		$this->load->model('roles/model_roles_resources', 'roles_resources');
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
						$this->acl->permission($allowType, $role_id);
						break;
					// allow or deny all methods in controller specific
					case ($controller != '#all' and $action == '#all') :
						$this->acl->permission($allowType, $role_id, $controller);
						break;
					// allow or deny case by case
					default :
						$this->acl->permission($allowType, $role_id, $controller, $action);
						break;
				}				
			}
		}
		
		// current role
		$user_role_id = 'God'; 
		
		if (!$this->acl->isAllowed($user_role_id, $this->_controller, $this->_action)) {
			// the error report on development environment only
			if (is_environment('development')) {
				$exception_msg = 'The role '.$user_role_id.' has no permission to access '. $this->_controller.'('.$this->_action.')';
				throw new Exception($exception_msg);
			}
			
			// do something, such as redirect to login page like that!
			// code here			
		}
	}
	
}