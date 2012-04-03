<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Enable redirect to assign language, if don't have language segment
|--------------------------------------------------------------------------
|
| default 'false'
|
*/
$config['lang_auto_redirect'] = true;

/*
|--------------------------------------------------------------------------
| Language available on your site
|--------------------------------------------------------------------------
|
| What language you accept on this site?
|
*/
$config['lang_availables'] = array(
	'en' => 'english',
    'th' => 'thai'
);

/*
|--------------------------------------------------------------------------
| Controller that not ignore to redirect
|--------------------------------------------------------------------------
|
| First segment of you uri
|
*/
$config['lang_ignore_controllers'] = array('api/2.0', 'admin');

/*
|--------------------------------------------------------------------------
| What language is your default?
|--------------------------------------------------------------------------
|
| This is inherit from $config['language'] in primary config file
| eg. english, thai OR you can use 'AUTO' to automatically detect localize
|
*/
$config['lang_default'] = 'english';