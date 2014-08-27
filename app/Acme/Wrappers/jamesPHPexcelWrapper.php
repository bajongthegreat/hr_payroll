<?php

// phpExcel Wrapper for Laravel based HR and Payroll 
// By: James Norman Mones Jr. 


class jamesPHPexcelWrapper {
	
	protected $objPHPExcel;

	protected $last_row_index = 1;
	protected $filename;


	public function __construct($obj) {

		// Create new PHPExcel object
		$this->objPHPExcel = $obj;


		$this->filename = sha1(rand(1,500) . '-' . 'A' . rand(1,50000));
	}

	/**
	 * Setup the basic informations of Excel
	 *
	 * @return $this
	 */
	public function setUp($description, $category) {
		


		// Set document properties
		$this->objPHPExcel->getProperties()->setCreator("James Norman Mones Jr.")
									 ->setLastModifiedBy("James Norman Mones Jr.")
									 ->setTitle(Config::get('company.name.full') . ' ' . '('.  Config::get('company.name.acro') .')' )
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription($description)
									 ->setKeywords("office 2007 openxml php payroll")
									 ->setCategory($category);

		return $this;

	}


	
	/**
	 * Set the title before the table data
	 *
	 * @return $this
	 */
	public function setHeader($headers = array(), $counter=1, $start_col_letter='A', $last_col_letter = 'H' ) {
				

			$style = array(
			        'alignment' => array(
			            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			       		 )
			         );

			foreach ($headers as $header) {
				# code...
				

				// Set row value
				$this->objPHPExcel->getActiveSheet()->setCellValue($start_col_letter . $counter, $header);

				// Merge cells
				$this->objPHPExcel->getActiveSheet()
			                      ->mergeCells($start_col_letter . $counter .':' . $last_col_letter . $counter);

			    // Align to center
				$this->objPHPExcel->getActiveSheet()->getStyle($start_col_letter . $counter .':' . $last_col_letter . $counter)
										            ->getAlignment()
			  								        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


				$counter ++;
			}

			$this->last_row_index = $counter;

			return $this;
	}


	// Set headers for our data
	/**
   * @param array $tableHeaders The header of the table 
   * @param int $last_row_index Last row pointer of cell
   *
   * @return PhpExcelObject
   */
	public function setTableHeader( $tableHeaders = array(), $last_row_index = NULL) {
		
		$header_starting_index = is_null($last_row_index) ? $this->last_row_index + 1 : $last_row_index;
		$last_index = $header_starting_index - 1;

		$this->objPHPExcel->setActiveSheetIndex(0);

		if (is_array($tableHeaders)) {

			// Get the set of column letters based on specified column count
			$column_letter_array =  $this->getColumnLetterArray($tableHeaders);


			try {
				
				$i = $last_index;

				foreach ($tableHeaders as $key => $value) {
					$i++;

					$this->objPHPExcel->getActiveSheet()->setCellValue($column_letter_array[$key]  . ($last_index + 1) , $value);
					
				}

			$this->objPHPExcel->getActiveSheet()->getStyle('A' . $header_starting_index .':'. end($column_letter_array) . $header_starting_index)
				    				      ->getAlignment()
				    				      ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
				    				      ->setWrapText(true);


			} catch (Exception $e) {
				echo $e->getMessage() . '<br>';
				echo $e->getLine() . '<br>';
				echo $e->getTrace() . '<br>';
			}

		}

		$this->last_row_index = $header_starting_index;	

		return $this;
	}

