<?php

class Labs extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->template->write_view('content', 'labs_index');
		$this->template->render();
	}
	
}