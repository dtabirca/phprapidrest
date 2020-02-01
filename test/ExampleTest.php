<?php
require __DIR__ . '/../vendor/autoload.php';

class TestExample extends \PHPUnit\Framework\TestCase
{

	public function testGET()
	{
	    // create our http client (Guzzle)
	    $client = new \GuzzleHttp\Client(['base_uri' => 'https://rest.api/']);
	    $response = $client->request('GET', 'ExampleResource', ['headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json'], 'verify' => false]);

	    echo $response->getBody()->getContents();
	}

	public function testPOST()
	{
	    // create our http client (Guzzle)
	    $client = new \GuzzleHttp\Client(['base_uri' => 'https://rest.api/']);
	    $data = array(
	        'username' => 'test',
	        'email' => 'test'
	    );
	    $response = $client->request('POST', 'ExampleResource', ['headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/json'], 'verify' => false, 'body' => json_encode($data)]);
	}
}