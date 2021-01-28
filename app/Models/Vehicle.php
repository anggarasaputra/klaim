<?php namespace App;

class Vehicle extends BaseModel {

	// Properties
	protected 	$table 		= 'insurances';
	protected 	$fillable	= [];
	public 		$timestamps = true;
	protected 	$dates 		= ['deleted_at'];

	// ------------------------ BOOT ------------------------
	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	static function boot()
	{
		parent::boot();
	}

	// ------------------------ RELATIONSHIP ------------------------
	function user()
	{
		return $this->belongsTo(__NAMESPACE__ . '\User');
	}

	function insurances()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Insurance');
	}

	function claims()
	{
		return $this->hasMany(__NAMESPACE__ . '\Claim');
	}

	// ------------------------ SCOPE ------------------------

	// ------------------------ MUTATOR ------------------------

	// ------------------------ ACCESSOR ------------------------

	// ------------------------ FUNCTIONS ------------------------
}
