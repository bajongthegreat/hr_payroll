<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesPharmacyPosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees_pharmacy_po', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_work_id', 20)->index();
			$table->date('date');
			$table->double('amount');
			$table->string('remarks');
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
		Schema::drop('employees_pharmacy_po');
	}

}
