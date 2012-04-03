<?php

class Lang extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		header('Content-Type:text/html;charset=UTF-8');
		$this->lang->load('app');
		echo $this->lang->line('test');
	}
	
}