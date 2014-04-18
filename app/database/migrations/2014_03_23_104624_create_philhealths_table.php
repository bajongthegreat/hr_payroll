<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhilhealthsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('philhealth', function(Blueprint $table) {
			$table->increments('id');
			$table->double('salary_range_start');
			$table->double('salary_range_end');
			$table->double('employee_share');
			$table->double('employer_share');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::drop('philhealth');
	}

}
