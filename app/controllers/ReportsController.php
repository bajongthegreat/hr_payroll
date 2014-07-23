<?php

class ReportsController extends BaseController {

	protected $employees;

	  /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        $this->afterFilter('log', array('only' =>
                            array('fooAction', 'barAction')));

        $this->employees = App::make('Acme\Repositories\Employee\EmployeeRepositoryInterface');
    }

    public function index() {
    


    }

    public function create_dpc_excel() {
    		$month = 7; 

    	$data = DB::table('disciplinary_actions')->where(DB::raw('MONTH(violation_date)'), '=', $month)
    									 ->whereNull('disciplinary_actions.deleted_at')
    	                                 ->leftJoin('employees', 'employees.id', '=', 'disciplinary_actions.employee_id')
    	                                 ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
    	                                 ->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
    	                                 ->leftJoin('violations', 'violations.id', '=', 'disciplinary_actions.violation_id')
    	                                 ->select('employees.lastname', 'employees.firstname', 'employees.middlename', 'employees.name_extension',
    	                                 	       'departments.name as department_name', 'positions.name as position_name', 'disciplinary_actions.violation_date', 'disciplinary_actions.violation_effectivity_date', 'violations.code as violation_code', 'violations.description as violation_description', DB::raw('COUNT(*) as offense__number ') ,DB::raw('(SELECT punishment_type FROM violations_offenses WHERE violations_offenses.violation_id = violations.id AND offense_number = (SELECT COUNT(*) FROM disciplinary_actions WHERE violation_id = violations.id AND employee_id = employees.id AND MONTH(disciplinary_actions.violation_date) = ' . $month .' ) ) as penalty'))
    	                                 ->groupBy('disciplinary_actions.employee_id', 'violations.id', 'disciplinary_actions.violation_date')
    	                                 ->get();

    	return $this->dpc($data, $month);
    }



    public function employee_index() {
    	return View::make('reports.employee.index');
    }

    public function dpc($data, $month) {

    	$type = 'Yearly';

    	$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F'); // March
    	

				// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("James Norman Mones Jr.")
									 ->setLastModifiedBy("James Norman Mones Jr.")
									 ->setTitle("Tibud Sa Katibawasan Multi-Purpose Cooperative (TSKMPC)")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("DPC Monitoring Sheet (Yearly).")
									 ->setKeywords("office 2007 openxml php payroll")
									 ->setCategory("Payroll");

		$objPHPExcel->getActiveSheet()->setCellValue('A1', "TIBUD SA KATIBAWASAN MULTI-PURPOSE COOPERATIVE");
		$objPHPExcel->getActiveSheet()->setCellValue('A2', "Purok Rañada, Brgy. Poblacion, Polomolok, South Cotabato");
		$objPHPExcel->getActiveSheet()->setCellValue('A3', "CDA Registration No. 9520-12008158; Tel. No. (083) 500-8467");

		$objPHPExcel->getActiveSheet()->setCellValue('A5', "DISCIPLINARY ACTIONS MONITORING SHEET");

		$objPHPExcel->getActiveSheet()->setCellValue('A7', "FOR THE MONTH OF " . $monthName);


        $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');

		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')
	    ->getAlignment()
	    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



		$objPHPExcel->getActiveSheet()->getStyle('A2:H2')
	    ->getAlignment()
	    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$objPHPExcel->getActiveSheet()->getStyle('A3:H3')
	    ->getAlignment()
	    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(60);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		


		// ================================ Starts here ==========================
		$header_starting_index =  9;


		// Add some data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $header_starting_index, "");
		$objPHPExcel->getActiveSheet()->setCellValue('B' . $header_starting_index, "Employee Name");
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $header_starting_index, "Department");
    	
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $header_starting_index, "Date of Violation");
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $header_starting_index, "Effectivity Date for Suspension");
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $header_starting_index, "Violation Description");
		$objPHPExcel->getActiveSheet()->setCellValue('G' . $header_starting_index, "Code of Conduct Reference");
		$objPHPExcel->getActiveSheet()->setCellValue('H' . $header_starting_index, "Penalty");

		$objPHPExcel->getActiveSheet()->getStyle("A$header_starting_index:H$header_starting_index")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle("A" . ($header_starting_index-2).  ":H" . ($header_starting_index-2) )->getFont()->setBold(true);
		

		$objPHPExcel->getActiveSheet()->getStyle('A' . $header_starting_index .':J'. $header_starting_index)
    				->getAlignment()->setWrapText(true);

		$objPHPExcel->getActiveSheet()->getStyle('A'. $header_starting_index.':H' . $header_starting_index)
	   			                      ->getAlignment()
	    							  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 		
		

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Employee Masterlist');


		$i= $header_starting_index + 1;

		// If data is empty
		if (count($data) == 0) {
					$objPHPExcel->getActiveSheet()->setCellValue('A'. $i, "No record for this month.");
					$objPHPExcel->getActiveSheet()->mergeCells('A'. $i .':H' . $i );

					$objPHPExcel->getActiveSheet()->getStyle('A'. $i .':H' . $i)
												  ->getAlignment()
										          ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		}

		// Begin Loop
		foreach($data as $id => $content) {

			if (is_array($content)) {


			$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $employee['employee_work_id'])
			                              ->setCellValue('B' . $i, $employee['lastname'])
			                              ->setCellValue('C' . $i, $employee['firstname'])
			                              ->setCellValue('D' . $i, $employee['middlename'])
			                              ->setCellValue('E' . $i, $employee['name_extension']);
			} elseif (is_object($content)) {

			$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, ($i- $header_starting_index))
			                              ->setCellValue('B' . $i, $content->lastname . ' ,' . $content->firstname . ' ' . $content->middlename)
			                              ->setCellValue('C' . $i, ($content->department_name != "") ? $content->department_name : 'N/A')
			                              ->setCellValue('D' . $i, ($content->violation_date != "") ? $content->violation_date :'N/A' )
			                              ->setCellValue('E' . $i, ($content->violation_effectivity_date != "") ? $content->violation_effectivity_date :'N/A' )
			                              ->setCellValue('F' . $i, ($content->violation_description != "") ? $content->violation_description :'N/A' )
			                              ->setCellValue('G' . $i, ($content->violation_code != "") ? $content->violation_code :'N/A' )
			                              ->setCellValue('H' . $i, ($content->penalty != "") ? $content->penalty :'N/A' );
			}
			++$i;
		}


		$objPHPExcel->getActiveSheet()->getStyle('F1:F'.$objPHPExcel->getActiveSheet()->getHighestRow())
  	  ->getAlignment()->setWrapText(true); 

  	  $objPHPExcel->getActiveSheet()->getStyle('B1:B'.$objPHPExcel->getActiveSheet()->getHighestRow())
  	  ->getAlignment()->setWrapText(true); 

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="DPC.xlsx"');
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

    public function create_employee_masterlist_excel() {
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
	$objPHPExcel->getActiveSheet()->setCellValue('A2', "Employee Masterlist");

	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);

	// Add some data
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('A5', "ID Number");
	$objPHPExcel->getActiveSheet()->setCellValue('B5', "Last Name");
	$objPHPExcel->getActiveSheet()->setCellValue('C5', "First Name");
	$objPHPExcel->getActiveSheet()->setCellValue('D5', "Middle Name");
	$objPHPExcel->getActiveSheet()->setCellValue('E5', "Name Extension");

	$objPHPExcel->getActiveSheet()->getStyle("A5:E5")->getFont()->setBold(true);
	
	$style = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

	$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
	$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
	$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');

	$objPHPExcel->getActiveSheet()->getStyle('A1:X1')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



	$objPHPExcel->getActiveSheet()->getStyle('A2:E2')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


	$objPHPExcel->getActiveSheet()->getStyle('A3:E3')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('Employee Masterlist');


	$data = $this->employees->all();

	$i=6;
	foreach($data as $id => $employee) {

		if (is_array($employee)) {


		$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $employee['employee_work_id'])
		                              ->setCellValue('B' . $i, $employee['lastname'])
		                              ->setCellValue('C' . $i, $employee['firstname'])
		                              ->setCellValue('D' . $i, $employee['middlename'])
		                              ->setCellValue('E' . $i, $employee['name_extension']);
		} elseif (is_object($employee)) {

		$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $employee->employee_work_id)
		                              ->setCellValue('B' . $i, $employee->lastname)
		                              ->setCellValue('C' . $i, $employee->firstname)
		                              ->setCellValue('D' . $i, $employee->middlename)
		                              ->setCellValue('E' . $i, $employee->name_extension);

		}
		++$i;
	}


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);

	$creation_date = date('Y_m_d');

	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Employee Masterlist_' . $creation_date .'.xlsx"');
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

}
