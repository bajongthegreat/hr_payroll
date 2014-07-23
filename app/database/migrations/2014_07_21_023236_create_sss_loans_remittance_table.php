<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSssLoansRemittanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sss_loans_remittance', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sss_loan_id')->unsinged()->index();
			$table->double('amount');
			$table->string('sbr_tr_number', 8)->nullable();
			$table->date('post_date');
			$table->date('sbr_tr_date')->nullable();
			$table->timestamps();

			// Create relationship
			// $table->foreign('sss_loan_id')
			//       ->references('id')
			//       ->on('sss_loans')
			//       ->onDelete('cascade')
			//       ->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sss_loans_remittance');
	}

}
