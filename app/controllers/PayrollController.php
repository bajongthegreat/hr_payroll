<?php

use Acme\Repositories\Payroll\PayrollRepositoryInterface as PayrollRepositoryInterface;

class PayrollController extends \BaseController {

	protected $payroll;
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(PayrollRepositoryInterface $payroll)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->payroll = $payroll;	                                                                                                                                  
	        
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /payroll
	 *
	 * @return Response
	 */
	public function index()
	{

		$start_date =  Input::get('start_date');
		$end_date = Input::get('end_date');

		$company_id = (int) Input::get('company_id');


		$payroll_data_container = [];

		$dtr =  $this->payroll->getDTRfromRange($start_date, $end_date, NULL, $company_id);

		foreach ($dtr as $key => $obj_dtr) {
			# code...
			
			$overtime = 0;
			$overtime_pay= 0;
			$holiday_pay = 0;
			$night_premium = 0;

			// Check if the DTR is a holiday or not
			$work_type = $this->payroll->getWorkDayType($obj_dtr->work_date);

			// Get hours worked
			$hours_worked =  $this->payroll->timeDiff($obj_dtr->time_in_am, $obj_dtr->time_out_am) + $this->payroll->timeDiff($obj_dtr->time_in_pm, $obj_dtr->time_out_pm);

			// Get rate object
			$rate = $this->payroll->getRateByWorkAssignment($obj_dtr->work_assignment_id, $work_type);
			// echo '<br>';
			// var_dump($rate->rate);
			// 			echo '<br>';

			if ($obj_dtr->shift == 'ns' ){
				// echo '<br> The qualified time : ' . $obj_dtr->time_in_pm . ' TO ' . $obj_dtr->time_out_am;
				$night_premium_arr = $this->payroll->getNightPremiumHours($obj_dtr->time_in_pm, $obj_dtr->time_out_am);

				// 10:00 PM to 3:00 AM
				$night_premium = ($night_premium_arr['np_10']) * $rate->night_premium_10_3;
				$night_premium += ($night_premium_arr['np_3'] * $rate->night_premium_3_6);

			}

			// Check if Overtime
			if ($hours_worked > 8) {
				
				$overtime = $hours_worked - 8;
				$hours_worked -= $overtime;
				$overtime_pay = $overtime * $rate->overtime_rate;

			}

			// var_dump($obj_dtr);

			// // Make an object and store all required data for the next processing

			$payroll_data_container[$obj_dtr->employee_id] = [   'days_worked' => 1 + (isset($payroll_data_container[$obj_dtr->employee_id]['days_worked']) ? $payroll_data_container[$obj_dtr->employee_id]['days_worked'] : 0),
																 'overtime_pay' => $overtime_pay + (isset($payroll_data_container[$obj_dtr->employee_id]['overtime_pay']) ? $payroll_data_container[$obj_dtr->employee_id]['overtime_pay'] : 0),
																 'night_premium' => round($night_premium, 2) + (isset($payroll_data_container[$obj_dtr->employee_id]['overtime_pay']) ? $payroll_data_container[$obj_dtr->employee_id]['night_premium'] : 0),
																 'basic_pay' => ($hours_worked * $rate->rate) + (isset($payroll_data_container[$obj_dtr->employee_id]['basic_pay']) ? $payroll_data_container[$obj_dtr->employee_id]['basic_pay'] : 0)															];


		}
		
		return Response::json($this->payroll->getNetPay($payroll_data_container, ['start' => $start_date,
			                                                   'end' => $end_date]) );

		return View::make('payroll.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /payroll/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('payroll.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /payroll
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /payroll/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /payroll/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /payroll/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /payroll/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}