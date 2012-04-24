<?php

require APPPATH.'libraries/REST_Controller.php';

class RESTFUL_Controller extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

}