<?php namespace App\APIConnector;

use Session;

class APIVendor {

	use APITrait;

	function search($q = null, $skip = 0, $take = 25)
	{
		return self::run(self::$basic_url . 'vendors/search', 'GET', ['q' => $q, 'skip' => $skip, 'take' => $take]);
	}
}
