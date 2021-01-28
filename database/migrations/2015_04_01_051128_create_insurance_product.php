<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsuranceProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('insurance_vehicle', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('vehicle_id')->unsigned();
			$table->integer('insurance_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->index('vehicle_id');
			$table->index('insurance_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('insurance_vehicle');
	}

}
