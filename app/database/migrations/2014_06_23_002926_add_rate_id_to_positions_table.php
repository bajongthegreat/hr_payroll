<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRateIdToPositionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('positions', function(Blueprint $table)
		{
			$table->integer('rate_id')->unsigned()->index()->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('positions', function(Blueprint $table)
		{
			$table->dropColumn('rate_id');
		});
	}

}
