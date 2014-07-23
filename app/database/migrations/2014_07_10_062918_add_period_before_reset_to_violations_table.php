<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPeriodBeforeResetToViolationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('violations', function(Blueprint $table)
		{
			$table->double('period_before_reset');
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('violations', function(Blueprint $table)
		{
			$table->dropColumn('period_before_reset');
		});
	}

}
