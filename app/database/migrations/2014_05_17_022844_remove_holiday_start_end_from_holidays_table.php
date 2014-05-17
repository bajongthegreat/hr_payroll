<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveHolidayStartEndFromHolidaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('holidays', function(Blueprint $table)
		{
			$table->dropColumn('holiday_start');
			$table->dropColumn('holiday_end');
			$table->date('holiday_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('holidays', function(Blueprint $table)
		{
			$table->date('holiday_start');
			$table->date('holiday_end');
			$table->dropColumn('holiday_date');
		});
	}

}
