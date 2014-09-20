<?php

// SSS Loan Payments
use Acme\Repositories\Loans\SSS\SSSLoanPaymentRepositoryInterface;

// SSS loan
use Acme\Repositories\Loans\SSS\SSSLoanRepositoryInterface;


// Use a Validation Service
use Acme\Services\Validation\SSSLoanPaymentValidator as jValidator;

class SSS_loan_paymentsController extends BaseController {

	protected $sss_loans;
	protected $sss_loan_payment;
	protected $validator;

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(SSSLoanPaymentRepositoryInterface $sss_loan_payment, 
	    						    SSSLoanRepositoryInterface $sss_loans,
	    	                        jValidator $validator)
	    {

	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // Loan Payment Dependency
	        $this->sss_loan_payment = $sss_loan_payment;

	        // Loan Payment
	        $this->sss_loans = $sss_loans;
	                                                                                                                                  
	        $this->validator = $validator;
	    }

	public function edit($id) {
		if ( Request::ajax() ) {

			$payment_data = $this->sss_loan_payment->find($id)->first()->toArray();

			if (!$payment_data) {
				return Response::json(['status' => 'failed', 
					                   'message' => 'Could not find the payment details. Please try again.' ]);
			} 

			return Response::json(['status' => 'success',
				                   'message' => '',
				                   'data' => $payment_data ]);


		} else {
			return Redirect::action('SSS_loansController@index');
		}
	}

	public function update($id) {

		// Handle ajax request
		if (Request::ajax() ) {
			
			$required_information = Input::only('sbr_tr_number','sbr_tr_date','amount', 'sss_loan_id', 'post_date');
			$employee_id = Input::get('employee_id');



			// Validate Inputs
			if (!$this->validator->validate($required_information, NULL)) {
				return Response::json( ['errors' => $this->validator->errors()->toArray() ]);
			}

			// Get Loan Balance
			$loanBalanceObj = $this->loanBalance($required_information['sss_loan_id'], 'object');

			$loanBalance = $loanBalanceObj['balance'];

			// Get old value
			$oldValue = $this->previousEditData('amount', $id, $required_information['amount']);

			// var_dump($loanBalance);

			if ($loanBalance == 0) {

				// Open the status of loan if editing  amount lower than the previous one
				if ($oldValue > $required_information['amount']) {

					// Check if there are other open accounts for this employee
					if ( $this->anyAccountOpen($employee_id) ) {

						return Response::json(['status' => 'failed', 'message' => 'There are open accounts as of this moment. Please settle it first. <p>We don\'t allow two accounts open at the same time.</p>']);

					}
					$this->sss_loans->find($required_information['sss_loan_id'])->update(['status' => 'open']);					
				}	


				// Known bug:
				// Accepts excess amount

				// Get the difference between the stored payment amount and the current edited amount
				$amount = $oldValue - $required_information['amount'];

				$r_balance = round( ($loanBalance + $amount), 2);

				if ($r_balance < 0) {
					
					$required_information['amount'] = $required_information['amount'] - abs($r_balance); 
				}


			} 
			else {

				// Get the difference between the stored payment amount and the current edited amount
				$amount = $oldValue - $required_information['amount'];

				
				// The difference of old and new values is less than 0
				if ($amount < 0) {
					$r_balance = round( ($loanBalance + $amount), 2);
					
					if ($r_balance == 0) {
						$this->sss_loans->find($required_information['sss_loan_id'])->update(['status' => 'closed']);
					} elseif ($r_balance < 0) {
						// var_dump(['Excess', $loanBalance, $amount]);

						$required_information['amount'] = $required_information['amount'] - abs($r_balance);
						$this->sss_loans->find($required_information['sss_loan_id'])->update(['status' => 'closed']); 
					}

				} else {
					// New value is less than the old value
				}





			}


			$status = $this->sss_loan_payment->find($id)->update($required_information);	

				if ($status) {
					return Response::json(['status' => 'success', 'message' => 'SSS Loan payment updated successfully!']);
				} 

				return Response::json(['status' => 'failed', 'message' => 'SSS Loan payment update failed. Please try again.']);



		 
		} else {
			return Redirect::action('SSS_loansController@index');
		}

	}

	public function store()
	{

		// Handle ajax request
		if (Request::ajax() ) {
			
			$required_information = Input::only('sbr_tr_number','sbr_tr_date','amount', 'sss_loan_id', 'post_date');

			// Regular type of payment
			$required_information['type'] = 'regular';

			// Validate Inputs
			if (!$this->validator->validate($required_information, NULL)) {
				return Response::json( ['errors' => $this->validator->errors()->toArray() ]);
			}

			// Check if SSS Loan is still open and not yet fully paid
			if ( $this->isPayable($required_information['sss_loan_id'], $required_information['amount']) ) {


					$new_balance = ($this->loanBalance($required_information['sss_loan_id']) - $required_information['amount']);

				 if ( $new_balance == 0 ) {
				 	// Close the loan
						$this->sss_loans->find($required_information['sss_loan_id'])->update(['status' => 'closed']);	
				 }
				$status = $this->sss_loan_payment->create($required_information);	



				if ($status) {
					return Response::json(['status' => 'success', 'message' => 'SSS Loan payment submitted successfully!']);
				} 

				return Response::json(['status' => 'failed', 'message' => 'SSS Loan payment submission failed. Please try again.']);

			} else {
				return Response::json(['status' => 'failed', 'message' => 'SSS Loan payment is fully paid. No other payments can be accepted.']);				
			}


		 
		} else {
			return Redirect::action('SSS_loansController@index');
		}


	}

	public function loanBalance($loan_id, $return_type = 'float') {
		$loan_payment = $this->sss_loan_payment->find($loan_id, 'sss_loan_id')->sum('amount');
		$loan = $this->sss_loans->find($loan_id)->where('status','=','open')->first(['monthly_amortization', 'duration_in_months']);

		// Check if loan is still open
		if (!$loan) return 0;

		// Check all payments made
		if (!$loan_payment) $loan_payment = 0;

		// Get the total amount obligated to pay 
		$amount_obligation = $loan->monthly_amortization * $loan->duration_in_months;

		// Difference
		$diff = $amount_obligation - $loan_payment;

		if ($return_type == 'float') {
			return $diff;	
		} else {
			return [ 'payable_amount' => $amount_obligation,
			         'balance' => $diff ];
		}
	}

	public function previousEditData($field, $id, $new_value) {
		$old = $this->sss_loan_payment->find($id)->pluck($field);

		return (!$old) ?: $old;
	}

	public function anyAccountOpen($employee_id) {
		$open_accounts = $this->sss_loans->find($employee_id, 'employee_id')
		                                 ->where('status','=','open')
		                                 ->count();

		if ($open_accounts >= 1) {
			return true;
		}

		return false;
	}

	public function isPayable($loan_id, &$pay_amount) {
		
		// Get loan balance
		$diff = $this->loanBalance($loan_id);

		// If there's still balance, then it is still payable
		if ($diff > 0) {

			// Check if pay amount is greater than the amount obligation
			if ($pay_amount > $diff) {

				// Change the value of the referenced variable $pay_amount based on the remaining balance
				$pay_amount = $diff;
			}
 
			return true;
		}

		return false;

	}
}