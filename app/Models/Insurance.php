<?php namespace App;

class Insurance extends BaseModel {

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

	function vendor()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Vendor');
	}

	function vehicles()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Vehicle');
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
