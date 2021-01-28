<?php namespace App;

use Validator, Hash;

class UserObserver {
	
	function saving($model)
	{
		// rules
		$rules['name']			= 'required';
		$rules['email']			= 'required|email|unique:' . $model->getTable() . ',email,' . ($model->id ? $model->id : "NULL") . ',id';
		$rules['password']		= 'required|min:6';

		// data
		$data['name']			= $model->name;
		$data['email']			= $model->email;
		$data['password']		= $model->password;

		$validator = Validator::make($data, $rules);
		if ($validator->fails())
		{
			$model->setErrors($validator->messages());
			return false;
		}
		else
		{
			if (Hash::needsRehash($model->password))
			{
				$model->password = Hash::make($model->password);
			}
		}
	}

}