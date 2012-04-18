<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'third_party/MX/Loader.php';

/**
 * Zend_Loader
 */
require 'Zend/Loader.php';

/**
 * MY_Loader Class
 *
 * Append method to parent
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @author		Tee++;
 * @category	Loader
 * @link		http://www.jquerytips.com
 */
class MY_Loader extends MX_Loader {
	
	/**
	 * List of paths to load utils from
	 *
	 * @var array
	 * @access protected
	 */
	protected $_ci_utils_paths = array();
	/**
	 * List of loaded utils
	 *
	 * @var array
	 * @access protected
	 */
	protected $_ci_utils = array();
	
	/**
	 * Override Initialize 
	 *
	 * This method is add utlis config
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function initialize($controller=null)
	{
		parent::initialize($controller);
		
		// config utils path and check autoloading
		$this->_ci_utils_paths = array(APPPATH);
		$this->_ci_utils_autoloader();
	}
	
	/**
	 * Load Utility
	 *
	 * @param	mixed
	 * @return	void
	 */
	public function util($utils, $params=array())
	{
		if (is_array($utils)) return $this->utils($utils);
		
		$util = $utils;
		
		// if util already loaded
		if (isset($this->_ci_utils[$util]) and $_alias = $this->_ci_utils[$util]) {
			return CI::$APP->$_alias;
		}
		
		$_alias = $util;
		
		// find the module util existing
		list($path, $_util) = Modules::find($util, $this->_module, 'utils/');
		
		// if the path not found try to normal load
		if ($path === false)
		{		
			foreach ($this->_ci_utils_paths as $path)
			{
				if (file_exists($path.'utils/'.$util.'.php'))
				{
					include_once($path.'utils/'.$util.'.php');
					
					CI::$APP->$_alias = new $util($params);

					$this->_ci_utils[$util] = $_alias;
					log_message('debug', 'Util loaded: '.$util);
					break;
				}
			}
		}
		else
		{
			// if the path found try to load from module
			Modules::load_file($_util, $path);
			CI::$APP->$_alias = new $util($params);
			$this->_ci_utils[$_util] = $_alias;
		}		
		
		// unable to load the util
		if ( ! isset($this->_ci_utils[$util]))
		{
			show_error('Unable to load the requested file: utils/'.$util.'.php');
		}		
		return CI::$APP->$_alias;
	}
	
	/**
	 * Load Utilities
	 *
	 * @param	array
	 * @return	void
	 */
	public function utils($utils) 
	{
		foreach ($utils as $_util) $this->util($_util);	
	}

	/**
	 * Utilities Autoloader
	 *
	 * The config/autoload.php file contains an array that permits sub-systems,
	 * utils to be loaded automatically.
	 *
	 * @param	array
	 * @return	void
	 */
	private function _ci_utils_autoloader()
	{
		if (defined('ENVIRONMENT') AND file_exists(APPPATH.'config/'.ENVIRONMENT.'/autoload.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/autoload.php');
		}
		else
		{
			include(APPPATH.'config/autoload.php');
		}

		if ( ! isset($autoload))
		{
			return FALSE;
		}
		
		// try to load from module and merge into
		$path = FALSE;
		if ($this->_module) 
		{		
			list($path, $file) = Modules::find('autoload', $this->_module, 'config/');
			
			/* module constants file */
			if ($path != FALSE) {
				include_once $path.$file.EXT;
			}
		
			/* module autoload file */
			if ($path != FALSE) {
				$autoload = array_merge(Modules::load_file($file, $path, 'autoload'), $autoload);
			}
		}
		
		// auto load utils 
		if (isset($autoload['utils']) AND count($autoload['utils']) > 0)
		{
			$this->utils($autoload['utils']);
		}
	}	
	
	/**
	 * Load another class
	 * 
	 * @access public
	 * @param  string
	 * @return void
	 */
	public function loadClass($class)
	{
		$class = rtrim($class, '.php').'.php';
		require_once($class);
	}
	
	/**
	 * Zend Loader 
	 * 
	 * @access public
	 * @param  string
	 * @param  string (default: null)
	 * @return void
	 */
	public function loadZend($class, $dirs='')
	{
		Zend_Loader::loadClass($class, $dirs);
	}
	
}