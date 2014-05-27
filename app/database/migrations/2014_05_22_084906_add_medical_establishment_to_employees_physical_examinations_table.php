<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMedicalEstablishmentToEmployeesPhysicalExaminationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees_physical_examinations', function(Blueprint $table)
		{
			$table->string('medical_establishment');
			// $table->integer('medical_establishment')->unsigned()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employees_physical_examinations', function(Blueprint $table)
		{
			$table->dropColumn('medical_establishment');
		});
	}

}
