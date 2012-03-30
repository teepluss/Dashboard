<?php

class CITest {

	public function __construct($params=array())
	{
		// initialize
		//alert( $params );
	}
	
	public static function going($who, $where='')
	{
		return $who.' going to the '.$where;
	}
	
}