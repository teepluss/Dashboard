<?php

/**
 * Rewrite apis endpoint
 *
 * Target      : /api/[version]/[controller]/[method]
 * Destination : /api/[controller]/[method]
 * 
 * @var mixed
 * @access public
 */
$route['api/2.0/([a-z]+)/(.*)'] = "$1/$2";