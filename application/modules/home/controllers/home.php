<?php

class Home extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->template->set_template('basic');
		$this->template->write_view('content', 'home-index');
		$this->template->render();
	}
	
}