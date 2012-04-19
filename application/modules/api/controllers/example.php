<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * example call: http://domain.com/api/example/id/1/format/json
 * curl http://dashboard.com/api/2.0/example --request POST -d "key=7c3b42d71283730d56d4483a7c11ba88f4f4e5bf"
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/
class Example extends REST_Controller {

	protected $methods = array(
		'action_get' => array('level' => 1, 'limit' => 100)
	);

	public function feed_get()
    {
    	$users = array(
			1 => array('id' => 1, 'name' => 'One', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array(
				'hobbies' => array('fartings', 'bikes')
			))
		);
		
		if (!$this->get('id'))
        {
        	//$this->response(NULL, 400);
        	$this->response($users, 400);
        }
    	
    	$id = (int)$this->get('id');
        if (array_key_exists($id, $users))
        {
        	$user = $users[$id];
            $this->response($user, 200); // 200 being the HTTP response code
        }
        else
        {
            $this->response('User not found', 404);
        }
    }
    
    public function feed_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array(
        	'id' => $this->post('id'), 
        	'name' => $this->post('name'), 
        	'email' => $this->post('email'), 
        	'message' => 'ADDED!'
        );
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    public function feed_delete()
    {
        $message = array(
        	'id' => $this->delete('id'), 
        	'message' => 'DELETED!'
        );
        
        $this->response($message, 200); // 200 being the HTTP response code
    }

	public function feed_put()
	{
		$message = array(
        	'id' => $this->put('id'), 
        	'message' => 'UPDATED!'
        );        
        $this->response($message, 200);
	}

	public function some_get()
	{
		$message = array(
			'id' => $this->get('id'),
        	'message' => 'SOME GET!'
        );        
        $this->response($message, 200);
	}
	
	public function some_put()
	{
		$message = array(
			'id' => $this->put('id'),
        	'message' => 'SOME POST!'
        );        
        $this->response($message, 200);
	}
	
}