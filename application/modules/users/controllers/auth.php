<?php

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('/users/auth/sign_in');
	}
	
	public function sign_in($token=null)
	{
		$view = array();

		if ($this->input->is_post()) 
		{
			// flag state continue running
			$state = true;
			
			// check input validation
			$this->load->library('form_validation');
			if ($this->form_validation->run('users/auth/sign_in') == false)
			{
				$state = false;
				$view['errors'] = validation_errors();
			}			
			
			// check login information
			if ($state === true)
			{			
				$username = $this->input->post('username');
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
			}
			
			// store data and redirect to right place
			if ($state === true)
			{
				// get result from auth
				$rowObject = $authAdapter->getResultRowObject();
				$user_id = $rowObject->id;
				
				// remember me
				$rememberMe = $this->input->post('remember') ? true : false;
				
				// store session
				$this->auth->storeUserId($user_id, $rememberMe);
				
				// stamp time
				$this->load->model('model_users', 'users');
				$this->users->update(array('last_access' => CIDb::expr('NOW()')), $user_id);
				
				// redirection
				$redirection = $this->input->get_post('redirect');
				$redirection = ($redirection) ? urldecode($redirection) : '/dashboard';
				
				// add fragment
				$redirection .= '#logged_in';
				redirect($redirection);
			}			
		
		} // end if is_post
		
		// load template
		$this->template->write_view('content', 'auth-sign_in', $view);
		$this->template->render();
	}
	
	public function sign_out()
	{
		$this->load->model('model_auth', 'auth');
		$this->auth->clear();
		
		// redirection
		$redirection = $this->input->get_post('redirect');
		$redirection = ($redirection) ? urldecode($redirection) : '/';
		
		// add fragment
		$redirection .= '#logged_out';
		redirect($redirection);
	}
	
	public function connect($service='facebook')
	{
		if (!in_array($service, array('facebook'))) {
			show_404();
		}
		
		$this->load->library('fb');
		$user = $this->fb->api('/me');
		
		if (isset($user['id']))
		{						
			$this->load->model('model_users', 'users');
			$this->load->model('model_open_ids', 'open_ids');
			
			$entry = $this->open_ids->getItemFromService($service, $user['id']);
			if (!is_array($entry) || count($entry) == 0)
			{
				$email = $user['email'];	
				if ($this->users->getUserIdFromDuplicate('email', $email)) {
					redirect('users/register/merge/'.$service.'#email_exists');
				}
				redirect('users/register/connect/'.$service.'#connected');
			}
			
			// user_id
			$user_id = $entry['user_id'];
			$user_data = $this->users->getItem($user_id);
			
			if (!is_array($user_data)) {
				redirect('users/auth/sign_in#user_not_exists');
			}
			
			if ($user_data['active'] == 0) {
				redirect('users/auth/sign_in#user_inactive');
			}
			
			// store data
			$this->load->model('model_auth', 'auth');
			$this->auth->store(array(
				'userId'  => $user_data['id'],
				'service' => $service
			));
			
			// stamp time
			$this->users->update(array('last_access' => CIDb::expr('NOW()')), $user_data['id']);
			
			// redirection
			$redirection = $this->input->get_post('redirect');
			$redirection = ($redirection) ? urldecode($redirection) : '/dashboard';
			
			// add fragment
			$redirection .= '#connected';
			redirect($redirection);
		}

		$loginUrl = $this->fb->getLoginUrl(array(
			'scope' => 'email'
		));		
		redirect($loginUrl);
		
	}
	
}