<?php

namespace phprapidrest;


class Request{

	private $method;
	private $uri;
	private $headers;

	public function __construct(){
		$this->method  = $_SERVER['REQUEST_METHOD'];
		$this->uri     = $this->getURI();
		$this->headers = getallheaders();
 	}

 	public function getHeaders(){
 		return $this->headers;
 	}

	public function getMethod(){
		return $this->method;
	}

	private function getURI(){
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = trim($uri, '/');
		$uri = explode('/', $uri);

		return $uri;
	}

	public function getResourceName(){
		return $this->uri[0];
	}

	public function getPathParameters(){
		$uri = $this->uri;
		array_shift($uri);
		return $uri;
	}

	public function getQueryString(){
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
	}

	public function getInputParameters(){
		$param = file_get_contents("php://input");
		return $param;
	}
}