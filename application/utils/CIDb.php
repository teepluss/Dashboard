<?php

require_once('Zend/Registry.php');
require_once('Zend/Db/Expr.php');
require_once('Zend/Db.php');

class CIDb {

	public static $conn;
	
	public static $dbProfiles = array(
		'master' => 'master',
		'slave'  => 'slave'
	);
	
	/**
	 * Connect to the DB.
	 * 
	 * @access public
	 * @static
	 * @param  string 
	 * @return void
	 */
	public static function connect($profile)
	{
		if (!Zend_Registry::isRegistered('dbProfile_'.$profile)) {
			self::setDbProfile($profile);
		}
		self::$conn = Zend_Registry::get('dbProfile_'.$profile);
		return true;
	}
	
	/**
	 * Connect to specific DB profile.
	 * 
	 * @access public
	 * @static
	 * @param  string 
	 * @return object
	 */
	public static function setDbProfile($group=null)
	{
		require(APPPATH.'config/database.php');
		if (is_null($group) || !array_key_exists($group, $db)) {
			throw new Exception('DB Profile not found!');
		}
		
		$group = self::$dbProfiles[$group];
		
		$dbConf = $db[$group];
		$dbDriver = $dbConf['dbdriver'];
		
		$params = array(
			'host'       => $dbConf['hostname'],
			'username'   => $dbConf['username'],
			'password'   => $dbConf['password'],
			'dbname'     => $dbConf['database'],
			'charset'    => $dbConf['char_set'],
			'collation'  => $dbConf['dbcollat'],
			'persistent' => $dbConf['pconnect']
		);
		
		$dbProfile = Zend_Db::factory($dbDriver, $params);
		Zend_Registry::set('dbProfile_'.$group, $dbProfile);		
		return $dbProfile;
	}
	
	/**
	 * Get the database profile connected
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @return object
	 */
	public static function getDbProfile($group=null)
	{
		if (is_null($group)) {
			$group = 'slave';
		}
		self::connect($group);
		return self::$conn;
	}
	
	/**
	 * Expr String
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @return string
	 */
	public static function expr($string)
	{
		return new Zend_Db_Expr($string);
	}
	
	/**
	 * Query 
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return object
	 */
	public static function query($sql, $attrs=array())
	{
		self::connect('master');
		return self::$conn->query($sql, $attrs);
	}
	
	/**
	 * Insert 
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return integer
	 */
	public static function insert($table, $data)
	{
		self::connect('master');
		if (self::$conn->insert($table, $data)) {
			return self::$conn->lastInsertId();
		}
		return false;
	}
	
	/**
	 * Update 
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return bool
	 */
	public static function update($table, $data, $where)
	{
		self::connect('master');
		return self::$conn->update($table, $data, $where);
	}
	
	/**
	 * Delete 
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return bool
	 */
	public static function delete($table, $where)
	{
		self::connect('master');
		return self::$conn->delete($table, $where);
	}
	
	/**
	 * Select  
	 * 
	 * @access public
	 * @static
	 * @return string
	 */
	public static function select()
	{
		self::connect('slave');
		return self::$conn->select();
	}

	/**
	 * Quote 
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  string
	 * @return string
	 */
	public static function quote($value, $type=null)
	{
		self::connect('slave');
		return self::$conn->quote($value, $type);
	}
	
	/**
	 * Quote Into 
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  mixed
	 * @param  string
	 * @param  integer
	 * @return string
	 */
	public static function quoteInto($text, $value, $type= null, $count=null)
	{
		self::connect('slave');
		return self::$conn->quoteInto($text, $value, $type, $count);
	}
	
	/**
	 * Quote Identifier
	 * 
	 * @access public
	 * @static
	 * @param  string 
	 * @return string
	 */
	public static function quoteIdentifier($text)
	{
		self::connect('slave');
		return self::$conn->quoteIdentifier($text);
	}

	/**
	 * Fetch All.
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return array
	 */
	public static function fetchAll($sql, $attrs=array())
	{
		self::connect('slave');
		return self::$conn->fetchAll($sql, $attrs);
	}

	/**
	 * Fetch Row.
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return array
	 */
	public static function fetchRow($sql, $attrs=array())
	{
		self::connect('slave');
		return self::$conn->fetchRow($sql, $attrs);
	}

	/**
	 * Fetch One.
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return array
	 */
	public static function fetchOne($sql, $attrs=array())
	{
		self::connect('slave');
		return self::$conn->fetchOne($sql, $attrs);
	}

	/**
	 * Fetch Col.
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return array
	 */
	public static function fetchCol($sql, $attrs=array())
	{
		self::connect('slave');
		return self::$conn->fetchCol($sql, $attrs);
	}

	/**
	 * Fetch Pairs.
	 * 
	 * @access public
	 * @static
	 * @param  string
	 * @param  array
	 * @return array
	 */
	public static function fetchPairs($sql, $attrs=array())
	{
		self::connect('slave');
		return self::$conn->fetchPairs($sql, $attrs);
	}

	/**
	 * fetchIndex
	 * This function only work with Zend_db_Select statement
	 *
	 *
	 * @access	 public
	 * @param object (Zend_Db_Select)
	 * @param array
	 * @param string
	 * @return	array
	 */
	public static function fetchIndex($sql, $attrs=array(), $index='id', $multi=false)
	{
		$rows = self::fetchAll($sql, $attrs);

		$data = array();
		foreach ($rows as $val)
		{
			$id = $val[$index];
			if ($multi === true) {
				$data[$id][] = $val;
			}
			else {
				$data[$id] = $val;
			}
		}
		return $data;
	}

	/**
	 * fetchGroup
	 * This function only work with Zend_db_Select statement
	 * The result are the same as fetchIndex, but return in multi array
	 *
	 *
	 * @access	 public
	 * @param object (Zend_Db_Select)
	 * @param array
	 * @param string
	 * @return	array
	 */
	public static function fetchGroup($sql, $attrs=array(), $index='id')
	{
		return self::fetchIndex($sql, $attrs, $index, true);
	}

	/**
	 * fetchPage
	 * This function only work with Zend_db_Select statement
	 *
	 *
	 * @access	 public
	 * @param object (Zend_Db_Select)
	 * @param array
	 * @param integer
	 * @param integer
	 * @return	array
	 */
	public static function fetchPage($sql, $attrs=array(), $page=1, $limit_per_page=20)
	{
		$page = ((int) $page < 1) ? 1 : $page;

		$sql->limitPage($page, $limit_per_page);
		$rows = self::fetchAll($sql, $attrs);

		$sql->reset(Zend_Db_Select::COLUMNS);
		$sql->reset(Zend_Db_Select::ORDER);
		$sql->reset(Zend_Db_Select::LIMIT_COUNT);
		$sql->reset(Zend_Db_Select::LIMIT_OFFSET);

		$sql->columns('COUNT(*)');

		if ($sql->getPart(Zend_Db_Select::GROUP))
		{
			$records = self::fetchAll($sql, $attrs);
			$row_count = count($records);
		}
		else
		{
			$row_count = self::fetchOne($sql, $attrs);
		}

		$total_page = ((int) $row_count > 0 && (int) $limit_per_page > 0) ? ceil((int) $row_count / (int) $limit_per_page) : 0;
		$data = array(
			'rows' => $rows,
			'row_count' => $row_count,
			'limit_per_page' => $limit_per_page,
			'current_page' => $page,
			'total_page' => $total_page
		);
		return $data;
	}
	
}