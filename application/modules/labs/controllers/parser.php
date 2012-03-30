<?php

class Parser extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function mustache()
	{
		$this->template->set_template('customize');
		
		$view['name'] = "Tee";
		$view['test'] = "<p>sssss<p>";
		$view['rows'] = array(
			array(
				'title' => "Title A"
			),
			array(
				'title' => "Title B"
			)
		);
		
		$this->template->parse_view('content', 'parser_mustache', $view);
		$this->template->render();
	}
	
	public function twig()
	{
		$this->template->set_template('twig');
		
		$view['name'] = "Tee";
		$view['test'] = "<p>sssss<p>";
		$view['rows'] = array(
			array(
				'title' => "Title A"
			),
			array(
				'title' => "Title B"
			)
		);		
		
		$this->template->parse_view('content', 'parser_twig', $view);
		$this->template->render();
	}
	
}