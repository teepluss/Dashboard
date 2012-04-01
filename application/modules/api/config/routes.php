<?php

/**
 * Rewrite apis endpoint
 * Target      : /api/[controller]/[parameter]
 * Destination : /api/[controller]_rest/[controller]/[parameter]
 * 
 * @var mixed
 * @access public
 */
$route['api/2.0/([a-z]+)(.*)?'] = "$1_rest/action$2";