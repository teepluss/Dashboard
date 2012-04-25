<?php

/**
 * Validate sign in form
 */
$config['users/auth/sign_in'] = array(
	array('field'=>'username', 'label'=>'lang:Username', 'rules'=>'required'),
	array('field'=>'password', 'label'=>'lang:Password', 'rules'=>'required'),
);

/**
 * Validate register with Facebook merge account
 */
$config['users/register/merge'] = array(
	array('field'=>'password', 'label'=>'lang:Password', 'rules'=>'required')
);

/**
 * Validate add resource 
 */
$config['roles/admin/resources_add'] = array(
	array('field'=>'controller', 'label'=>'lang:Controller', 'rules'=>'required'),
	array('field'=>'action', 'label'=>'lang:Action', 'rules'=>'required'),
	array('field'=>'group', 'label'=>'lang:Group', 'rules'=>'required'),
	array('field'=>'description', 'label'=>'lang:Description', 'rules'=>'required'),
	array('field'=>'apply', 'label'=>'lang:Apply to Role', 'rules'=>'')
);