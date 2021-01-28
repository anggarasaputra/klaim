<?php namespace App;

class ClaimStatus extends BaseModel {

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
	function claims()
	{
		return $this->belongsToMany(__NAMESPACE__ . '\Claim', 'claim_claimstatus', 'claim_status_id', 'claim_id');
	}

	// ------------------------ SCOPE ------------------------

	// ------------------------ MUTATOR ------------------------

	// ------------------------ ACCESSOR ------------------------

	// ------------------------ FUNCTIONS ------------------------
}
