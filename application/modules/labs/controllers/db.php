<?php

class Db extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$sql = CIDb::select();
		$sql->from('sample');
		$data = CIDb::fetchAll($sql);
		alert( $data );
	}
	
}