<?php

namespace phprapidrest\example;

class Util{
	
	function isValidNumber($n){
		if (is_numeric($n)){
			return TRUE;
		}
		return FALSE;
	}
	function isValidJSON($str){
		$data = json_decode($str);
     	return (json_last_error() == JSON_ERROR_NONE) ? TRUE : FALSE;
	}	

}