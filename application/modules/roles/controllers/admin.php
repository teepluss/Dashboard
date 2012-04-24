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
		$view = array();
		
		$this->load->model('model_roles', 'roles');
		
		$filters = array(
			'flags' => 'normal'			
		);
		
		$entries = $this->roles->getItems($filters, 1, 999, array('order ASC'));		
		$view['entries'] = $entries['rows'];
		
		$this->template->write_view('content', 'admin-roles_manage', $view);
		$this->template->render();
	}
	
	public function roles_add()
	{
		$view = array();
		
		if ($this->input->is_post())
		{
		}
		$this->template->write_view('content', 'admin-roles_add', $view);
		$this->template->render();
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
		$this->load->model('model_roles', 'roles');
		$this->load->model('model_resources', 'resources');
		$this->load->model('model_roles_has_resources', 'roles_has_resources');
		
		$role = $this->roles->getItem($role_id);
		if (!is_array($role)) {
			show_error('Content not found.');
		}
		
		// in case success returned
		if ($success = validation_success()) {
			$view['success'] = $success;
		}
		
		if ($this->input->is_post())
		{
			// truncate before add new
			$this->roles_has_resources->deleteSpecificCretiria(array(
				CIDb::quoteInto('role_id=?', $role['id'])
			));
			$perms = $this->input->post('perms');
			if (count($perms) > 0) foreach ($perms as $resource_id => $perm)
			{
				$data = array(
					'role_id'     => $role['id'],
					'resource_id' => $resource_id,
					'allow'       => $perm['allow']
				);
				$this->roles_has_resources->insert($data);
			}
			
			// set message return
			$this->load->library('form_validation');
			$this->form_validation->set_success_message('lang:Privileges has been applied.');
			redirect('roles/admin/resources_manage/'.$role['id'].'#applied');
		}
		
		$filters = array(
			'active' => 1
		);
		$groups = $this->resources->getToGroups($filters);
		
		$view['role'] = $role;
		$view['groups'] = $groups;
		
		/**
		 * Allow only one checkbox take effect
		 */
		$this->template->add_js('
			$(function() {
				$("#resources_manage").find("table tbody tr").each(function() {
					$(this).find("td.perms > input:checkbox").click(function() {
						$(this).siblings().removeAttr("checked");
					});
				});
			});
		', 'embed');
		
		$this->template->write_view('content', 'admin-resources_manage', $view);
		$this->template->render();
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