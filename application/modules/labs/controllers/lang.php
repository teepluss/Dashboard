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
		echo '<p>'.$this->lang->line('This is someone talk to you').'</p>';
		echo '<p>'.$this->lang->line('test').'</p>';
		echo '<p><a href="'.site_url('api').'">'.site_url('api').'</a></p>';
		echo '<p><a href="'.site_url('api/2.0/example').'">'.site_url('api/2.0/example').'</a></p>';
		echo '<p><a href="'.site_url('labs/lang/next').'">'.site_url('labs/lang/next').'</a></p>';
		echo '<p><a href="'.site_url($this->lang->switch_uri('th')).'">Switch to Thai</a></p>';
		echo '<p><a href="'.site_url($this->lang->switch_uri('en')).'">Switch to English</a></p>';
	}
	
	public function next()
	{
		$_POST['name'] = '';

		$this->load->library('form_validation');
		$rules = array(
			array('field' => 'name', 'label' => 'Name', 'rules' => 'required')
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == true)
		{
			// do thing
		}
		else
		{
			$errors = validation_errors();
			alert( $errors );
		}
	}
	
}