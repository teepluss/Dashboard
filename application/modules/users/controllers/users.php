<?php

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('/users/profile');
	}
	
	public function account()
	{
		$this->template->write_view('content', 'users-account');
		$this->template->render();
	}
	
	public function profile()
	{
		$user = (array)CIUser::authInfo();
		alert( $user );
		exit;
	}
	
}