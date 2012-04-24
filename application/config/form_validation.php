<?php

$config['users/auth/sign_in'] = array(
	array('field'=>'username', 'label'=>'lang:Username', 'rules'=>'required'),
	array('field'=>'password', 'label'=>'lang:Password', 'rules'=>'required'),
);

$config['users/register/merge'] = array(
	array('field'=>'password', 'label'=>'lang:Password', 'rules'=>'required')
);