<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/
class Example_rest extends REST_Controller
{
	public function example_get()
    {
        if(!$this->get('id'))
        {
        	//$this->response(NULL, 400);
        	$this->response(array('error' => 'Missing ID parameter'), 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
    	$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array(
				'hobbies' => array('fartings', 'bikes')
			))
		);
		
    	$user = @$users[$this->get('id')];
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    public function example_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array(
        	'id' => $this->get('id'), 
        	'name' => $this->post('name'), 
        	'email' => $this->post('email'), 
        	'message' => 'ADDED!'
        );
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    public function example_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array(
        	'id' => $this->get('id'), 
        	'message' => 'DELETED!'
        );
        
        $this->response($message, 200); // 200 being the HTTP response code
    }


	public function example_put()
	{
		var_dump($this->put('foo'));
	}
}