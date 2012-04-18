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
	}
	
	public function profile()
	{
		$user = (array)CIUser::authInfo();
		alert( $user );
		exit;
	}
	
}