<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdjustmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adjustments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type', 6);
			$table->double('amount');
			$table->string('remarks')->nullable();
			$table->integer('employee_id')->unsigned()->index();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adjustments');
	}

}
