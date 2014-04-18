<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaves', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();

			$table->string('type', '25');

			$table->date('start_date');
			$table->date('end_date');

			$table->text('reason');

			$table->date('approval_date');
			$table->string('status', '15');

			$table->timestamps();
			$table->softDeletes();

			// Create relationship
			$table->foreign('employee_id')
			      ->references('id')
			      ->on('employees')
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
		DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS = 0');
		Schema::drop('leaves');
	}

}
