<?php

header('Content-Type:text/html;charset=UTF-8');

class Lang extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$this->lang->load('app');
		echo '<p>'.$this->lang->line('test').'</p>';
		echo '<p><a href="'.site_url('labs/lang/next').'">'.site_url('labs/lang/next').'</a></p>';
		echo '<p><a href="/'.$this->lang->switch_uri('th').'">Switch to Thai</a></p>';
		echo '<p><a href="/'.$this->lang->switch_uri('en').'">Switch to English</a></p>';
	}
	
	public function next()
	{
	}
	
}