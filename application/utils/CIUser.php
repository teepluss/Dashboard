<?php

class CIUser {

	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
	}
	
	public static function isLoggedIn($returned=false)
	{
		// get id from session
		$CI =& get_instance();
		$CI->load->model('users/model_auth', 'auth');
		$authInfo = $CI->auth->read();
		
		// user is not logged in
		if (!$authInfo) {
			return false;
		}
		
		// user session failed
		if ($authInfo['loggedIn'] == false || !$authInfo['userId']) {
			return false;
		}
		
		// return user_id or not
		if ($returned === true) {
			return $authInfo['userId'];
		}		
		return true;
	}
	
	/**
	 * Get user info specific user ID
	 * Formatting user info
	 * 
	 * @access public
	 * @static
	 * @param  integer
	 * @return array
	 */
	public static function userInfo($id)
	{
		$user_info = array();
		
		// ID not specific
		if (is_numeric($id))
		{		
			// look up from the database
			$CI =& get_instance();
			$CI->load->model('users/model_users', 'users');
			$CI->load->model('users/model_user_profile', 'user_profile');
			
			// get account & profile
			$account = $CI->users->getItem($id);
			$profile = $CI->user_profile->getItem($id);
			
			// formatting user info
			$user_info = array(
				'id'       => $account['id'],
				'role_id'  => $account['role_id'],
				'username' => $account['username'],
				'email'    => $account['email'],
				'info'     => array(
					'first_name' => '',
					'last_name'  => ''
				)
			);
		}
		
		self::$CI->load->loadClass('CustomArrayObject');
		return new CustomArrayObject($user_info);
	}

	/**
	 * Get user info (who logged in)
	 * 
	 * @access public
	 * @static
	 * @return array
	 */
	public static function authInfo()
	{
		$userId = self::isLoggedIn(true);
		return self::userInfo($userId);
	}
	
	/**
	 * Get publisher info 
	 * if publisher ID not specific this function will detect from domain
	 * 
	 * @access public
	 * @static
	 * @param  integer
	 * @return void
	 */
	public static function publisherInfo($publisher_id=null)
	{
		if (is_null($publisher_id)) {
			// using domain to find publisher ID
		}
		// look up from the database using publisher ID
		$suppose = array(
			'user_info' => self::userInfo(1),
			'id'        => 'SHOP_ID',
			'name'      => 'PHP Shop',
			'lang'      => 'thai',
			'url'       => 'http://tee.dashboard.com'
		);
		return $suppose;
	}
	
	/**
	 * Get publisher info 
	 * this function will return data, if user who logged in belong to
	 * if publisher ID not specific this function will detect from domain
	 * 
	 * @access public
	 * @param  integer 
	 * @static
	 * @return array
	 */
	public static function publisherAuthInfo($publisher_id=null)
	{
		$user_info = self::authInfo();
		$publisher_info = self::publisherInfo($domain);
		
		if (strcmp($user_info['id'], $publisher_info['user_id']) == 0) {
			return $site_info;
		}
		
		return false;
	}

}