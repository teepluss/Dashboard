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
	
	public function connect($service='facebook')
	{
		if (!in_array($service, array('facebook'))) {
			show_404();
		}
		
		$this->load->library('fb');
		
		// get data from Facebook
		try {
			$user = $this->fb->api('/me');
		} 
		catch (Exception $e) { $user = array();	}
		
		if (!isset($user['id'])) {
			redirect('users/auth/sign_in#connect_failed');
		}
		
		$this->load->model('model_users', 'users');
		$this->load->model('model_open_ids', 'open_ids');
		
		$username = $service.$user['id'];
		$email = $user['email'];
		
		try {
			$data = array(
				'username'   => $username,
				'email'      => $email,
				'registered' => $service,
				'verified'   => 1,
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
		catch (Exception $e) {
			// duplicate user email
		}
	}
	
	public function merge($service='facebook')
	{
		if (!in_array($service, array('facebook'))) {
			show_404();
		}

		// load stuff we need
		$this->load->library('fb');
		
		$view = array();
		
		// in case success returned
		if ($success = validation_success()) {
			$view['success'] = $success;
		}
		
		// get data from Facebook
		try {
			$user = $this->fb->api('/me');
		} 
		catch (Exception $e) { $user = array();	}
		
		if (!isset($user['id'])) {
			redirect('users/auth/sign_in#connect_failed');
		}
		
		if ($this->input->is_post())
		{
			$state = true;
			
			$this->load->library('form_validation');
			if ($this->form_validation->run('users/register/merge') == false)
			{
				$state = false;
				$view['errors'] = validation_errors();
			}
			
			if ($state == true)
			{
				$username = $user['email'];
				$password = $this->input->post('password');
				
				$this->load->model('model_auth', 'auth');
				$authAdapter = $this->auth->identify($username, $password);
				$authAdpaterResult = $this->auth->authenticate($authAdapter);
				
				if (!$authAdpaterResult->isValid())
				{
					$state = false;
					
					// wrap single error with HTML tag and translate it!
					$error_msg = $this->form_validation->wrap_error_string('lang:Your login information is invalid.');
					$view['errors'] = $error_msg;
				}
				
				if ($state == true)
				{				
					// get result from auth
					$rowObject = $authAdapter->getResultRowObject();
					$user_id = $rowObject->id;
					
					try {
						$this->load->model('model_open_ids', 'open_ids');
						$data = array(
							'user_id'    => $user_id,
							'service'    => $service,
							'uid'        => $user['id'],				
							'created_at' => CIDb::expr('NOW()')
						);
						$this->open_ids->insert($data);
					}
					catch (Exception $e) {
						// duplicate open id
					}
					$this->form_validation->set_success_message('lang:OK Your account merged.');
					redirect('users/register/merge/'.$service.'#merged');
				}
			}
		}
		
		$view['service'] = $service;
		$view['email'] = $user['email'];
		
		$this->template->write_view('content', 'register-merge', $view);
		$this->template->render();
	}
	
}