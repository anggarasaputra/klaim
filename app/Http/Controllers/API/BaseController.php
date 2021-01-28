<?php namespace App\Http\Controllers\API;

use \App\Http\Controllers\Controller as Controller;

abstract class BaseController extends Controller {

	protected $max_take = 25;

	function __construct() 
	{
	}
	
}
