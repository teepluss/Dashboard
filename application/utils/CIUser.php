<?php

class CIUser {

	public static function getInfo($id)
	{
		$data = array(
			'id'       => 1,
			'name'     => "Pattanai",
			'nickname' => "Tee++;",
			'website'  => "http://www.jquerytips.com"			
		);
		return new CIUserAttibutes($data);
	}
	
	public static function getAuthInfo()
	{
		return "Get User Who Logged In Info.";
	}
	
}

class CIUserAttibutes {

	private $_user_info;
	
	public function __construct($user_info)
	{
		$this->_user_info = $user_info;
	}
	
	public function getAttrs()
	{
		if (is_array($this->_user_info)) {
			return $this->_user_info;
		}
		return;
	}
	
	public function getAttr($attr)
	{
		if (array_key_exists($attr, $this->_user_info)) {
			return $this->_user_info[$attr];
		}
		return;
	}
	
}