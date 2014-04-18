<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('table');
			$table->string('action');
			$table->integer('user_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			//$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::drop('logs');
	}

}
