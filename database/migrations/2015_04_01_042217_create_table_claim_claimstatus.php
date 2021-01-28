<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClaimClaimstatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('claim_claimstatus', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('claim_id')->unsigned();
			$table->integer('claim_status_id')->unsigned();
			$table->datetime('since');

			$table->timestamps();
			$table->softDeletes();

			$table->index('claim_id');
			$table->index('claim_status_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('claim_claimstatus');
	}

}
