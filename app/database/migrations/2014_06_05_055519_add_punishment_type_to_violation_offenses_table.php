<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPunishmentTypeToViolationOffensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('violations_offenses', function(Blueprint $table)
		{
			$table->string('punishment_type', 30)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('violations_offenses', function(Blueprint $table)
		{
			$table->dropColumn('punishment_type');
		});
	}

}
