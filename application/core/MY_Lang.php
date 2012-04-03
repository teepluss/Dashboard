<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

require APPPATH."third_party/MX/Lang.php";

class MY_Lang extends MX_Lang {

    // languages
    private $languages = array();
   
    // special URIs (not localized)
    private $special = array();
    
    // default language
    private $default_lang = 'AUTO';
    
    // redirect to accept language
    private $auto_redirect = true;
    
    // where to redirect if no language in URI
    private $uri;
    private $default_uri;
    private $lang_code;
   
    /**************************************************/
    
    
    function __construct()
    {
        parent::__construct();
        
        global $CFG;
        global $URI;
        global $RTR;
        global $LNG; // LNG assign from MY_Rounter.php
		
		// config parameters
		$this->languages = $LNG->lang_availables;
		$this->special   = $LNG->lang_ignore_controllers;
		$this->auto_redirect = $LNG->lang_auto_redirect;
		$default_lang = ($LNG->lang_default) ? $LNG->lang_default : $CFG->config['language'];
		$this->default_lang = substr($default_lang, 0, 2);

        
        $this->uri = $URI->uri_string();
        $this->default_uri = $RTR->default_controller;
        
        $uri_segment = $this->get_uri_lang($this->uri);
        $this->lang_code = $uri_segment['lang'] ;
        
        $url_ok = false;
        if ((!empty($this->lang_code)) && (array_key_exists($this->lang_code, $this->languages)))
        {
            $language = $this->languages[$this->lang_code];
            $CFG->set_item('language', $language);
            $url_ok = true;
        }

		if (($this->auto_redirect && !$url_ok) && (!$this->is_special($uri_segment['parts']))) // special URI -> no redirect
		{
			// set default language
			$CFG->set_item('language', $this->languages[$this->default_lang()]);
			
			$uri = (!empty($this->uri)) ? $this->uri: $this->default_uri;
			$uri = ($uri[0] != '/') ? '/'.$uri : $uri;
			$new_url = $CFG->config['base_url'].$this->default_lang().$uri;
			
			header("Location: " . $new_url, TRUE, 302);
			exit;
		}
    }

    
    
    // get current language
    // ex: return 'en' if language in CI config is 'english' 
    function lang()
    {
        global $CFG;        
        $language = $CFG->item('language');
        
        $lang = array_search($language, $this->languages);
        if ($lang)
        {
            return $lang;
        }
        
        return NULL;    // this should not happen
    }
    
    
    function is_special($lang_code)
    {
        $uri = @implode('/', $lang_code);
        if (!empty($uri))
        {
        	if (count($this->special) > 0) foreach ($this->special as $v)
        	{
        		if (preg_match('|'.$v.'|', $uri)) {
        			return TRUE;
        		}
        	}
        }
        return FALSE;
    }   
   
    function switch_uri($lang)
     {
         if ((!empty($this->uri)) && (array_key_exists($lang, $this->languages)))
         {
			if ($uri_segment = $this->get_uri_lang($this->uri))
			{
				$uri_segment['parts'][0] = $lang;
				$uri = implode('/',$uri_segment['parts']);
			}
			else
			{
				$uri = $lang.'/'.$this->uri;
			}
		}
		return $uri;
	}

    function get_uri_lang($uri = '')
    {
		if (!empty($uri))
		{
			$uri = ($uri[0] == '/') ? substr($uri, 1): $uri;
			
			$uri_expl = explode('/', $uri, 2);
			$uri_segment['lang'] = NULL;
			$uri_segment['parts'] = $uri_expl;  
		
			if (array_key_exists($uri_expl[0], $this->languages))
			{
				$uri_segment['lang'] = $uri_expl[0];
			}
			return $uri_segment;
		}
		return FALSE;
    }

    
    // default language: first element of $this->languages
	function default_lang()
	{
		if (strcasecmp($this->default_lang, 'AUTO') == 0)
		{
			// do the logic to find localize
			$lang = 'en';
		}
		else
		{
			$lang = $this->default_lang;
		}
		return (array_key_exists($lang, $this->languages)) ? $lang: 'en';
	}
    
    
    // add language segment to $uri (if appropriate)
	function localized($uri)
    {
		if (!empty($uri))
		{
			$uri_segment = $this->get_uri_lang($uri);
			if (!$uri_segment['lang'])
			{
		
				if ((!$this->is_special($uri_segment['parts'][0])) && (!preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri)))
				{
					$uri = $this->lang() . '/' . $uri;
				}
			}
		}
		return $uri;
    }
} 

// END MY_Lang Class

/* End of file MY_Lang.php */
/* Location: ./application/core/MY_Lang.php */  