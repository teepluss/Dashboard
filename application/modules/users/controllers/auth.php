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
	
	public function sign_in()
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
		/*$this->model('model_auth', 'auth');
		$this->auth->store(array(
			'userId'  => $user_id,
			'service' => $service
		));*/
	}
	
}