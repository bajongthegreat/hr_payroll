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
	        // $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->payroll = $payroll;	                                                                                                                                  
	        
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /payroll
	 *
	 * @return Response
	 */
	public function index() {
		return $this->process();
		// return View::make('payroll.index');
	}


	public function process()
	{

		$start_date =  Input::get('start_date');
		$end_date = Input::get('end_date');

		$company_id = (int) Input::get('company_id');

		if ($start_date == '' || $end_date == '') {

		} else {




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
				// echo '<br>' . $hours_worked . '<br>';

				// Get rate object
				$rate = $this->payroll->getRateByWorkAssignment($obj_dtr->work_assignment_id, $work_type);

				
				if ($obj_dtr->shift == 'ns' ){
					
					// Out
					if($obj_dtr->time_out_am == '00:00' && $obj_dtr->time_in_am == '00:00') {
						$out = $obj_dtr->time_out_pm;
					} else {
						$out = $obj_dtr->time_out_am;
					}

					$night_premium_arr = $this->payroll->getNightPremiumHours($obj_dtr->time_in_pm, $out);

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

				if (in_array($work_type, ['regular_holiday', 'special_holiday', 'regular_holiday_with_restday']))
				{
					$basic_rate = $this->payroll->getRateByWorkAssignment($obj_dtr->work_assignment_id, 'regular');
					
					$basic_pay = $hours_worked * $basic_rate->rate;
					$holiday_pay = $basic_rate->rate * 8;


				} else {
					$basic_pay = $hours_worked * $rate->rate;
					$holiday_pay = 0;
				}

				// var_dump($hours_worked);
				// var_dump($overtime);
				
				// // Make an object and store all required data for the next processing

				$payroll_data_container[$obj_dtr->employee_id] = [   'days_worked' => 1 + (isset($payroll_data_container[$obj_dtr->employee_id]['days_worked']) ? $payroll_data_container[$obj_dtr->employee_id]['days_worked'] : 0),
																	 'overtime_pay' => $overtime_pay + (isset($payroll_data_container[$obj_dtr->employee_id]['overtime_pay']) ? $payroll_data_container[$obj_dtr->employee_id]['overtime_pay'] : 0),
																	 'night_premium' => round($night_premium, 2) + (isset($payroll_data_container[$obj_dtr->employee_id]['overtime_pay']) ? $payroll_data_container[$obj_dtr->employee_id]['night_premium'] : 0),
																	 'basic_pay' => ($basic_pay) + (isset($payroll_data_container[$obj_dtr->employee_id]['basic_pay']) ? $payroll_data_container[$obj_dtr->employee_id]['basic_pay'] : 0),
																	 'holiday_pay' => ($holiday_pay) + (isset($payroll_data_container[$obj_dtr->employee_id]['holiday_pay']) ? $payroll_data_container[$obj_dtr->employee_id]['holiday_pay'] : 0)																];


			}
			
		
			// echo '<pre>';
			// var_dump($payrolldata);

			if (Request::ajax() || Input::get('output') == 'json'){
				$payrolldata = $this->payroll->getNetPay($payroll_data_container, ['start' => $start_date,
					                                                 			   'end' => $end_date]);

				return Response::json( $payrolldata );	
			} elseif (Input::get('output') == 'excel') {
						$payrolldata = $this->payroll->getNetPay($payroll_data_container, ['start' => $start_date,
					                                                 			   'end' => $end_date], true);
				return $this->deliverExcel( $payrolldata, $start_date, $end_date);
			}
		}

		
		// return View::make('payroll.index');
	}

	public function export() {

		$file = json_decode(Input::get('file'));
		$start = Input::get('start');
		$end =  Input::get('end');

		// Open the file via HTTP not in direct file directory, for security purposes
		$data = json_decode(@file_get_contents($file));
	
		if (count($data) == 0) return '';

		return $this->deliverExcel( (array) $data, $start,$end);
	}

	public function deliverExcel($data, $start,$end) {

	if (PHP_SAPI == 'cli')
		die('This example should only be run from a Web Browser');

	/** Include PHPExcel */
	// require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

	$start = new DateTime($start);
	$end = new DateTime($end);

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator("James Norman Mones Jr.")
								 ->setLastModifiedBy("James Norman Mones Jr.")
								 ->setTitle("CONSOLIDATED PAYROLL for JUNE 01 TO 14, 2014")
								 ->setSubject("Office 2007 XLSX Test Document")
								 ->setDescription("CONSOLIDATED PAYROLL for JUNE 01 TO 14, 2014 generated by HR and Payroll System.")
								 ->setKeywords("office 2007 openxml php payroll")
								 ->setCategory("Payroll");

	$objPHPExcel->getActiveSheet()->setCellValue('A1', "TIBUD SA KATIBAWASAN MULTI-PURPOSE COOPERATIVE");
	$objPHPExcel->getActiveSheet()->setCellValue('A2', "CONSOLIDATED PAYROLL");
	$objPHPExcel->getActiveSheet()->setCellValue('A3', $start->format('F d') . ' TO ' . $end->format('F d') . ' ' . $end->format('Y') );
	
	// Add some data
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('A5', "ID Number");
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Name");
	$objPHPExcel->getActiveSheet()->setCellValue('C5', "Ndays");
	$objPHPExcel->getActiveSheet()->setCellValue('D5', "Basic");
	$objPHPExcel->getActiveSheet()->setCellValue('E5', "Incentive");
	$objPHPExcel->getActiveSheet()->setCellValue('F5', "Overtime");
	$objPHPExcel->getActiveSheet()->setCellValue('G5', "NPremium");
	$objPHPExcel->getActiveSheet()->setCellValue('H5', "Holiday");
	$objPHPExcel->getActiveSheet()->setCellValue('I5', "Adjustment");
	$objPHPExcel->getActiveSheet()->setCellValue('J5', "Grosspay");
	$objPHPExcel->getActiveSheet()->setCellValue('K5', "HDMF");
	$objPHPExcel->getActiveSheet()->setCellValue('L5', "SSS");
	$objPHPExcel->getActiveSheet()->setCellValue('M5', "PHIC");
	$objPHPExcel->getActiveSheet()->setCellValue('N5', "SSS Loan");
	$objPHPExcel->getActiveSheet()->setCellValue('O5', "HDMF Loan");
	$objPHPExcel->getActiveSheet()->setCellValue('P5', "Health Care");
	$objPHPExcel->getActiveSheet()->setCellValue('Q5', "CBU");
	$objPHPExcel->getActiveSheet()->setCellValue('R5', "Pledge");
	$objPHPExcel->getActiveSheet()->setCellValue('S5', "Pharmacy");
	$objPHPExcel->getActiveSheet()->setCellValue('T5', "Ticket");
	$objPHPExcel->getActiveSheet()->setCellValue('U5', "Grocery");
	$objPHPExcel->getActiveSheet()->setCellValue('V5', "Savings");
	$objPHPExcel->getActiveSheet()->setCellValue('W5', "Adjustment");
	$objPHPExcel->getActiveSheet()->setCellValue('X5', "Netpay");






	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Payroll');
	$objPHPExcel->getActiveSheet()->freezePane('A5');


	$i=6;
	foreach($data as $id => $employee) {

		if (is_array($employee)) {


		$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $employee['employee_id'])
		                              ->setCellValue('B' . $i, $employee['name'])
		                              ->setCellValue('C' . $i, $employee['days_worked'])
		                              ->setCellValue('D' . $i, $employee['basic_pay'])
		                              ->setCellValue('E' . $i, $employee['incentives'])
		                              ->setCellValue('F' . $i, $employee['overtime_pay'])
		                              ->setCellValue('G' . $i, $employee['night_premium'])
		                              ->setCellValue('H' . $i, $employee['holiday'])
		                              ->setCellValue('I' . $i, $employee['adjustment_dr'])
		                              ->setCellValue('J' . $i, $employee['grosspay'])
		                              ->setCellValue('K' . $i, $employee['hdmf_contribution'])
		                              ->setCellValue('L' . $i, $employee['sss_contribution'])
		                              ->setCellValue('M' . $i, $employee['philhealth_contribution'])
		                              ->setCellValue('N' . $i, $employee['sss_loan'])
		                              ->setCellValue('O' . $i, $employee['hdmf_loan'])
		                              ->setCellValue('P' . $i, $employee['health_care'])
		                              ->setCellValue('Q' . $i, $employee['cbu'])
		                              ->setCellValue('R' . $i, $employee['pledge'])
		                              ->setCellValue('S' . $i, $employee['pharmacy'])
		                              ->setCellValue('T' . $i, $employee['tickets'])
		                              ->setCellValue('U' . $i, $employee['grocery'])
		                              ->setCellValue('V' . $i, $employee['savings'])
		                              ->setCellValue('W' . $i, $employee['adjustment_cr'])
		                              ->setCellValue('X' . $i, $employee['netpay']);
		} elseif (is_object($employee)) {

		$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $employee->employee_id)
		                              ->setCellValue('B' . $i, $employee->name)
		                              ->setCellValue('C' . $i, $employee->days_worked)
		                              ->setCellValue('D' . $i, $employee->basic_pay)
		                              ->setCellValue('E' . $i, $employee->incentives)
		                              ->setCellValue('F' . $i, $employee->overtime_pay)
		                              ->setCellValue('G' . $i, $employee->night_premium)
		                              ->setCellValue('H' . $i, $employee->holiday)
		                              ->setCellValue('I' . $i, $employee->adjustment_dr)
		                              ->setCellValue('J' . $i, $employee->grosspay)
		                              ->setCellValue('K' . $i, $employee->hdmf_contribution)
		                              ->setCellValue('L' . $i, $employee->sss_contribution)
		                              ->setCellValue('M' . $i, $employee->philhealth_contribution)
		                              ->setCellValue('N' . $i, $employee->sss_loan)
		                              ->setCellValue('O' . $i, $employee->hdmf_loan)
		                              ->setCellValue('P' . $i, $employee->health_care)
		                              ->setCellValue('Q' . $i, $employee->cbu)
		                              ->setCellValue('R' . $i, $employee->pledge)
		                              ->setCellValue('S' . $i, $employee->pharmacy)
		                              ->setCellValue('T' . $i, $employee->tickets)
		                              ->setCellValue('U' . $i, $employee->grocery)
		                              ->setCellValue('V' . $i, $employee->savings)
		                              ->setCellValue('W' . $i, $employee->adjustment_cr)
		                              ->setCellValue('X' . $i, $employee->netpay);

		}
		++$i;
	}


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);


	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Payroll-for-period-2014.xlsx"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// If you're serving to IE over SSL, then the following may be needed
	header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
	header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	header ('Pragma: public'); // HTTP/1.0

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	 return $objWriter->save('php://output');
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