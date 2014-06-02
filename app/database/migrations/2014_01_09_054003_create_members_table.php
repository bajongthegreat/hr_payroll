<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('department_id')->unsigned()->index();
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();

		});


		Schema::create('employees', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('position_id')->unsigned();
		

			$table->string('employee_work_id', 50)->unique()->nullable();

			$table->string('lastname', 50);
			$table->string('firstname', 50);
			$table->string('middlename', 50);
			$table->string('marital_status', 25);
			$table->date('birthdate');
			$table->string('address');
			$table->string('gender', 6);
			$table->string('membership_status');

			

			$table->date('date_hired')->nullable();
			$table->string('pagibig_id');
		    $table->string('sss_id');
		    $table->string('philhealth_id');
		    $table->string('tin_number');

			$table->softDeletes();
			$table->timestamps();

			// $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// DB::statement('SET GLOBAL FOREIGN_KEY_CHECKS = 0');
		Schema::drop('positions', 'employees');

	}

}
