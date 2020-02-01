<?php

namespace phprapidrest;
use phprapidrest\Response;


class Resource{

	protected $allowed_methods;
	protected $request;
	protected $data_format;
	
	function __construct(\phprapidrest\Request $request){
		$this->request     = $request;	
		$this->method      = $this->request->getMethod();
		if ($this->validateRequest()){
			$this->processRequest();
		}
	}

	protected function validateRequest(){

		// method is allowed?
		if (!in_array($this->method, $this->allowed_methods)){
			new Response('405');
		}

		// matching headers
		if (!isset($this->request->getHeaders()['Accept']) || !isset($this->request->getHeaders()['Content-Type'])){ 
			new Response(400);
		}
		if ($this->request->getHeaders()['Accept'] != 'application/' . $this->data_format || $this->request->getHeaders()['Content-Type'] != 'application/' . $this->data_format){
			new Response(400);	
		}

		return true;
	}

	protected function processRequest(){

		switch ($this->method){

			case 'POST':
				$this->processPostRequest();
				break;
			case 'PUT':
				$this->processPutRequest();
				break;
			case 'PATCH':
				$this->processPatchRequest();
				break;
			case 'DELETE':
				$this->processDeleteRequest();
				break;
			case 'GET':
			default:
				$this->processGetRequest();
				break;
		}

	}	
}
