<?php namespace Acme\Services\Validation;

class SSSLoanPaymentValidator extends Validator {

	static $rules = array(
							'sbr_tr_number' => 'required|numeric',
							'sbr_tr_date' => 'required|date',
							'amount' => 'required|numeric'
						);

	static $create_rules = array(
							'sbr_tr_number' => 'required|numeric',
							'sbr_tr_date' => 'required|date',
							'amount' => 'required|numeric'
						);


	static $update_rules = array(	
							'sbr_tr_number' => 'required|numeric',
							'sbr_tr_date' => 'required|date',
							'amount' => 'required|numeric'
						);

}

?>