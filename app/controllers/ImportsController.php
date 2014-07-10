<?php

class ImportsController extends \BaseController {

	protected $allowedTables = ['employees', 'employees_grocery_po', 'employees_pharmacy_po', 'employees_savings','employees_tickets'];
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
            $fileName = date('Y') . date('m') . '-' . sha1($file->getClientOriginalName() . '-' .rand(1,99999)) . '_' . $file->getClientOriginalName();
 
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

	// Start importation process
	public function start() {

		// var_dump(Input::all());
		$jExcel = App::make('Acme\Extension\jExcel');
		$file = Input::get('file');

		// Check if that table is in our list that is available and prepared for importation
		$table = (in_array(Input::get('importFor'), $this->allowedTables)) ? Input::get('importFor') : NULL;
		$action = (in_array(Input::get('action') , ['insert', 'update'])) ? Input::get('action') : NULL;

		if ($action === NULL) return Reponse::json([]);

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
		$query = "";		
		

		// // Save to database
		DB::transaction(function() use($jExcel, $data, &$message, &$status, $table, $action) {
			try {

				if ($action == 'insert') {

					DB::table($table)->insert($data);

					$message .= '<div> <strong>Inserting data </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';
					$status = true;				
					
				} else {

					foreach ($data as $index => $content) {
							$employee_id = $content['employee_work_id'];
							unset($content['employee_work_id']);

							DB::table($table)->where('employee_work_id', '=', $employee_id)->update($content);
								
					}		
					$message .= '<div> <strong>Updating data </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';
							$status = true;			
				}

				// throw new Exception;

			} catch (Exception $e) {
				// echo $e->getMessage();
				$error = $e->getMessage();
				$message .= '<div> <strong>Rolling back due to some problems: </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';
				
				$message .= '<div> <strong>Error: </strong> ' . $error . '</div>';
			
				// var_dump($error);
				$status = false;
				$error = "Failed to process data.";
				DB::rollback();
			}	
		});

		// Free up memory
		$jExcel->throwGarbage();

		$message .= '<div> <strong> Garbage collection </strong> (' . date('H:i:s') . "): Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n" . '</div>';
			
		return Response::json(['memory_log' => $message,
			                  'rows_affected' => count($data),
			                  'status' => ($status == true) ? 'success' : 'failed',
			                  'error' => (isset($error)) ? $error : NULL ,
			                  'file' => $file,
			                 'query' => $query,
			                 'data' => $data] );
	}

	public function create() {
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		return View::make('imports.create');
	}

}