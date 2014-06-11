<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddShiftToDailytimerecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dailytimerecords', function(Blueprint $table)
		{
			$table->string('shift', 2);
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
			$table->dropColumn('shift');
		});
	}

}
