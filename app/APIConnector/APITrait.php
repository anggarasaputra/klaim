<?php namespace App\APIConnector;

trait APITrait {

	static protected $basic_url = 'http://localhost/GantiRugi.com/public/api/';

	protected static function run($url, $method = 'GET', $data = [])
	{
		// create a new cURL resource
		$ch = curl_init();

		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		if ($data)
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}

		// grab URL and pass it to the browser
		$results = curl_exec($ch);

		// close cURL resource, and free up system resources
		curl_close($ch);

		return json_decode($results);
	}

}