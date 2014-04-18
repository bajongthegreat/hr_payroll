<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCompanyIdToDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('departments', function(Blueprint $table) {
			$table->integer('company_id')->unsigned()->index();

			// Relationship
			$table->foreign('company_id')
			      ->references('id')
			      ->on('companies')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
		});

		
	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('departments', function(Blueprint $table) {
		
			$table->dropColumn('company_id');
			DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		});
	}

}
