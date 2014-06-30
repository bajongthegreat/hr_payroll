<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeDeductionsContribution extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees_deductions_contribution', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->string('type', 50);
			$table->double('amount');
			$table->string('note');
			$table->date('date');
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
		Schema::drop('employees_deductions_contribution');
	}

}
