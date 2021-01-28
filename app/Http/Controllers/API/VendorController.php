<?php namespace App\Http\Controllers\API;

use \App\Vendor as Model;


use \ThunderID\jsend\jsend as jsend;
use Input, Auth, Response, Validator;

class VendorController extends BaseController {

	protected $model;

	function __construct(Model $model)
	{
		$this->model = $model;
	}
	
	function getSearch()
	{
		$input['q'] 	= Input::get('q');
		$input['skip'] 	= max(0, Input::get('skip'));
		$input['take'] 	= Input::has('take') ? min( max(1, Input::get('take')), $this->max_take) : $this->max_take;

		$rules = [
					'q' 	=> '',
					'skip'	=> 'min:0',
					'take'	=> 'min:1|max:' . $this->max_take
				 ];

		$validator = Validator::make($input, $rules);

		if ($validator->fails())
		{
			$response = new jsend('error', $validator->messages()->toArray());
		}
		else
		{
			// grab data
			$vendors = $this->model->name($input['q'])->skip($input['skip'])->take($input['take'])->get();

			// get total data
			$vendor_count = $this->model->name($input['q'])->count();

			// generate response
			$response = new jsend('success', ['data' => $vendors->toArray(), 'count' => $vendor_count]);
		}
		
		// return result
		return Response::json($response->toArray(), 200);
	}

}
