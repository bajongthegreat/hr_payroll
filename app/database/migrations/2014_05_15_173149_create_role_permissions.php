<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolePermissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles_permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->unsigned()->index();
			$table->string('uri_segment', 50);
			$table->string('action_permitted', 25);
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
		Schema::drop('roles_permissions');
	}

}
