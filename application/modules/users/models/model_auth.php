<?php

class model_auth extends MY_Model {

	public static $auth;
	
	public function __construct()
	{
		parent::__construct();
		
		// load Zend_Session and start
		$authOptions = $this->load->config('auth');
		$this->load->loadZend('Zend_Session');
		Zend_Session::setOptions($authOptions);
		Zend_Session::start();
		
		// load Zend_Auth
		$this->load->loadZend('Zend_Auth');
		self::$auth = Zend_Auth::getInstance();
	}
	
	public function identify($username, $password)
	{
		if ($username == '' || $password == '') {
			return false;
		}
		
		// what's field to validate?
		$identityColumn = 'username';
		$pos = strpos($username, '@');
		if ($pos != false) {
			$identityColumn = 'email';
		}
		
		// load zend Zend_Auth_Adapter_DbTable
		$this->load->loadZend('Zend_Auth_Adapter_DbTable');
		
		// get db profile
		$dbAdapter = CIDb::getDbProfile();
		
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		$authAdapter
			->setTableName('users')
			->setIdentityColumn($identityColumn)
			->setCredentialColumn('password')
			->setCredentialTreatment('SHA1(?) AND active=1')
		;	
		$auth = $authAdapter->setIdentity($username)->setCredential($password);
		return $auth;
	}

	public function authenticate(Zend_Auth_Adapter_DbTable $authAdapter)
	{
		return self::$auth->authenticate($authAdapter);
	}
	
	public function storeUserId($user_id, $rememberMe=false)
	{
		$data = array(
			'userId' => $user_id,
		);
		return $this->store($data, $rememberMe);
	}
	
	public function store($data, $rememberMe=false)
	{	
		$data = array_merge(array(
			'loggedIn' => true,
			'userId'   => '',
			'service'  => 'normal',
		), $data);
		self::$auth->getStorage()->write($data);
		if ($rememberMe === true) {
			Zend_Session::rememberMe();
		}
		else {
			Zend_Session::forgetMe();
		}
		return true;
	}
	
	public function clear()
	{
		return self::$auth->getStorage()->clear();
	}
	
	public function read()
	{
		return self::$auth->getStorage()->read();
	}
	
}