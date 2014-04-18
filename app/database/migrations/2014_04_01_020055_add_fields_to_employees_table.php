<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees', function(Blueprint $table) {
			$table->boolean('annual_pe');
			$table->boolean('ppe_issuance');
			$table->boolean('with_r1a');
			$table->string('employment_status', 20);
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employees', function(Blueprint $table) {
			$table->dropColumn('annual_pe');
			$table->dropColumn('ppe_issuance');
			$table->dropColumn('with_r1a');
			$table->dropColumn('employment_status');
		});
	}

}
