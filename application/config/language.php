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
| Disallow some path to add language segment
|--------------------------------------------------------------------------
|
| You can ignore some urls to auto add language segment
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