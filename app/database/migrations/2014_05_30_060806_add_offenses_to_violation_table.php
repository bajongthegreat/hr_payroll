<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOffensesToViolationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('violations', function(Blueprint $table)
		{
			$table->dropColumn('penalty');
			$table->string('first_offense');
			$table->string('second_offense')->nullable();
			$table->string('third_offense')->nullable();
			$table->string('fourth_offense')->nullable();
			$table->string('fifth_offense')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('violations', function(Blueprint $table)
		{
			$table->string('penalty');
			$table->dropColumn('first_offense');
			$table->dropColumn('second_offense');
			$table->dropColumn('third_offense');
			$table->dropColumn('fourth_offense');
			$table->dropColumn('fifth_offense');
		});
	}

}
