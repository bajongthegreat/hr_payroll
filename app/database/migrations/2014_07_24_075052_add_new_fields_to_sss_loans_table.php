<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNewFieldsToSssLoansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sss_loans', function(Blueprint $table)
		{
			$table->date('check_date');
			$table->integer('check_number')->unsigned();
			$table->double('check_amount');
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
			$table->dropColumn('check_date');
			$table->dropColumn('check_number');
			$table->dropColumn('check_amount');
		});
	}

}
