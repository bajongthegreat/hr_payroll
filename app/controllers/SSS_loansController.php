<?php

use Acme\Repositories\Loans\SSS\SSSLoanRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\SSSLoanValidator as jValidator;
class SSS_loansController extends BaseController {


	protected $sss_loans;
	protected $validator;
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(SSSLoanRepositoryInterface $sss_loans, jValidator $validator)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->sss_loans = $sss_loans;
	                                                                                                                                  
	        $this->validator = $validator;
	    }
	
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$loans = $this->sss_loans->all();

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


		$sss_loan_data = Input::only('sss_id','date_issued','loan_amount', 'salary_deduction_start', 'monthly_amortization','duration_in_months','employee_id');
		$hash_segment = '#employee=' . $id;

		// Validate Inputs
		if (!$this->validator->validate($sss_loan_data, NULL, $custom_message)) {
			return Redirect::action('SSS_loansController@create',$hash_segment )->withInput()->withErrors($this->validator->errors());
		}

		$this->sss_loans->create($sss_loan_data);

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
        return View::make('sss_loans.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$loan = $this->sss_loans->findWith($id,'employee')->get()[0];
		
	

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
		$sss_loan_data = Input::only('sss_id','date_issued','loan_amount', 'salary_deduction_start', 'monthly_amortization','duration_in_months');

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
