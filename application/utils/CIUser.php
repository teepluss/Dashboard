<?php

class CIUser {

	public static $CI;

	public function __construct()
	{
		self::$CI =& get_instance();
	}
	
	/**
	 * Get user info specific user ID
	 * 
	 * @access public
	 * @static
	 * @param  integer
	 * @return array
	 */
	public static function userInfo($id)
	{
		// look up from the database
		$suppose = array(
			'id'        => 1,
			'name'      => 'Pattanai',
			'last_name' => 'Kawinvasin'
		);
		return $suppose;
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
		// get id from session
		$id = 1;
		return self::userInfo($id);
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