<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNameToEmployeesFlatRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees_flat_rates', function(Blueprint $table)
		{
			$table->string('name', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employees_flat_rates', function(Blueprint $table)
		{
			$table->dropColumn('name');
		});
	}

}
