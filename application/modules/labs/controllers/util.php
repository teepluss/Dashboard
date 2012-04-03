<?php

class Util extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
	}
	
	public function url()
	{
		$this->load->util(array('CIUri'));
		echo CIUri::base('name');
	}
	
	public function test()
	{
		/*$this->load->util('CITest', array(
			'place' => 'Party'
		));*/
		echo CITest::going('Tee', 'Pub');
	}
	
}