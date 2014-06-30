<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDisciplinaryActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('disciplinary_actions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->date('violation_date');
			$table->date('violation_effectivity_date')->nullable();
			$table->integer('violation_id')->unsigned()->index();
			$table->timestamps();

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
		Schema::drop('disciplinary_actions');
	}

}
