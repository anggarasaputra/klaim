<?php namespace App;

class Vendor extends BaseModel {

	// Properties
	protected 	$table 		= 'vendors';
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
	function insurances()
	{
		return $this->hasMany(__NAMESPACE__ . '\Insurance');
	}

	// ------------------------ SCOPE ------------------------
	function scopeName($q, $value = null)
	{
		if (!$value)
		{
			return $q;
		}
		else
		{
			$value = str_replace("*", '%', $value);
			return $q->where('name', 'like', $value);
		}
	}

	// ------------------------ MUTATOR ------------------------

	// ------------------------ ACCESSOR ------------------------

	// ------------------------ FUNCTIONS ------------------------
}
