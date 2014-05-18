<?php

App::singleton('AccessControl', function()  { 
			return  new AccessControl(Auth::user()->id, Auth::user()->role_id);
}); 


if (Auth::check() ) {
	
	$acessControl = App::make('AccessControl');
	View::share('accessControl', $acessControl);
	View::share('uri', Input::segment(1));
}


// dd($acessControl->getRoleName(24));


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


// =============== Experimental ===================

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

	// $privilege = DB::table('users_roles_privileges')->where('role_id','=',2)->get(['_create','_edit','_delete','_view']);

	// if (count($privilege) == 1) {
	// 	var_dump($privilege);
	// }


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




// ============= Authentication ==================
Route::get('login', 'AuthController@index' );
Route::post('login/auth', 'AuthController@login' );
Route::get('logout', 'AuthController@logout' ); 



// ============ File Maintenance =================
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


	// User controller
   Route::resource('users', 'UsersController');
   
	Route::resource('philhealths', 'PhilhealthsController');

	Route::resource('companies', 'CompaniesController');

	Route::resource('work_assignments', 'WorkAssignmentsController');

	Route::resource('requirements', 'RequirementsController');

	Route::resource('stageprocesses', 'StageProcessesController');
	
});

// =========== HR Module ================
Route::group(array('before' => ['auth']), function()
{
	// Employee Controller
    Route::resource('employees', 'EmployeesController');
	Route::get('employees/promote', 'EmployeesController@promoteview');
	Route::get('employees/getposition', 'EmployeesController@getPosition');
	Route::post('promote', 'EmployeesController@promote');
	Route::post('employees/photo', 'EmployeesPhotoController@upload');


	// Applicants
	Route::post('applicants/requirements', 'ApplicantsController@requirements');
	Route::get('applicants/jsonApplicantInfo', 'ApplicantsController@jsonApplicantInfo');
	Route::patch('applicants/jsonApplicant', 'ApplicantsController@jsonUpdateApplicant');
	Route::resource('applicants', 'ApplicantsController');



   	Route::post('leaves/approve', 'LeavesController@approve');
	Route::post('leaves/reject', 'LeavesController@reject');
	Route::resource('leaves', 'LeavesController');


	Route::resource('sss_loans', 'SSS_loansController');
	Route::resource('holidays', 'HolidaysController');


	// ============== Timekeeping Module ==============
	// Route::resource('timekeeping', 'TimekeepingsController'); Not yet required
});



// ============= Payroll Module =============
Route::group(array('before' => 'auth'), function()
{
	Route::resource('pay_period', 'PayPeriodsController');
});

// =========== Settings =====================
Route::group(array('before' => 'auth'), function()
{
	Route::resource('settings/roles', 'RolesController');
});


// =============================================
// CATCH ALL ROUTE =============================
// =============================================
// all routes that are not home or api will be redirected to the frontend
// this allows angular to route them
App::missing(function($exception)
{
	return Response::view('layout.missing_page', array(), 404);
});







