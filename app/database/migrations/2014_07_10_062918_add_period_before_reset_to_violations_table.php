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
			$table->dropColumn('first_offense');
			$table->dropColumn('second_offense');
			$table->dropColumn('third_offense');
			$table->dropColumn('fourth_offense');
			$table->dropColumn('fifth_offense');
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
