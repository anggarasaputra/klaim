<?php namespace App\APIConnector;

use Session;

class API {

	use APITrait;

	static function user()
	{
		return new APIUSer();
	}

	static function vendor()
	{
		return new APIVendor();
	}
}