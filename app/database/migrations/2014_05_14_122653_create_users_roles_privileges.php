<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersRolesPrivileges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_roles_privileges', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('role_id')->index();
			$table->string('uri_segment', 50);
			$table->integer('_create');
			$table->integer('_edit');
			$table->integer('_view');
			$table->integer('_delete');
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
		Schema::drop('users_roles_privileges');
	}

}
