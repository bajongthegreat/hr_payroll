<?php

class ImportsController extends \BaseController {

	protected $allowedTables = ['employees'];
	protected $default_uri = 'import';

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

	// Start importation process
	public function start() {

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		// var_dump(Input::get('file') );

		var_dump(Input::all());
		$jExcel = App::make('Acme\Extension\jExcel');
		$file = Input::get('file');

		// Check if that table is in our list that is available and prepared for importation
		$table = (in_array(Input::get('importFor'), $this->allowedTables)) ? Input::get('importFor') : NULL;

		if ($table === NULL) {
			throw new Exception("Table is not valid. Please do it again.", 101);
		}	

		// Load the file
		if (!$u_status = $jExcel->loadFile( $file ) ) {

			print json_encode($u_status);
		}

		// Delete File
		// if (is_readable( $file )) {
		// 		unlink($file);
		// 	}
		
		// Process the excel file and grab the cell valuess
		$jExcel->getFieldAndValues();
		

		// // Save to database
		// DB::transaction(function() use($jExcel) {
		// 	try {
				$data = $jExcel->convertValuesAndFieldsToDBArray(true);

		// 		var_dump($data);				
		// 		// print json_encode($data);
				DB::table('employees')->insert($data);
		// 	} catch (Exception $e) {
		// 		// echo $e->getMessage();

		// 		$error = "Failed to process data.";
		// 		DB::rollback();
		// 	}	
		// });

		
			



			
	}

	public function create() {
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		return View::make('imports.create');
	}

}