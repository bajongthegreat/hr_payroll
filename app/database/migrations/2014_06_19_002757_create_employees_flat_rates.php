<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesFlatRates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees_flat_rates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->double('rate');
			$table->double('overtime_rate');
			$table->double('holiday_rate');
			$table->double('night_premium_10_3');
			$table->double('night_premium_3_6');
			$table->string('type', 100);
			$table->integer('parent_id')->unsigned()->nullable();
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
		Schema::drop('employees_flat_rates');
	}

}
