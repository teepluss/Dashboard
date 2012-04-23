<?php

/**
 * Print word with translate 
 * 
 * @access private
 * @param  string $line
 * @return string
 */
function _e($line)
{
	$CI =& get_instance();
	echo $CI->lang->line($line);
}

/**
 * Buffer word with translate
 * 
 * @access private
 * @param  string $line
 * @return string
 */
function _s($line)
{
	$CI =& get_instance();
	return $CI->lang->line($line);
}