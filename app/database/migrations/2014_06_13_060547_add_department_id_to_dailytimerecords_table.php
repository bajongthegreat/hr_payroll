<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDepartmentIdToDailytimerecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('dailytimerecords', function(Blueprint $table)
		{
			$table->integer('work_assignment_id')->unsigned();
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
			$table->dropColumn('work_assignment_id');
		});
	}

}
