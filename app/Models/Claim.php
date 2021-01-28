<?php namespace App;

class Claim extends BaseModel {

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
	function status()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\ClaimStatus', 'claim_claimstatus', 'claim_id', 'claim_status_id');
	}

	function vehicles()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Vehicle');
	}

	function user()
	{
		return $this->belongsTo(__NAMESPACE__ . '\User');
	}

	// ------------------------ SCOPE ------------------------

	// ------------------------ MUTATOR ------------------------

	// ------------------------ ACCESSOR ------------------------

	// ------------------------ FUNCTIONS ------------------------

}
