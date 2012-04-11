<?php

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->template->set_template('fluid');
		$this->template->write_view('content', 'dashboard-admin');
		$this->template->render();
	}
	
}