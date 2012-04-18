<?php

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('roles/admin/roles_manage');
	}
	
	public function roles_manage()
	{
		// list roles
	}
	
	public function roles_add()
	{
		$_POST['title'] = 'sss';
		// add new role
		$this->load->library('form_validation');

		if ($this->form_validation->run('roles/admin/roles_add') == true) 
		{
			echo "padd";
		}
		else 
		{
			echo "Failed";
			echo validation_errors();
		}
	}
	
	public function roles_edit($id)
	{
		// edit role
	}
	
	public function roles_delete($id, $action=null)
	{
		// delete role
	}
	
	public function resources_manage($role_id)
	{
		// list resources
	}
	
	public function resources_add($role_id)
	{
		// add new resource
	}
	
	public function resources_edit($role_id, $id)
	{
		// edit resource
	}
	
	public function resources_delete($role_id, $id, $action=null)
	{
		// delete resource
	}
	
}