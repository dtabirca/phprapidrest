<?php

namespace phprapidrest;


class Response{

	private $status_code;
	private $data;
	private $data_format;
	private $headers;

	function __construct($status_code = '200', $data = array(), $data_format = 'json'){
		
		$this->status_code  = $status_code;
		$this->data 		= $data;
		$this->data_format 	= $data_format;
		$this->headers      = [];
		$this->createResponse();
	}

	private function createResponse(){

		$this->headers[] = "Access-Control-Allow-Origin: *";
		switch ($this->status_code) {
			case '500':
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 500 Internal Server Error";
				break;
			case '400':
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 400 Bad Request";
				break;
			case '401':
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 401 Unauthorized";
				break;
			case '404':
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 404 Not Found";
				break;
			case '405':
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 405 Method Not Allowed";
				break;
			case '201':
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 201 Created";
				break;	
			case '204':
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 204 No Content";
				break;				
			default:
				$this->headers[] = $_SERVER["SERVER_PROTOCOL"]." 200 OK";
				break;
		}

		switch($this->data_format){
			case 'json':
			default:
				$this->headers[] = "Content-Type: application/json; charset=UTF-8";
				$this->data      = json_encode($this->data);
			break;
		}	

		foreach ($this->headers as $header) {
			header($header);
		}
		echo $this->data;
		exit;
	}

}