<?php

namespace phprapidrest\example;

use phprapidrest\Response;
use phprapidrest\Resource;
use phprapidrest\ResourceInterface;
use phprapidrest\example\Util; 
use phprapidrest\example\ExampleController;

class ExampleResource extends Resource implements ResourceInterface{

	protected $allowed_methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];
	protected $data_format     = 'json';
	protected $expected_input  = ['username', 'email'];

	public function processGetRequest(){
		// parsing the rest of the uri
		$query  = $this->request->getQueryString();
		$params = $this->request->getPathParameters();
		if (!empty($params)){
			
			$uid    	= $this->extractUserId();
			$controller = new ExampleController();
			$result     = $controller->getUserById($uid);
			if ($result){	
				new Response('200', $result);
			}
			else{
				new Response('404');
			} 
		}
		else{
			// get all
			$controller = new ExampleController();
			$results    = $controller->getAllUsers($query);
			new Response('200', $results);
		}
	}

	private function extractUserId(){
		$params = $this->request->getPathParameters();
		if (empty($params) || !Util::isValidNumber($params[0])){// not a valid ID
			new Response('400'); 
		}
		$uid = $params[0];

		return $uid;
	}

	private function validateInputParameters(){
		$params = $this->request->getInputParameters();
		switch($this->data_format){
			case 'json':
			default:

				if (Util::isValidJSON($params)){
					$params = (array) json_decode($params, TRUE);
				}
				else{
					new Response('400'); 
				}
				break;
		}

		foreach ($this->expected_input as $v){
			if (!isset($params[$v])){
				new Response('400'); 
			}
		}

		return $params;
	}

	public function processPostRequest(){
		if ($params = $this->validateInputParameters()){
			$controller = new ExampleController();
			if ($uid = $controller->createUser($params)){
				new Response('201', $uid);
			}
			else{
				new Response('500');
			}
		}
	}

	public function processPutRequest(){
		$uid = $this->extractUserId();
		if ($params = $this->validateInputParameters()){
			$controller = new ExampleController();
			if ($controller->updateUserById($uid, $params)){
				new Response('200');
			}
			else{
				new Response('500');
			}
		}
	}

	public function processPatchRequest(){
		$uid = $this->extractUserId();
		if ($params = $this->validateInputParameters()){
			$controller = new ExampleController();
			if ($controller->updateUserById($uid, $params)){
				new Response('200');
			}
			else{
				new Response('500');
			}
		}		
	}


	public function processDeleteRequest(){
		$uid = $this->extractUserId();
		$controller = new ExampleController();
		if ($controller->deleteUserById($uid)){
			new Response('200');
		}
		else{
			new Response('404');
		}		
	}

}