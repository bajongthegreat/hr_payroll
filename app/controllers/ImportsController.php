<?php

class ImportsController extends \BaseController {

	protected $allowedTables = ['employees'];
	protected $default_uri = 'import';
	protected $db_fields;

	public function __construct() {
	    	parent::__construct();
	}

	// Upload the excel file
	public function upload() {

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		
		 if (Input::hasFile('file')) 
      	  { 
            $file = Input::file('file');
            

            $extension = $file->getClientOriginalExtension();
            $fileName = date('Y') . date('m') . '-' . sha1($file->getClientOriginalName() . '-' .rand(1,99999)) . ".$extension";
 
 			 $destinationPath = 'imports';

            // Move the file
            $file->move($destinationPath, $fileName);

            $uploaded_location = $destinationPath . '/' . $fileName;
            $status = 'success';

           return Response::json(['file_loc' => asset($uploaded_location), 
           							'status' => $status, 
           							'file_name' => $fileName, 
           							'type' => 'import',
           							'file_path' => $destinationPath . '\\' . $fileName ]);
        }
	}

// 	public function start() {

// 		$file = Input::get('file');
// 		$values = [];

// 		/** automatically detect the correct reader to load for this file type */
// 		$excelReader = PHPExcel_IOFactory::createReaderForFile($file);

// 		/** Create a reader by explicitly setting the file type.
// 		// $inputFileType = 'Excel5';
// 		// $inputFileType = 'Excel2007';
// 		// $inputFileType = 'Excel2003XML';
// 		// $inputFileType = 'OOCalc';
// 		// $inputFileType = 'SYLK';
// 		// $inputFileType = 'Gnumeric';
// 		// $inputFileType = 'CSV';
// 		$excelReader = PHPExcel_IOFactory::createReader($inputFileType);
// 		*/

// 		// ----------- Reader options
// 		//if we dont need any formatting on the data
// 		$excelReader->setReadDataOnly();

// 		//load only certain sheets from the file
// 		// $loadSheets = array('Sheet1');
// 		// $excelReader->setLoadSheetsOnly($loadSheets);

// 		// //the default behavior is to load all sheets
// 		// $excelReader->setLoadAllSheets();



// 		// $highestColumm = $excelReader->getActiveSheet()->getHighestColumn();
// 		// $highestRow = $excelReader->getActiveSheet()->getHighestRow();

// 		// Chunks
// 		/** Define how many rows we want to read for each "chunk" **/
// 		$chunkSize = 500;

// 		/** Loop to read our worksheet in "chunk size" blocks **/
// 		for ($startRow = 1; $startRow <= 5000; $startRow += $chunkSize) {

// 			echo 'Loading WorkSheet using configurable filter for headings row 1 and for rows ',$startRow,' to ',($startRow+$chunkSize-1),'<br />';
	

// 		/** Create a new Instance of our Read Filter **/
// 		$chunkFilter = new Acme\Extension\chunkReadFilter($startRow, $chunkSize);

// 		/** Tell the Reader that we want to use the Read Filter **/
// 		$excelReader->setReadFilter($chunkFilter);
		
// 		/** Tell the Read Filter which rows we want this iteration **/
// 		// $chunkFilter->setRows($startRow, $chunkSize);
		
// 		/** Load only the rows that match our filter **/
// 		$excelObj = $excelReader->load($file);


// 		$sheetData = $excelObj->getActiveSheet()->toArray(null,true,true,true);
// 		// Do some processing here - the $data variable will contain an array which is always limited to 2048 elements regardless of the size of the entire sheet

// 			if ($startRow == 1) {
// 				$this->db_fields = $this->getDBKeys($sheetData);	
// 			}
			
// 			// var_dump($this->db_fields);
// 			$convertedValue = $this->convertValuesAndFieldsToDBArray($this->db_fields, $sheetData, true);
// 			DB::transaction(function() use ($convertedValue) {
// 				try{
// 				DB::table('employees')->insert($convertedValue);
// 				} catch(Exception $e) {
// 					var_dump($e->getMessage());
// 					DB::rollback();
// 				}	
// 			});
			

// 			// var_dump(['-----------------------------------']);
// 			// var_dump(count($convertedValue));

		
		
		 
// 		 $excelObj->disconnectWorksheets(); 
//    		 unset($excelObj);
// 		}

// 	}

// 	public function getDBKeys($data) {

// 		$fields = [];

// 		foreach ($data as $key => $value) {
// 			if ($key == 1) {

// 				foreach ($value as $k => $v) {
// 					# code...
// 					if ($v == NULL) continue;
// 					$fields[] = $v;
// 				}			
// 			}

// 		}

// 		return $fields;
// 	}
	

// public function convertValuesAndFieldsToDBArray($fields, $values, $include_blank = false) {

// 		$temp = array();

		

// 		foreach ($values as $key => $value) {

// 			// Since we ommited the first row as a db field, lets deduct the index so we could have an index starting at number 1.
// 			if ($key == 1) continue;

// 			$i =0;

// 			if (count($value) == 0) continue;

// 			foreach ($value as $k => $v) {


// 					if ($include_blank == false) {
// 						if ($value[$k] == "") {

// 							 continue;
// 						}
						
// 					}

// 					if (!isset($fields[$i])) continue;
// 					if ($fields[$i] == 'employee_work_id' && $value[$k] == "") {
// 						continue;
// 					} else {
// 						$temp[$key][$fields[$i]] =  $value[$k];			
					
// 					}
// 									++$i;

// 			}
			
// 		}

// 		return $temp;
// 	}

	// Start importation process
	public function start() {

		// var_dump(Input::all());
		$jExcel = App::make('Acme\Extension\jExcel');
		$file = Input::get('file');

		// Check if that table is in our list that is available and prepared for importation
		$table = (in_array(Input::get('importFor'), $this->allowedTables)) ? Input::get('importFor') : NULL;

		if ($table === NULL) {
			throw new Exception("Table is not valid. Please do it again.", 101);
		}	

		// Load the file
		if (!$u_status = $jExcel->loadFile( $file ) ) {

			$excelLoadStatus =  json_encode($u_status);
		}

		// Delete File
		// if (is_readable( $file )) {
		// 		unlink($file);
		// 	}

		// Process the excel file and grab the cell valuess
		$jExcel->getFieldAndValues();
		$message = "<br>";
		$message .= '<div><strong> Getting database field values </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';



		$data = $jExcel->convertValuesAndFieldsToDBArray(true);
		$message .= '<div> <strong>After converting values </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n </div>";
		
		$status = false;		
		// var_dump($data);				

		// // Save to database
		DB::transaction(function() use($jExcel, $data, &$message) {
			try {

				// 		// print json_encode($data);
			DB::table('employees')->insert($data);

				// var_dump($count);
				$message .= '<div> <strong>Inserting data </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';
			
			} catch (Exception $e) {
				// echo $e->getMessage();
				$error = $e->getMessage();
				$message .= '<div> <strong>Rolling back due to some problems: </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';
			
				$status = false;
				$error = "Failed to process data.";
				DB::rollback();
			}	
		});

		// Free up memory
		// $jExcel->disconnectWorksheets();
		$jExcel->throwGarbage();

		$message .= '<div> <strong> Garbage collection </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';
			
		return Response::json(['memory_log' => $message,
			                  'rows_affected' => count($data),
			                  'status' => ($status == true) ? 'success' : 'failed',
			                  'error' => (isset($error)) ? $error : NULL ] );
	}

	public function create() {
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		return View::make('imports.create');
	}

}