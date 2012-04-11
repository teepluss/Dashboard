<?php

class Api extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	
		$this->template->write_view('content', 'api-index');
		$this->template->render();
	}
	
}