<?php

class Register extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function user()
	{
		if ($this->input->is_post())
		{
			echo 'DO';
		}
	}
	
	public function publisher()
	{
		if ($this->input->is_post())
		{
			echo 'DO';
		}
	}
	
	public function connect($service='facebook', $email)
	{
		if (!in_array($service, array('facebook'))) {
			show_404();
		}
		
		$this->load->library('fb');
		$user = $this->fb->api('/me');
		
		if (!isset($user['id'])) {
			redirect('users/auth/sign_in#connect_failed');
		}
		
		$this->load->model('model_users', 'users');
		$this->load->model('model_open_ids', 'open_ids');
		
		$username = $service.$user['id'];
		$email = $user['email'];
		
		$data = array(
			'username'   => $username,
			'email'      => $email,
			'created_at' => CIDb::expr('NOW()'),
			'active'     => 1
		);
		$user_id = $this->users->insert($data);
		if ($user_id != false)
		{
			$data = array(
				'user_id'    => $user_id,
				'service'    => $service,
				'uid'        => $user['id'],				
				'created_at' => CIDb::expr('NOW()')
			);
			$this->open_ids->insert($data);
			
			redirect('/users/auth/connect/'.$service.'?state=ok');
		}
	}
	
	public function merge($service='facebook', $email)
	{
		if (!in_array($service, array('facebook'))) {
			show_404();
		}
		
		$this->load->library('fb');
		$user = $this->fb->api('/me');
		
		if (!isset($user['id'])) {
			redirect('users/auth/sign_in#connect_failed');
		}
		
		// ask user to re-confirm merge account
	}
	
}