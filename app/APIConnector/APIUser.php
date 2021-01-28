<?php namespace App\APIConnector;

use Session;

class APIUser {

	use APITrait;

	function authenticate($email, $password)
	{
		return self::run(self::$basic_url . 'users/authenticate', 'POST', ['email' => $email, 'password' => $password]);
	}
}