	// Set data for our table
	/**
   * @param array $data The data of the table 
   * @param array $data_key List of array indexes to use 
   * @param int $last_row_index Last row pointer of cell
   * @param bool $include_index If include index in every first cell of the row
   *
   * @return PhpExcelObject
   */
	public function setData($data = array(), $data_key = array() ,$last_index = 1, $include_index = true) {

		// Allow custom starting point
		$i= ($last_index != 1) ? $last_index: $this->last_row_index + 1;

		// Get the set of column letters based on specified column count
		$column_letter_array =  $this->getColumnLetterArray($data_key);

		// If data is empty
		if (count($data) == 0) {
			$i+1;
					$this->objPHPExcel->getActiveSheet()->setCellValue('A'. $i, "No record for this month.");
					$this->objPHPExcel->getActiveSheet()->mergeCells('A'. $i .':H' . $i );

					$this->objPHPExcel->getActiveSheet()->getStyle('A'. $i .':H' . $i)
												  ->getAlignment()
										          ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		} else {


			// Begin Loop
			foreach($data as $id => $content) {
					
				if (is_object($content)) {
					$content = (array) $content;
					$content['i'] = ($last_index != 1) ? ($i - $last_index) : ($i - $this->last_row_index);
					$content['__'] = "";
					$content['_n'] = 0;
				}

					
				for ($j=0; $j < count($data_key); $j++) { 
					# code...
					
					// Please accept concatenation

					$content_value = is_null($content[ $data_key[$j] ]) ? '-' : $content[ $data_key[$j] ];
 					$this->objPHPExcel->getActiveSheet()->setCellValue($column_letter_array[$j] . $i, $content_value);
				
				}

				$i++;
				
			}


					$this->objPHPExcel->getActiveSheet()->getStyle('F1:F'.$this->objPHPExcel->getActiveSheet()->getHighestRow())
											  	  ->getAlignment()->setWrapText(true); 
 
  			  	    $this->objPHPExcel->getActiveSheet()->getStyle('B1:B'.$this->objPHPExcel->getActiveSheet()->getHighestRow())
 									      	      ->getAlignment()->setWrapText(true); 


		}

		return $this;
	}
	

	public function setColumnWidth($widths = array() ) {
 
			$column_letter_array = $this->getColumnLetterArray($widths);

			try {

				for ($i=0; $i< count($widths); $i++) {
						$this->objPHPExcel->getActiveSheet()->getColumnDimension( $column_letter_array[$i] )->setWidth($widths[$i]);
				}

				
			} catch (Exception $e) {

				echo $e->getMessage() . '<br>';
				


			}
	
		return $this;

	}

	public function setNumberFormat($format, $start_col, $end_col, $index) {

		$range = range($start_col, $end_col);

		switch ($format) {
			case 'comma':
				$format = PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1;
				break;
			
			default:
			break;
		}

		foreach ($range as $letter) {
				
			$col = $letter . '1:' . $letter . $index;

			$this->objPHPExcel->getActiveSheet()->getStyle($col)
		                                        ->getNumberFormat()
		                                        ->setFormatCode($format);
		}


		return $this;
	}	

	protected function getColumnLetterArray($arr) {

			$column_count = count($arr);

			$multiplier = 1;

			$alphabet = range('A', 'Z');
			$alphabet_container = array();

			// Determine how many times we loop through each set of letters
			if ($column_count > 26) {
				$multiplier = round($column_count/26);
			}

			// Loop through a set of letters based on the specified multiplier
			for ($i=0; $i < $multiplier; $i++ ) {

				foreach ($alphabet as $key => $letter) {
	
					// If the column count doesn't reach to the amount of alphabet letters
					// Stop the function

					if ($column_count < 26) {
						if ($key == $column_count) {
							break;
						}
					}

					// Check if alphabet container has a value
					// If it has, concatenate the previous value with the current value
					// and let it have its own index
					if (!isset($alphabet_container[$key])) {
						$alphabet_container[$key] = $letter;
					} else {
						$alphabet_container[] = $alphabet_container[$i -1] . $letter; 
					}
				}

				// Deduct total alphabet count each loop
				$column_count -= 26;	
			}
			return $alphabet_container;
	}

	public function timestamp($format = 'default') {
		
		switch ($format) {
			case 'date':
				$this->filename .= '_' . date('Y_m_d');
				break;
			
			default:
				$this->filename .= '_' . date('Y_m_d_H_i_s');
				break;
		}
		
		return $this;

	}
	public function setFileName($filename) {

		$this->filename = $filename;

		return $this;
	}

	public function setHTMLheaders() {
				// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $this->filename .'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		return $this;
	}


	public function get($sheet_index=0) {
		$this->objPHPExcel->setActiveSheetIndex($sheet_index);
		
		return $this->objPHPExcel;
	}

	public function save($sheet_type = "Excel2007", $location = "php://output") {
		
			$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, $sheet_type);

			return $objWriter->save($location);
	}

}