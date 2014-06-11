<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDtrsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('DailyTimeRecords', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('work_date');
			$table->integer('employee_id')->unsigned()->index();
			$table->string('time_in_am', 5);
			$table->string('time_out_am', 5);
			$table->string('time_in_pm', 5);
			$table->string('time_out_pm', 5);
			$table->string('remarks');
			$table->string('submitted_by');
			$table->string('noted_by');
			$table->string('conformed_by');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('DailyTimeRecords');
	}

}
