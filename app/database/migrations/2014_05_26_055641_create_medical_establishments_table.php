<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedicalEstablishmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('medical_establishments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('address');
			$table->string('telephone_number');
			$table->string('email');
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
		Schema::drop('medical_establishments');
	}

}
