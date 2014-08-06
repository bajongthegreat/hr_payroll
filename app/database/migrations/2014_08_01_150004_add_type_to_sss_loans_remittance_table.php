<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddtypeToSssLoansRemittanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sss_loans_remittance', function(Blueprint $table)
		{
			$table->string('type', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sss_loans_remittance', function(Blueprint $table)
		{
			$table->dropColumn('type');
		});
	}

}
