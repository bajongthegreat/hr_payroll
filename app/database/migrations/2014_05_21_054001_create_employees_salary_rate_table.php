<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesSalaryRateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('employees_salary_rate', function(Blueprint $table)
		// {
		// 	$table->increments('id');
		// 	$table->string('name', 50);
		// 	$table->integer('hours_to_complete');
		// 	$table->double('rate');
		// 	$table->float('overtime_rate');
		// 	$table->float('night_premium_a');
		// 	$table->float('night_premium_b');
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
		// Schema::drop('employees_salary_rate');
	}

}
