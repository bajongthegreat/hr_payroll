<?php namespace Acme\Repositories\Payroll;

use Acme\Repositories\Payroll\Payroll as Payroll;
use Acme\Repositories\RepositoryAbstract;
use DB;
use DateTime;
use Carbon\Carbon;

// Class Dependencies
use Acme\Repositories\Employee\Contributions\SSSRepository as SSS;
use Acme\Repositories\Employee\Contributions\PhilhealthRepository as Philhealth;
use Acme\Repositories\Employee\Contributions\HDMFRepository as HDMF;

class PayrollRepository extends RepositoryAbstract implements PayrollRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	  protected $sss;
	  protected $hdmf;
	  protected $philhealth;

	  // Main table for using Laravel DB query builder
	  protected $table = "payroll";

	  // Table dependents
	  protected $rates_table="employees_flat_rates";
	  protected $cbu_remittance_table="employees_capital_build_ups";
	  protected $pharmacy_po_table="employees_pharmacy_po";
	  protected $grocery_po_table="employees_grocery_po";
	  protected $savings_table="employees_savings";
	  protected $positions_table = "positions";
	  protected $holidays_table = "holidays";
	  protected $fixed_deductions_table= "fixed_deductions";
	  protected $adjustments_table= "adjustments";
	  protected $employees_table = 'employees';
	  protected $tickets_po_table = "employees_tickets";
	  /**
	   * Constructor
	   */
	public function __construct(Payroll $model, SSS $sss, Philhealth $philhealth, HDMF $hdmf)
	{
	    $this->model = $model;
	    $this->sss = $sss;
	    $this->philhealth = $philhealth;
	    $this->hdmf = $hdmf;
	}

	public function all_payroll_by_period() {
		return $this->model->groupBy('pay_period_start','pay_period_end')
						   ->select('*', DB::raw('COUNT(*) as count'))
		                   ->get();
	}

	public function getEmployeeBasicInfo($employee_id) {
		return DB::table($this->employees_table)->where('id', '=', $employee_id)->first(['firstname','middlename', 'lastname', 'employee_work_id']);
	}

	public function getContribution($salary, $type="sss", $return_type="array") {
		
		// Only process if type is within this array
		if (!in_array($type, ['sss', 'philhealth', 'hdmf'])) return false; 
		$ee = $this->$type->getEmployeeShare($salary);
		$er = $this->$type->getEmployerShare($salary);

		if ($type == 'hdmf') {
			$ee = $ee * $salary;
			$er = $er * $salary;
		}


		$output = 0;
		
		switch ($return_type) {
			case 'total':
				$output = $ee + $er;
				break;
			
			case 'ee':
				$output = $ee;
				break;

			case 'er':
				$output =  $er;
				break;

			default:
				$output = [ 'ee' => $ee,
		        		   'er' => $er];
				break;
		}


		return $output;

	}

	public function getAdjustment($employee_id = NULL, $type, $start_date, $end_date) {
			
		if ( !in_array($type, ['debit', 'credit', 'dr', 'cr']) ) return false;

		$adjustment = DB::table($this->adjustments_table)->where(function($query) use($type, $employee_id, $start_date, $end_date) {
			
			// Check whether it is a 'debit' or 'credit'
			$query->where('type', '=', $type);
			$query->whereBetween('date', [$start_date, $end_date]);

			if (!is_null($employee_id)) {
				$query->where('employee_id', '=', $employee_id);				
			}

		})->select( DB::raw('SUM(amount) as amt') )->pluck('amt');

		return ($adjustment) ? $adjustment : 0;
	}

	public function getFixedDeductions($deduction_name) {
		$deduction = DB::table($this->fixed_deductions_table)->where('name', '=', $deduction_name )->pluck('amount');

		if ($deduction ){
			return (!is_null($deduction)) ? $deduction : 0; 
		}
		return 0;
	}


	public function getRateByWorkAssignment($work_assignment_id,  $work_type="regular") {

		// Get rate ID
		$rate_id = DB::table($this->positions_table)->where('id', '=', $work_assignment_id)->pluck('rate_id');

		if ($rate_id) {
			$raw_rate = DB::table($this->rates_table)->orWhere(function($query) use($work_type, $rate_id) {
				
				// If it is a regular working day, grab rate by ID
				if ($work_type == 'regular') {
					
					$query->where('id', '=', $rate_id);

				} else {
					// If the working day is a holiday or restday, 
					// Fetch the parent's children with the specified parent_id
					// Filter them by the type of holiday

					$query->where('parent_id', '=', $rate_id);
					$query->where('type', '=', $work_type);
				}
			})->first();

			if (count($raw_rate) == 1) {
				return $raw_rate;
			}
 
		}

		return false;
	}

	public function getSSSloan_bill($employee_id) {


	    // Get the first month payment date
		$loan_object = DB::table('sss_loans')->where('employee_id', '=', $employee_id)
		                                            ->where('status', '=', 'open')
		                                            ->first(['salary_deduction_date', 'id', 'monthly_amortization','loan_amount']);

		 // Employee has no loan
		 if (!$loan_object) return 0;


         // Payments
		 $payments = DB::table('sss_loans_remittance')->where('sss_loan_id', '=', $loan_object->id)
		                                              ->pluck(DB::raw('SUM(amount)'));
		 
		// Deduct payments to the loan amount
		$remainder = $loan_object->loan_amount - $payments;

		// If loan
		if ($remainder > $loan_object->monthly_amortization ) return $loan_object->monthly_amortization;

		return $remainder;
	}

	public function getDTRfromRange($start_date, $end_date, $employee_id = NULL, $company_id = NULL, $departments = array() ) {

		$dtr = DB::table('dailytimerecords')->whereBetween('work_date', [$start_date, $end_date])
			                                ->where(function($query) use ($employee_id, $company_id, $departments) {

			                                	if ($company_id != NULL) {
			                                		$query->where('employees.company_id', '=', $company_id);
			                                	}

			                                	if (count($departments) > 0) {
			                                		$allNumbers = $departments == array_filter($departments, 'is_numeric');

			                                		if ($allNumbers) {
			                                			$query->whereIn('departments.id', $departments);
			                                		}
			                                	}
			                                	
			                                	// if it is null, Get ALL DTR within that range
			                                	// otherwise, grab only the dtr from the specified ID within the specified date range

			                                	if (!is_null($employee_id)) {
			                                		$query->where('employee_id', '=', $employee_id);
			                                	}
			                                	
			                                })
			                                ->leftJoin('employees', 'employees.id', '=', "dailytimerecords.employee_id")
			                                ->leftJoin('positions', 'positions.id', '=', 'work_assignment_id')
			                                ->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
			                                ->leftJoin('companies', 'employees.company_id', '=', 'companies.id')
			                                ->select("dailytimerecords.id",
			                                	    "dailytimerecords.work_date",
			                                	    "dailytimerecords.shift",
			                                	    "dailytimerecords.time_in_am",
			                                	    "dailytimerecords.time_out_am",
			                                	    "dailytimerecords.time_in_pm",
			                                	    "dailytimerecords.time_out_pm",
			                                	    "dailytimerecords.work_assignment_id",
			                                	    "employees.lastname",
			                                	    "employees.firstname",
			                                	    "employees.middlename",
			                                	    "departments.id as department_id",
			                                	    "departments.name as department_name",
			                                	    "positions.name as position_name",
			                                	    "dailytimerecords.employee_id as employee_id",
			                                	    "companies.name as company_name");
		return $dtr->get();			        
			
	}

	public function timeDiff($in, $out, $shift='ds') {
		$conv_in = strtotime($in);
		$conv_out = strtotime($out);
		// echo '<br> Time in: ' . $in . ' ==== Out' . $out;  
		// echo '<br>' . (round(abs($conv_out - $conv_in) / 60,2) /60) .  '<br>';

		return (round(abs($conv_out - $conv_in) / 60,2) /60);
	}

	public function getNightPremiumHours($in, $out) {


		$in = explode(':',$in);
		$out = explode(':', $out);

		$__in= 0;
		$__out=0;
		
		if ($in && $out){
				
				
			// Check if time in is less than 10:00 PM
			// If it is, use 22:00 by default
			// Otherwise, use $in[0] value plus the (minutes / 60)
			if ($in[0] <= 22) {
				$__in = 22;
		
				if ($in[0] == 22) {
					$__in = 22 + $in[1]/60;
				}

			} else {
				$__in = $in[0] + $in[1]/60;
			}

			// Convert the time out into a continues number format
			// 12:00 = 24
			// 1:00 = 25
			// 2:00 = 26
			// 3:00 = 27
			// 4:00 = 28
			// 5:00 = 29
			// 6:00 = 30
			// 7:00 = 31
			// 8:00 = 32
			
			if ($out[0] >= 0 && $out[0] <= 8) {
				$out[0] += 24;
			}


				$np_10_3 = 0;
				$np_3_6 = 0;

			
			// Check if the time is valid between 11 PM and 10 AM
			if ($out[0] >= 23 && $out[0] <= 34) {

				// Check if time is greater than 6:00 PM or 30
				// If it is, use 30 as default otherwise use its default value plus the (minutes / 60)
				if ($out[0] > 30) {
					$out[0] = 30;

				} else {
					$out[0] = $out[0] + ($out[1] / 60);
				}


				// Over 3 Pm
				if ($out[0] >= 27) {
					$np_3_6 = abs( $out[0] - 27);
					$np_10_3 = 27 - $__in; 

			
				} else {


					if ($out[0] < 27) {
						$np_10_3 = $out[0] - $__in;

						// echo $out[0] . ' - ' .  $__in;
					}
				}

			} else {
				$np_10_3 = ($out[0] = $out[0] + ($out[1] / 60)) - $__in;
			}


				return ['np_10' => $np_10_3, 
				        'np_3' => $np_3_6];


		} 

		return false;
		
	}

	public function getWorkDayType($date) {
		$_date = new DateTime($date);
		$_week_day = $_date->format('D');
		$restday = false;
		$workday_type = "";

		// Check if it is a rest day
		if (in_array($_week_day, ['Sun'])) {	
			$restday = true;
		}

		// Check if it is a holiday or not
		$workday_type = DB::table($this->holidays_table)->where('holiday_date', '=', $date)->pluck('type');

		// Not a holiday
		if (is_null($workday_type) ) {
			return (!$restday) ? 'regular' : 'restday';
		} else { 
			// A holiday
			return (!$restday) ? $workday_type . '_holiday' : 'restday_with_' . $workday_type . '_holiday' ;
		}
	}
 
	public function getDayRate($hours_worked, $rate_per_hour) {
		return $hours_worked * $rate_per_hour;
	}

	public function getBasicPay($payrollObject) {

		foreach ($payrollObject as $key => $payroll) {
			# code...

			$employees = [];

			for ($i=0; $i < count($payroll); ++$i) { 
				# code...
				echo '<pre>';
				$payroll[$i]['basic_pay']; 
			}
		}

	}

	// Checks if we can still deduct salary
	public function canBeDeducted($amount, $deduction) {
		if ($amount >= $deduction) return true;

		return false; 
	}

	public function submitRemittance($type, $employee_id, $amount, $date,  $note ="" ) {

			// Check if a record already exists
			$exists = (int) DB::table('employees_deductions_contribution')->where('date', '=', $date)
			                                                       ->where('employee_id', '=', $employee_id)
			                                                       ->where('type', '=', $type)
			                                                       ->select(DB::raw('COUNT(*) as count'))
			                                                       ->pluck('count');
			// If not perform a query
			if ($exists == 0 && $amount != 0) {
				DB::table('employees_deductions_contribution')->insert(['type' => (string) $type,
					                                                    'employee_id' => (int) $employee_id,
					                                                    'amount' => (double) $amount,
					                                                    'date' => (string) $date,
					                                                    'note' => (string) $note,
					                                                    'created_at' => Carbon::now(),
					                                                    'updated_at' => Carbon::now() ]);
			}

			return false;
	}

	public function getPODeduction($employee_id, $type, $start_date, $end_date) {
		
		$po_deduction = 0;

		switch ($type) {
			case 'grocery':
				$table = $this->grocery_po_table;
				break;

			case 'pharmacy':
				$table = $this->pharmacy_po_table;
				break;

			case 'savings':
				$table = $this->savings_table;	
				break;

			case 'tickets':
				$table = $this->tickets_po_table;
				break;			
			default:
				$table = NULL;
				break;
		}
		if ($table == NULL ) return 0;


		$po_deduction = DB::table($table)->where(function($query) use($type, $employee_id, $start_date, $end_date) {
			
			$query->whereBetween('date', [$start_date, $end_date]);
			$query->where('employee_work_id', '=', $employee_id);				
			

		})->select( DB::raw('SUM(amount) as amt') )->pluck('amt');

		return (is_null($po_deduction)) ? 0 : $po_deduction;

	}

	public function getNetPay($obj, $period = array(), $save = true ) {
		$json_file = NULL;
		$memory_used = 0;
		$data = [];

		// Checks if date is valid
		if (!(isDateValid($period['start']) && $period['end'])) {
			return ['data' => [],
					'json' => NULL,
			        'message' => 'Invalid date.'];
		}

		$final_payroll = array();
		$grosspay = $deductions = 0;

		foreach ($obj as $key => $workInfo) {
			# code...
			$deduction_allowance = 0;
			$total_deductions = 0;
			$remainder = 0;
			$employee = $this->getEmployeeBasicInfo($key);

			// Adjustments
			$dr_adjustments = $this->getAdjustment($employee_id = $key, 'debit', $period['start'], $period['end']);
			$cr_adjustments = $this->getAdjustment($employee_id = $key, 'credit', $period['start'], $period['end']);
			
			$grosspay = $workInfo['basic_pay'] + $workInfo['overtime_pay'] +  $workInfo['night_premium'] + $workInfo['holiday_pay'] + ($cr_adjustments);
			
			$deduction_allowance = $grosspay * 0.50;


			// Employee Contributions
			$sss_contribution = $this->getContribution($grosspay, 'sss', 'ee');
			// var_dump($grosspay);
			$philhealth_contribution = $this->getContribution($grosspay, 'philhealth', 'ee'); 	
			$hdmf_contribution = $this->getContribution($grosspay, 'hdmf', 'ee');

			// Fixed Deductions			
			
			$health_care = $this->getFixedDeductions('health_care');
			$cbu = $this->getFixedDeductions('cbu');
			$pledge = $this->getFixedDeductions('pledge');
				

			// Imported Deductions
			$grocery = $this->getPODeduction($employee->employee_work_id, 'grocery', $period['start'], $period['end']);
			$pharmacy = $this->getPODeduction($employee->employee_work_id, 'pharmacy', $period['start'], $period['end']);
			$savings = $this->getPODeduction($employee->employee_work_id, 'savings', $period['start'], $period['end']);
			$tickets = $this->getPODeduction($employee->employee_work_id, 'tickets', $period['start'], $period['end']);
			$memberships = $this->getPODeduction($employee->employee_work_id, 'memberships', $period['start'], $period['end']);
			$ca = $this->getPODeduction($employee->employee_work_id, 'ca', $period['start'], $period['end']);


			// Loans
			$sss_loan = $this->getSSSloan_bill($key);

			$deductions_arr = ['health_care', 'cbu', 'pledge',
							   'dr_adjustments',
							   'sss_contribution', 'philhealth_contribution','hdmf_contribution',
			                   'grocery','pharmacy','savings','tickets', 'memberships', 'ca',
			                   'sss_loan'];

	

			
			for ($i=0; $i < count($deductions_arr); $i++) { 
				
				
				// Prioritized Deductions
				if ($i == 0) 
				{
					// Before subtracting deductions to grosspay, check first if grosspay is greater than deductions
					// If deductions are greater, any deductions will be set to 0
					if ($grosspay > ${ $deductions_arr[$i] }) 
					{
						$total_deductions += ${ $deductions_arr[$i] };
					} 
					else ${ $deductions_arr[$i] } = 0;
				}
				else
				{
					
					// Generate an allowance that would be left for employee on their netpay
					// 50% will be allocated for deductions if he had some.
					// Any deductions exceeding to 50% of grosspay will be set to 0
					$remainder = ($grosspay - $total_deductions) - $deduction_allowance;

					if ($remainder >= ${ $deductions_arr[$i] } ) 
					{
						$total_deductions += ${ $deductions_arr[$i] };
					} 
					else ${ $deductions_arr[$i] }  = 0;		

					
				}


			}




			


			// Total Deductions
			// $deductions = $sss_contribution +$philhealth_contribution + $hdmf_contribution;
			// $deductions += ($health_care + $cbu + $pledge) + ($dr_adjustments) + ($grocery + $savings + $pharmacy + $tickets + $memberships + $ca) ;
			// $deductions +=  $sss_loan;

			$deductions = $total_deductions;
				
				$final_payroll[$key] = ['grosspay' => $grosspay,
										'basic_pay' => $workInfo['basic_pay'],
										'overtime_pay' => $workInfo['overtime_pay'],
										'night_premium' => $workInfo['night_premium'],
				                        'deductions' => $deductions,
				                        'sss_contribution' => $sss_contribution,
				                        'philhealth_contribution' => $philhealth_contribution,
				                        'hdmf_contribution' => $hdmf_contribution,
				                        'health_care' => $health_care,
				                        'cbu' => $cbu,
				                        'pledge' => $pledge,
				                        'grocery' => $grocery,
				                        'pharmacy' => $pharmacy,
				                        'savings' => $savings,
				                        'tickets' => $tickets,
				                        'memberships' => $memberships,
				                        'ca' => $ca,
				                        'adjustment_dr' => $dr_adjustments,
				                        'adjustment_cr' => $cr_adjustments,
				                        'netpay' => $grosspay - $deductions,
				                        'days_worked' => $workInfo['days_worked'],
				                        'name' => $employee->lastname . ',' . $employee->firstname . ' ' . $employee->middlename,
				                        'employee_id' => $employee->employee_work_id,
				                        'incentives' => 0,
				                        'sss_loan' => $sss_loan,
				                        'hdmf_loan' => 0,
				                        'holiday' => $workInfo['holiday_pay'] ];

			    // <-------------- Remittances ----------------------->
				
				// Only save when requested
				if ($save) {

					// Save remittances required by the government
					$this->submitRemittance('sss', $key, $sss_contribution, $period['end']);
					$this->submitRemittance('philhealth', $key, $philhealth_contribution, $period['end']);
					$this->submitRemittance('hdmf', $key, $hdmf_contribution, $period['end']);

					// Save remittances required by the establishment
					$this->submitRemittance('health_care', $key, $health_care, $period['end']);
					$this->submitRemittance('cbu', $key, $cbu, $period['end']);	
					$this->submitRemittance('pledge', $key, $pledge, $period['end']);	

					// Save remittances of employees for their purchases and debt
					$this->submitRemittance('grocery', $key, $grocery, $period['end']);	
					$this->submitRemittance('savings', $key, $savings, $period['end']);
					$this->submitRemittance('pharmacy', $key, $pharmacy, $period['end']);
					$this->submitRemittance('tickets', $key, $pharmacy, $period['end']);
					$this->submitRemittance('memberships', $key, $pharmacy, $period['end']);
					$this->submitRemittance('ca', $key, $pharmacy, $period['end']);


					$this->sss_loan_remittance($key, $sss_loan);				
				// <-------------- Save Payroll data ----------------------->
				

				// Check first if the employee is already listed in previous payroll
				// To prevent duplications based on employee_id, start and end of period
				$countDB = DB::table('payroll')->where('employee_id', '=', $key)
				                              ->where('pay_period_start', '=',$period['start'])
				                              ->where('pay_period_end' ,'=', $period['end'])
				                              ->select(DB::raw('COUNT(*) as count'))
				                              ->pluck('count');
					 if ($countDB > 0) {
					 	continue;
					 } else {

						// Save the data	
						DB::table('payroll')->insert(['employee_id' => $key, 
							                          'pay_period_start' => $period['start'],
							                          'pay_period_end' => $period['end'],
							                          'days_worked' => $workInfo['days_worked'],
							                          'grosspay' => $grosspay,
							                          'deductions' => $deductions,
							                          'netpay' => $grosspay-$deductions,
							                          'date' => Carbon::now(),
							                          'created_at' => Carbon::now(),
							                          'updated_at' => Carbon::now()]);
					}
				}


		

		}

			// For history purposes
			// Since exporting the payroll to excel is essential
			// It would be alot faster to dump all data into a json file
			// So later when we use it, we dont need to query to database again
			// If a duplicate file is found, it will just overwrite it
			$json_file= $this->createJSON($final_payroll, $period['start'], $period['end']);			
	

		return [ 'data' => $final_payroll,
		         'json' => $json_file,
		         'memory_used' => (memory_get_peak_usage(true) / 1024 / 1024) ];

	}

	public function sss_loan_remittance($employee_id, $sss_loan) {

		// Only touch DB if sss loan is greater than 0
		if ($sss_loan > 0) {
		// var_dump('hello');
			$sss_loan_id = DB::table('sss_loans')->where('employee_id', '=', $employee_id)
			                      ->where('status', '=', 'open')
			                      ->pluck('id');



			 if ( $sss_loan_id && is_numeric($sss_loan_id) ) {
				
				$post_date = date('Y-m-d');


				DB::table('sss_loans_remittance')->insert([ 'sss_loan_id' => $sss_loan_id,
				                                 	        'amount' => $sss_loan,
				                                 	        'post_date' => $post_date,
				                                 	        'created_at' => Carbon::now(),
				                                 	        'updated_at' => Carbon::now(),
				                                 	        'remarks' => 'Automatically generated by the system during payroll process.'
				                                 	       ]);

			 }

		}

	} 

	public function employee_sss_loans($employee_id, $date) {
			
		if ( !isDateValid($start) ) {
			return false;
		}

		$formatted_date = new DateTime($date);
		$month = $formatted_date->format('m');
		$year = $formatted_date->format('Y');

		DB::table('sss_loans')->where('employee_id', '=', $employee_id)
		                      ->where(function($query) {

		                      		$query->where(DB::raw(' YEAR(salary_deduction_date) '), '=', $year );
		                      		$query->where(DB::raw(' MONTH(salary_deduction_date) '), '=', $month );
		                      	

		                      	});
	}

	

	/**  
	 * Creates a .JSON file of payroll
	 * GET /payroll/createJSON
	 *  @param $data   - The payroll object
	 *  @param $start  - Start of period
	 *  @param $end    - End of period
	 *
	 * @return string  - HTTP link of json file
	 */
	public function createJSON($data, $start, $end, $table="") {

		if (!(isDateValid($start) && isDateValid($end))) {
			return NULL;
		}
	
		$__start = str_replace('-', '_', $start);
		$__end = str_replace('-', '_', $end);

		$filename = 'payroll_for_' . $__start . '_to_' . $__end;
		$filepath = public_path() .'/json/' . $filename .'.json';
	
		$fp = fopen($filepath, 'w');
		   	  fwrite($fp, json_encode($data));
			  fclose($fp);	


		try {

		} catch (Exception $e) {
			if (is_readable($filepath)) {
				unlink($filepath);
			}
		}
		

		return asset('/json/' . $filename .'.json');
	}	


}
