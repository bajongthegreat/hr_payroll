<?php

use Acme\Repositories\Loans\SSS\SSSLoanPaymentRepositoryInterface;
use Acme\Repositories\Loans\SSS\SSSLoanRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\SSSLoanValidator as jValidator;
class SSS_loansController extends BaseController {


	protected $sss_loans;
	protected $validator;
	protected $sss_loan_payment;

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(SSSLoanRepositoryInterface $sss_loans,
	    							SSSLoanPaymentRepositoryInterface $sss_loan_payment, 
	    	                        jValidator $validator)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	   
	        // UsersRepository Dependency
	        $this->sss_loans = $sss_loans;

	        $this->sss_loan_payment = $sss_loan_payment;
	                                                                                                                                  
	        $this->validator = $validator;
	    }
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$loans = $this->sss_loans->all_with_employee();

    return View::make('sss_loans.index', compact('loans'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('sss_loans.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$custom_message = ['messages' => ['sss_id.regex' => 'SSS ID must have a format of XX-XXXXXXX-X (2-7-1)' ,
		                                  'philhealth_id.regex' => 'Philhealth ID must have a format of XX-XXXXXXXXX-X (2-9-1)'] ];
		$id = Input::get('work_id');



		$creation_allowed = false;
		$sss_loan_data = Input::only('sss_id','date_issued','loan_amount', 'salary_deduction_date', 'monthly_amortization','duration_in_months','employee_id','check_number','check_amount', 'check_date');
		$hash_segment = '#employee=' . $id;


		$sss_loan_data['status'] = 'open';


		// Validate Inputs
		if (!$this->validator->validate($sss_loan_data, NULL, $custom_message)) {
			return Redirect::action('SSS_loansController@create', [$hash_segment] )->withInput()->withErrors($this->validator->errors());
		}

		// Before adding new loans, check first if the member's payment is equal or greater than 50%
		$total_payments = DB::table('sss_loans_remittance')->leftJoin('sss_loans','sss_loans.id', '=', 'sss_loans_remittance.sss_loan_id')->leftJoin('employees','employees.id','=','sss_loans.employee_id')->where('employees.id', '=', $sss_loan_data['employee_id'])->sum('amount');
		$loan = DB::table('sss_loans')->leftJoin('employees','employees.id','=','sss_loans.employee_id')->where('employees.id', '=', $sss_loan_data['employee_id'])->where('status','=','open')->first(['monthly_amortization', 'sss_loans.id']);

		 	// dd($total_payments);

		if ($loan) {

			$current_loan_payment_obligation = $loan->monthly_amortization;


			// To get payment percentage, divide $total_payments by ($current_loan_payment_obligation multiplied by month duration) then multiply by 100 
			$payment_percentage = round(($total_payments / ($current_loan_payment_obligation * 24) ) * 100, 1); 

			// Not allowed to loan
			if ($payment_percentage < 50) {
				return Redirect::action('SSS_loansController@create', [$hash_segment])->withErrors(['This member does not qualify to apply for new loan. Please settle his/her previous account and pay atleast 50%. ']);
		
			} elseif ($payment_percentage >= 50 && $payment_percentage < 100) {
		
				// If the payment percentage is less than 100, deduct any remaining balance to the new loan
				// And close the previous one

			
				$balance =  abs(($current_loan_payment_obligation *24) - $total_payments);

	
				try {

					// dd($loan);
					// Submit payments to previous loan to close it
					$offset_valid = $this->sss_loan_payment->create(['sss_loan_id' => $loan->id,
						                                                       'type' => 'offset_loan',
												          			           'amount' => $balance,
												          			           'remarks' => 'Payment to old accounts from new loan. [Loan offset]' ]);


					if ($offset_valid) {
						$creation_allowed = true;
						$this->sss_loans->find($loan->id)->update(['status' => 'closed',
							                                                    'remarks' => 'This loan was closed through offset loan.']);
					}

					
				} catch (Exception $e) {
					// dd($e->getMessage());
					return Redirect::route('sss_loans.create')->withInputs()->withErrors(['Failed to offset loan. Please try again.']);
				}

			}
			
		}


		$loan_count = $this->sss_loans->find($sss_loan_data['employee_id'], 'employee_id')->where('date_issued', '=', $sss_loan_data['date_issued'])->count();

		if ($loan_count == 0 || $creation_allowed) {
			$this->sss_loans->create($sss_loan_data);
		}

		
		return Redirect::action('SSS_loansController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$payments = DB::table('sss_loans_remittance')->where('sss_loan_id', '=', $id)->get();
		$total_payments = DB::table('sss_loans_remittance')->where('sss_loan_id', '=', $id)->sum('amount');

		$sss_loan_profile = DB::table('sss_loans')->where('sss_loans.id', '=', $id)
		                                                 ->leftJoin('employees', 'employees.id', '=', 'sss_loans.employee_id')
		                                                 ->select('employees.firstname', 'employees.lastname', 'employees.middlename', 'employees.name_extension',
		                                                 	     'sss_loans.*','employees.sss_id','employees.birthdate', 'employees.employee_work_id')
		                                                 ->first();

		if (!$sss_loan_profile) {
			return Redirect::route('sss_loans.index')->with('message', 'Loan data does not exist.');
		}
		                                                 
        return View::make('sss_loans.show', compact('payments', 'sss_loan_profile', 'total_payments' ));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$loan = $this->sss_loans->findWith($id,'employee')->first();
		
	

        return View::make('sss_loans.edit', compact('loan'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$custom_message = ['messages' => ['sss_id.regex' => 'SSS ID must have a format of XX-XXXXXXX-X (2-7-1)' ,
		                                  'philhealth_id.regex' => 'Philhealth ID must have a format of XX-XXXXXXXXX-X (2-9-1)'] ];

		// $sss_loan_data = Input::only('sss_id','date_issued','loan_amount', 'salary_deduction_date', 'monthly_amortization','duration_in_months');
		$sss_loan_data = Input::only('sss_id','date_issued','loan_amount', 'salary_deduction_date', 'monthly_amortization','duration_in_months','employee_id','check_number','check_amount', 'check_date');


		// Validate Inputs
		if (!$this->validator->validate($sss_loan_data, NULL, $custom_message)) {
			return Redirect::action('SSS_loansController@edit/', [$id,$hash_segment] )->withInput()->withErrors($this->validator->errors());
		}

		$this->sss_loans->find($id)->update($sss_loan_data);

		return Redirect::action('SSS_loansController@index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->sss_loans->find($id)->delete();

		return Redirect::action('SSS_loansController@index');
	}

	

}
