<?php

require_once('Zend/Registry.php');
require_once('Zend/Db/Expr.php');
require_once('Zend/Db.php');

class CIDb {
	
	/**
	 * Connect to the DB.
	 * 
	 * @access public
	 * @static
	 * @param  string 
	 * @return object
	 */
	public static function conn($profile='slave')
	{
		if (!Zend_Registry::isRegistered('dbProfile_'.$profile)) {
			self::setDbProfile($profile);
		}
		return Zend_Registry::get('dbProfile_'.$profile);
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
		return self::conn('master')->query($sql, $attrs);
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
		if (self::conn('master')->insert($table, $data)) {
			return self::conn('master')->lastInsertId();
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
		return self::conn('master')->update($table, $data, $where);
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
		return self::conn('master')->delete($table, $where);
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
		return self::conn('slave')->select();
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
		return self::conn('slave')->quote($value, $type);
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
		return self::conn('slave')->quoteInto($text, $value, $type, $count);
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
		return self::conn('slave')->quoteIdentifier($text);
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
		return self::conn('slave')->fetchAll($sql, $attrs);
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
		return self::conn('slave')->fetchRow($sql, $attrs);
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
		return self::conn('slave')->fetchOne($sql, $attrs);
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
		return self::conn('slave')->fetchCol($sql, $attrs);
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
		return self::conn('slave')->fetchPairs($sql, $attrs);
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