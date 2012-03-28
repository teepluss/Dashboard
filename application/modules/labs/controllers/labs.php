<?php

class Labs extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->template->write_view('content', 'labs/index');
		$this->template->render();
	}
	
	public function call()
	{
		// $this->load->module('module/controller');
		//$this->load->module('home');
		//$this->home->test();
		
		$m = Modules::load('home');
		$m->test();
	}
	
	public function validate()
	{
		$this->load->library('form_validation');
	}
	
	public function cron($a, $b)
	{
		echo $a."---".$b;
	}
	
}