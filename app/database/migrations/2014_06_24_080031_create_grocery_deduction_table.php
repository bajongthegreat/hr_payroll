<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroceryDeductionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees_grocery_po', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_work_id', 20)->index();
			$table->double('amount');
			$table->date('date');
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
		Schema::drop('employees_grocery_po');
	}

}
