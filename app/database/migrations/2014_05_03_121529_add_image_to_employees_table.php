<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImageToEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employees', function(Blueprint $table) {
			$table->text('image');
			$table->double('salary');

			// Additional fields
			$table->integer('educational_attainment')->unsigned()->index();
			$table->string('fathers_name', '200');
			$table->string('mothers_name', '200');
			$table->integer('children_count')->nullable();
			$table->string('name_extension', '15')->nullable();

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
			$table->dropColumn('image');
			$table->dropColumn('salary');

			$table->dropColumn('educational_attainment');
			$table->dropColumn('fathers_name');
			$table->dropColumn('mothers_name');
			$table->dropColumn('children_count');
			$table->dropColumn('name_extension');
		});
	}

}
