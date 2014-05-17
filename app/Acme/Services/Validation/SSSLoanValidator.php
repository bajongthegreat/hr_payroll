<?php namespace Acme\Services\Validation;

class SSSLoanValidator extends Validator
{
	static $rules = array(
							'date_issued' => 'required|date',
							'loan_amount' => 'required',
							'salary_deduction_date' => 'required|date',
							'monthly_amortization' => 'required',
							'employee_id' => 'required',
							'sss_id' => array('regex:/^[0-9]{2}-[0-9]{7}-[0-9]{1}$/')
						);

	static $create_rules = array(
							'date_issued' => 'required|date',
							'loan_amount' => 'required',
							'salary_deduction_date' => 'required|date',
							'monthly_amortization' => 'required',
							'employee_id' => 'required',
							'sss_id' => array('regex:/^[0-9]{2}-[0-9]{7}-[0-9]{1}$/')
						);


	static $update_rules = array(
							'date_issued' => 'required|date',
							'loan_amount' => 'required',
							'salary_deduction_date' => 'required|date',
							'monthly_amortization' => 'required',
							'employee_id' => 'required',
							'sss_id' => array('regex:/^[0-9]{2}-[0-9]{7}-[0-9]{1}$/')
							
						);


}


?>