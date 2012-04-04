<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'third_party/MX/Lang.php';

class MY_Lang extends MX_Lang {

	/**
	 * Language availables
	 */
	private $_languages = array(	
				'en' => 'english',
				'th' => 'thai'
			);
	
	/**
	 * Auto redirect to add language segment
	 */	
	private $_auto_accept = true;
	
	/**
	 * Exception redirect path
	 */	
	private $_ignore_urls = array(
		'^admin'
	);
	
	/**
	 * Default language
	 */
	private $_language = 'english';

	public function __construct()
	{
		parent::__construct();
		
		global $CFG;
		global $URI;
		global $RTR;
		
		// assign default language using main config
		$this->_language = $CFG->config['language'];
		
		// get language config 
		require(APPPATH.'config/language.php');
		if (isset($config) && is_array($config)) {
			$this->initialize($config);
		}
		
		// rewrite the language config
		$CFG->set_item('language', $this->_language);
		
		$segment = $URI->segment(1);
		if (isset($this->_languages[$segment])) 
		{
			$language = $this->_languages[$segment];
			$CFG->set_item('language', $language);
		}
		else
		{
			// redirect to add language segment if allowed
			if ($this->_auto_accept == true) 
			{		
				$current_uri = $URI->uri_string();
				if (!$this->is_ignores($current_uri) && trim($current_uri, '/') != '') {
					$local = $this->localized($current_uri);
					
					$direct = $CFG->config['base_url'].$local;
					// do the redirect
					header("Location: ".$direct, true, 302);
					exit(0);
				}			
			} // end if auto accept
		}
	}
	
	/**
	 * Initialize
	 * 
	 * @access public
	 * @param  mixed $config
	 * @return void
	 */
	public function initialize($config)
	{
		foreach ($config as $key => $val)
		{
			$private_key = '_'.$key;
			if (isset($this->$private_key)) {
				$this->$private_key = $val;
			}
		}
	}
	
	/**
	 * Get current language
	 * 
	 * @access public
	 * @return string
	 */
	public function lang() 
	{
		global $CFG;	
			
		$language = $CFG->item('language');
		$lang = array_search($language, $this->_languages);
		if ($lang) {
			return $lang;
		}
		return null;
	}
	
	
	/**
	 * Check ignoring path do not redirect
	 * 
	 * @access public
	 * @param  string 
	 * @return bool
	 */
	public function is_ignores($path)
	{
		if (count($this->_ignore_urls) > 0) foreach ($this->_ignore_urls as $regexp) 
		{
			if (preg_match('|'.$regexp.'|i', $path)) {
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Check the path already has language segment?
	 * 
	 * @access public
	 * @param  string 
	 * @return bool
	 */
	public function has_language($uri)
	{
		$first_segment = null;
		
		$exploded = explode('/', $uri);
		if (isset($exploded[0]))
		{
			if ($exploded[0] != '') {
				$first_segment = $exploded[0];
			}
			elseif (isset($exploded[1]) && $exploded[1] != '') {
				$first_segment = $exploded[1];
			}
		}
		
		if ($first_segment != null) {
			return isset($this->_languages[$first_segment]);
		}		
		return false;
	}
	
	/**
	 * Add the language segment to uri
	 * - EXCEPT:
	 * - already has language segment
	 * - the path set to ignore
	 * - the path has extension file (.jpg, ...)
	 * 
	 * @access public
	 * @param  string
	 * @return string
	 */
	public function localized($uri)
	{
		if ($this->has_language($uri) || $this->is_ignores($uri) || preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri)) {
			return $uri;
		}		
		return $this->lang().'/'.trim($uri, '/');		
	}
	
	/**
	 * Switch to another language
	 * 
	 * @access public
	 * @param  string 
	 * @return string
	 */
	public function switch_uri($lang)
	{
		global $URI;
		
		$uri  = $URI->uri_string();		
		if ($uri != '')
		{
			$exploded = explode('/', $uri);
			if ($exploded[0] == $this->lang()) {
				$exploded[0] = $lang;
			}				
			if (!isset($this->_languages[$exploded[0]])) {
				array_splice($exploded, 0, 0, $lang);
			}			
			$uri = implode('/', $exploded);
		}
		return $uri;
	}
	
	/**
	 * Override CI 
	 * If the key doesn't exists the returning is key
	 * 
	 * @access public
	 * @param  string
	 * @return string
	 */
	public function line($line='')
	{
		$value = ($line == '' || !isset($this->language[$line])) ? false : $this->language[$line];

		// Because killer robots like unicorns!
		if ($value === FALSE)
		{
			//log_message('error', 'Could not find the language line "'.$line.'"');
			return $line;
		}
		return $value;
	}
	
}