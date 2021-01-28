<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model {

	// Traits
    use SoftDeletes;

	//
	function getErrors()
	{
		return $this->errors;
	}

	function getError()
	{
		return $this->getErrors();
	}

	function setErrors(MessageBag $errors)
	{
		$this->errors = $errors;
	}

	function setError(MessageBag $errors)
	{
		$this->setErrors($errors);
	}

}
