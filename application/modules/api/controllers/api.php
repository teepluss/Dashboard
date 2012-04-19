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
	
	public function test($request='GET')
	{
		$request = strtoupper($request);
		$func = 'setParameter'.(($request == 'GET') ? 'Get' : 'Post');
		
		$uri = 'http://dashboard.com/api/2.0/example/feed/format/json';
		
		$this->load->loadZend('Zend_Http_Client');
		$client = new Zend_Http_Client($uri);
		$client->$func(array(
			'X-API-KEY' => '7b7ecd6b708340da94fa08134c46f34c2fce159b',
			'id'        => 3,
			'name'      => 'Tee',
			'email'     => 'teepluss@gmail.com'
		));
		
		$rs = $client->request($request);
		
		$response = $rs->getBody();
		
		echo $response;
		echo '<hr />';		
		echo '<pre>'.print_r(json_decode($response, true), true).'<pre>';	
	}
	
}