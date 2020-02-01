<?php

require __DIR__ . '/vendor/autoload.php';


$request        	= new phprapidrest\Request();
$resource_name      = $request->getResourceName();
$class_name 		= 'phprapidrest\example\\' . $resource_name;

if (!class_exists($class_name)){
	new phprapidrest\Response(404);
}

$resource = new $class_name($request);