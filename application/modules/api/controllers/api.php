<?php

class Api extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	
		$this->template->write_view('content', 'api_index');
		$this->template->render();
	}
	
}