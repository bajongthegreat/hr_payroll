<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotEmployeeRequirementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_requirement', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->integer('requirement_id')->unsigned()->index();
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
			$table->foreign('requirement_id')->references('id')->on('requirements')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_requirement');
	}

}
