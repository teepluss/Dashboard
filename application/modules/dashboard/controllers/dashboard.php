<?php

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		redirect('dashboard/user');
	}
	
	public function user()
	{
		$this->template->set_template('fluid');
		$this->template->write_view('content', 'dashboard-user');
		$this->template->render();
	}
	
	public function publisher()
	{
		$this->template->set_template('fluid');
		$this->template->write_view('content', 'dashboard-publisher');
		$this->template->render();
	}
	
}