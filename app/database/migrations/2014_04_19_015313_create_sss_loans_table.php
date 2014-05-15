<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSSSLoansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('SSS_loans', function(Blueprint $table) {
			$table->increments('id');
			$table->string('sss_id');
			$table->date('date_issued');
			$table->double('loan_amount');
			$table->date('salary_deduction_date');
			$table->double('monthly_amortization');
			$table->integer('duration_in_months');
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
		Schema::drop('SSS_loans');
	}

}
