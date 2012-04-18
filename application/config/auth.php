<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
| 'zend_sess_save_handler' = Session handler (files or memcache)
| memcache example: tcp://127.0.0.1:11211?persistent=1&weight=1&timeout=1&retry_interval=15
|
*/
$config['auth'] = array(
	'name'                => 'authentication',
	'save_handler'        => 'files',
	'save_path'           => str_replace('\\', '/', FCPATH) . 'data/auth',
	//'save_path'         => 'tcp://127.0.0.1:11211?persistent=1&weight=1&timeout=1&retry_interval=15',
	'cookie_domain'       => '.dashboard.com',
	'cookie_path'         => '/',
	'gc_maxlifetime'      => 864000,
	'remember_me_seconds' => 864000,
);