<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddInCaseOfEmergencyDetailsToEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees', function(Blueprint $table)
		{
			$table->string('in_case_of_emergency_name');
			$table->string('in_case_of_emergency_contact');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employees', function(Blueprint $table)
		{
			$table->dropColumn('in_case_of_emergency_name');
			$table->dropColumn('in_case_of_emergency_contact');
		});
	}

}
