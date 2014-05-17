<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEmployeeIdToSssLoansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sss_loans', function(Blueprint $table)
		{
			$table->integer('employee_id')->unsigned()->index();
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sss_loans', function(Blueprint $table)
		{
			$table->dropColumn('employee_id');
		});
	}

}
