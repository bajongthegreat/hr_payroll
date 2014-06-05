<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddViolationIdToViolationsOffensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('violations_offenses', function(Blueprint $table)
		{
			$table->integer('violation_id')->index()->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('violations_offenses', function(Blueprint $table)
		{
			
		});
	}

}
