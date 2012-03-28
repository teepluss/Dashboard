<?php

/**
 * Print object to nice view 
 * 
 * @access public
 * @param  mixed 
 * @param  bool 
 * @return string
 */
function alert($object=array(), $exit=false)
{
	echo '<pre>';
	print_r($object);
	echo '</pre>';
	if ($exit) exit(0);
}

/**
 * Dump object to nice view 
 * 
 * @access public
 * @param  mixed 
 * @param  bool 
 * @return string
 */
function dump($object, $exit=false)
{
	echo '<pre>';
	var_dump($object);
	echo '</pre>';
	if ($exit) exit(0);
}