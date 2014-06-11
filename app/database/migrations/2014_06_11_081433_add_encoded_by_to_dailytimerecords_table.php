<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEncodedByToDailytimerecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dailytimerecords', function(Blueprint $table)
		{
			$table->string('encoded_by');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('dailytimerecords', function(Blueprint $table)
		{
			$table->dropColumn('encoded_by');
		});
	}

}
