<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimekeepingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timekeepings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->time('time_in_am');
			$table->time('time_out_am');
			$table->time('time_in_pm');
			$table->time('time_out_pm');
			$table->date('timekeeping_date');
			$table->integer('employee_id')->unsigned()->index();
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
		Schema::drop('timekeepings');
	}

}
