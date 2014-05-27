<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteMedicalEstablishmentToMedicalEstablishmentId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees_physical_examinations', function(Blueprint $table)
		{
			$table->dropColumn('medical_establishment');
			$table->dropColumn('medical_findings');
			$table->integer('medical_establishment_id')->unsigned()->index();
			$table->integer('medical_findings_id')->unsigned()->index()->nullable();
			// $table->foreign('medical_establishment_id')->references('id')->on('medical_establishments')->onDelete('cascade');
			
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
			$table->dropColumn('medical_establishment_id');
			$table->string('medical_establishment');

			$table->dropColumn('medical_findings_id');
			$table->string('medical_findings');
		

		});
	}

}
