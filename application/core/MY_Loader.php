<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

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
		$this->_ci_utils_paths = array(APPPATH, BASEPATH);
		$this->_ci_utils_autoloader();
	}
	
	/**
	 * Override load view 
	 *
	 * add sub view for modules
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function view($view, $vars = array(), $return = FALSE) 
	{	
		$_view_path = "views/";		
		
		// modified sub-view to modules
		$paths = preg_split('|/|', $view);
		if (count($paths) > 1)
		{
			$paths = array_slice($paths, 0, -1); 
			$_view_path .= implode('/', $paths).'/';
		}
		
		// the under is original code from MX
		list($path, $_view) = Modules::find($view, $this->_module, $_view_path);
		if ($path != FALSE) 
		{
			$this->_ci_view_paths = array($path => TRUE) + $this->_ci_view_paths;
			$view = $_view;
		}		
		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}
	
	/**
	 * Load Util
	 *
	 * This function loads the specified util file.
	 *
	 * @param	mixed
	 * @return	void
	 */
	public function util($utils=array())
	{
		if (is_array($utils)) return $this->_utils($utils);
		
		// if util already loaded
		if (isset($this->_ci_utils[$utils])) {
			return;
		}
		
		// find the module util existing
		list($path, $_util) = Modules::find('CI'.ucfirst($utils), $this->_module, 'utils/');
		
		// if the path not found try to normal load
		if ($path === false)
		{		
			return $this->_util($utils);
		}
		
		// if the path found try to load from module
		Modules::load_file($_util, $path);
		$this->_ci_helpers[$_util] = TRUE;
	}
	
	/**
	 * Load Utils
	 *
	 * This is simply an alias to the above function in case the
	 * user has written the plural form of this function.
	 *
	 * @param	array
	 * @return	void
	 */
	public function utils($utils) 
	{
		foreach ($utils as $_util) $this->util($_util);	
	}
	
	/**
	 * Load Util
	 *
	 * This function loads the specified util file.
	 * This is core function to really file.
	 *
	 * @access  protected
	 * @param	mixed
	 * @return	void
	 */
	protected function _util($utils = array())
	{
		foreach ($this->_ci_prep_filename($utils, 'CI', true) as $util)
		{
			if (isset($this->_ci_utils[$util]))
			{
				continue;
			}

			$ext_util = APPPATH.'utils/'.config_item('subclass_prefix').$util.'.php';

			// Is this a util extension request?
			if (file_exists($ext_util))
			{
				$base_util = BASEPATH.'utils/'.$util.'.php';

				if ( ! file_exists($base_util))
				{
					show_error('Unable to load the requested file: utils/'.$util.'.php');
				}

				include_once($ext_util);
				include_once($base_util);

				$this->_ci_utils[$util] = TRUE;
				log_message('debug', 'util loaded: '.$util);
				continue;
			}

			// Try to load the util
			foreach ($this->_ci_utils_paths as $path)
			{
				if (file_exists($path.'utils/'.$util.'.php'))
				{
					include_once($path.'utils/'.$util.'.php');

					$this->_ci_utils[$util] = TRUE;
					log_message('debug', 'Util loaded: '.$util);
					break;
				}
			}

			// unable to load the util
			if ( ! isset($this->_ci_utils[$util]))
			{
				show_error('Unable to load the requested file: utils/'.$util.'.php');
			}
		}
	}
	
	/**
	 * Prep filename
	 * Override from parent
	 *
	 * This function preps the name of various items to make loading them more reliable.
	 *
	 * @param	mixed
	 * @param 	string
	 * @param   bool
	 * @return	array
	 */
	protected function _ci_prep_filename($filename, $extension, $opposite=false)
	{
		if ($opposite == false) {
			return parent::_ci_prep_filename($filename, $extension);
		}
		
		// opposite prep in front
		if ( ! is_array($filename))
		{
			return array($extension.ucfirst(str_replace('.php', '', str_replace($extension, '', $filename))));
		}
		else
		{
			foreach ($filename as $key => $val)
			{
				$filename[$key] = $extension.ucfirst(str_replace('.php', '', str_replace($extension, '', $val)));
			}

			return $filename;
		}
	}
	
	/**
	 * Utils Autoloader
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
	
}