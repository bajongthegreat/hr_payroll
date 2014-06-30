<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayrollTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payroll', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('employee_id')->unsigned()->index();
			$table->date('date');
			$table->date('pay_period_start');
			$table->date('pay_period_end');
			$table->integer('days_worked')->unsigned();
			$table->double('grosspay');
			$table->double('deductions');
			$table->double('netpay');
			$table->string('remarks');
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
		Schema::drop('payroll');
	}

}
