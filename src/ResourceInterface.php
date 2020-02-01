<?php

namespace phprapidrest;

interface ResourceInterface{

	function processGetRequest();
	function processPostRequest();
	function processPutRequest();
	function processPatchRequest();
	function processDeleteRequest();
}