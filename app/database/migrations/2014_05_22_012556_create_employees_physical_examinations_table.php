<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesPhysicalExaminationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees_physical_examinations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->date('date_conducted');
			$table->string('medical_findings', 200);
			$table->string('recommendations');
			$table->text('remarks');
			$table->timestamps();

			// Create relationship
			$table->foreign('employee_id')
			      ->references('id')
			      ->on('employees')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employees_physical_examinations');
	}

}
