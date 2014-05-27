<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimekeepingHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('timekeeping_history', function(Blueprint $table)
		// {
		// 	$table->increments('id');
		// 	$table->integer('employee_id')->unsigned()->index();
		// 	$table->date('work_date');
		// 	$table->integer('hours_worked');
		// 	$table->string('shift', 10);
		// 	$table->timestamps();
		// });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Schema::drop('timekeeping_history');
	}

}
