<?php namespace App\Http\Controllers\API;

use \App\User as Model;
use \ThunderID\jsend\jsend as jsend;
use Input, Auth, Response;

class UserController extends BaseController {

	protected $model;
	
	function postAuthenticate()
	{
		$credential = Input::only('email', 'password');

		if (Auth::attempt($credential))
		{
			$response = new jsend('success', Auth::user()->toArray());
			return Response::json($response->toArray(), 200);
		}
		else
		{
			$response = new jsend('fail', ['credential' => 'Invalid Username and/or password']);
			return Response::json($response->toArray(), 200);
		}
	}

}
