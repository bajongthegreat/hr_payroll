<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




Route::get('/', ['as' => 'main',function()
{


	// $v = Validator::make(['em' => 0], array(
 //    'em' => 'required_select',
	// 	));

	// if ($v->fails())
	// {
	//     // The given data did not pass validation
	//     echo 'failed';

	//     var_dump($v->messages());
	// }

	$privilege = DB::table('users_roles_privileges')->where('role_id','=',2)->get(['_create','_edit','_delete','_view']);

	if (count($privilege) == 1) {
		var_dump($privilege);
	}


	return View::make('index');
}]);




Route::get('/demo', function()
{
	$objPHPExcel = new PHPExcel();
	$filename = "C:\Tibud\sssloan december.xls";
	$objPHPExcel = PHPExcel_IOFactory::load("C:\Tibud\New data\chunk.xlsx");
	// $excelReader = PHPExcel_IOFactory::createReaderForFile($filename);


	// $fields = [];

	// for ($i=4; $i < 50 ; $i++) { 

	// 	$row = $objPHPExcel->getActiveSheet()->getRowIterator($i)->current();

	// 	$cellIterator = $row->getCellIterator();
	// 	// $cellIterator->setIterateOnlyExistingCells(false);


	// 	foreach ($cellIterator as $cell) {
		  

	// 	    if ($i==4) {
	// 	    	$fields[] = $cell->getValue();
	// 	    } else {
	// 	    	 $values[$i][] =  $cell->getValue() . " ";
	// 	    }


	// 	}

	// }

	

	// echo '<table><thead>';
	// foreach ($fields as  $value) {
	// 	echo '<th>' . $value . '</th>';
	// }

	// echo '<thead>';

	// foreach ($values as $key => $value) {
	// 	echo '<tr>';
	// 	foreach ($value as $v) {
				
	// 			echo '<td>' . $v . '</td>';
				
	// 	}
	// 	echo '</tr>';
	// }

	return '';
});




// Login Route
Route::get('login', 'AuthController@index' );
Route::post('login/auth', 'AuthController@login' );
Route::get('logout', 'AuthController@logout' ); 



// Routes that needs login
Route::group(array('before' => 'auth'), function()
{


   // Philhealth Controller
	Route::resource('hdmf', 'HDMFController');

	// Departments Controller
	Route::get('departments/departmentsByCompany', 'DepartmentsController@departmentsByCompany');
	Route::resource('departments', 'DepartmentsController');

	// Position Controller
	Route::get('positions/positionsByDepartment', 'PositionsController@positionsByDepartment');
	Route::resource('positions', 'PositionsController');


	Route::resource('sss', 'SSSController');
	Route::resource('philhealth', 'PhilhealthsController');

	Route::get('basic-files', function() {
		return View::make('basic-files.index');
	});

	Route::get('employees/promote', 'EmployeesController@promoteview');
	Route::get('employees/getposition', 'EmployeesController@getPosition');
	Route::post('promote', 'EmployeesController@promote');

	Route::post('employees/photo', 'EmployeesPhotoController@upload');


	// Applicants
	Route::post('applicants/requirements', 'ApplicantsController@requirements');
	Route::get('applicants/jsonApplicantInfo', 'ApplicantsController@jsonApplicantInfo');
	Route::patch('applicants/jsonApplicant', 'ApplicantsController@jsonUpdateApplicant');
	 Route::resource('applicants', 'ApplicantsController');

	// User controller
   Route::resource('users', 'UsersController');
   
   // Employee Controller
   Route::resource('employees', 'EmployeesController');

   	Route::post('leaves/approve', 'LeavesController@approve');
	Route::post('leaves/reject', 'LeavesController@reject');
	Route::resource('leaves', 'LeavesController');


	Route::resource('philhealths', 'PhilhealthsController');

	Route::resource('companies', 'CompaniesController');

	Route::resource('work_assignments', 'WorkAssignmentsController');

	Route::resource('sss_loans', 'SSS_loansController');

	Route::resource('requirements', 'RequirementsController');

	Route::resource('stageprocesses', 'StageProcessesController');

	Route::resource('holidays', 'HolidaysController');

});


// =============================================
// CATCH ALL ROUTE =============================
// =============================================
// all routes that are not home or api will be redirected to the frontend
// this allows angular to route them
App::missing(function($exception)
{
	return View::make('404');
});







