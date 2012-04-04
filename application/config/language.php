<?php

/*
|--------------------------------------------------------------------------
| Enable/Disable Auto Redirect to Accept language segment
|--------------------------------------------------------------------------
|
| If you would like to use the auto redirect feature you must enable it by
| setting this variable to TRUE (boolean).
|
*/
$config['auto_accept'] = FALSE;

/*
|--------------------------------------------------------------------------
| Available Languages on Your Site
|--------------------------------------------------------------------------
|
| Define the language available on your site
| if you have more than the default you have to set routes
| see on '/application/config/routes.php'
|
*/
$config['languages'] = array(
	'en' => 'english',
	'th' => 'thai'
);

/*
|--------------------------------------------------------------------------
| Ignore Some Paths to Exclude Redirection
|--------------------------------------------------------------------------
|
| When $config['auto_accept'] set to TRUE
| but some urls you don't need to redirect, you can add the path to except 
| this setting can use regular expression  
|
*/
$config['ignore_urls'] = array(
	'^api/2.0'	
);

/*
|--------------------------------------------------------------------------
| Language Default
|--------------------------------------------------------------------------
|
| Normally you can set this on CI primary config 
| but this allow you to override by remove the comment
|
*/ 
//$config['language'] = 'english';