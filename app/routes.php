<?php

App::singleton('AccessControl', function()  { 
			return  new AccessControl(Auth::user()->id, Auth::user()->role_id);
}); 


if (Auth::check() ) {	
	$acessControl = App::make('AccessControl');
	View::share('accessControl', $acessControl);
	View::share('uri', Input::segment(1));
	View::share('page_limit', 10);
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
	return Redirect::to('employees');

}]);





Route::get('/demo', function()
{
	// $objPHPExcel = new PHPExcel();
	// $filename = "C:\Tibud\sssloan december.xls";
	// $objPHPExcel = PHPExcel_IOFactory::load("C:\Tibud\New data\chunk.xlsx");
	// // $excelReader = PHPExcel_IOFactory::createReaderForFile($filename);



	$jExcel = App::make('Acme\Extension\jExcel');

	$jExcel->loadFile("C:\Tibud\New data\chunk.xlsx");


	$jExcel->getFieldAndValues();



	$employees = App::make('Acme\Repositories\Employee\EmployeeRepositoryInterface');

	Event::listen('illuminate.query', function ($sql, $bindings, $times) {
			echo '<h3 class="page-header">Database Query</h3>';
				var_dump($sql);
		});

	// dd( $jExcel->convertValuesAndFieldsToDBArray(true) );

		try {
			$data = $jExcel->convertValuesAndFieldsToDBArray(true);

			// DB::table('employees')->insert($data);
		} catch (Exception $e) {
			echo $e->getMessage();
		}	

	return '';
});




// ============= Authentication ==================
Route::get('login', 'AuthController@index' );
Route::post('login/auth', 'AuthController@login' );
Route::get('logout', 'AuthController@logout' ); 



// ============ File Maintenance =================
Route::group(array('before' => 'auth'), function()
{

   // ========= GETTING SYNCHRONOUS DATA ==========
	Route::get('syncdata', 'SyncController@index');

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
	// ==================== Violation ================================
	Route::resource('offenses', 'ViolationsOffensesController');	
	Route::resource('violations', 'ViolationsController');	

	// ==================== Disciplinary Actions =====================
	Route::resource('employees/disciplinary_actions', 'DisciplinaryActionsController');	

	// ==================== Medical Establishments  ==================
	Route::resource('employees/medical_examinations/establishments', 'MedicalEstablishmentsController');	
		
	// ==================== Medical Establishments  ==================
	Route::resource('employees/medical_examinations/diseases', 'DiseasesController');	
	

	// ============== Annual Medical Examination Module ==============
	Route::resource('employees/medical_examinations', 'EmployeesMedicalExaminationsController');

	// Employee Controller
	Route::post('employees/change_position', 'EmployeesController@changePosition');
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
Route::group(array('before' => 'auth', 'prefix' => 'payroll'), function()
{
	Route::resource('dtr', 'DTRController');

	Route::get('rates/forSelect', 'RatesController@forSelect');
	Route::resource('rates', 'RatesController');
	Route::resource('pay_period', 'PayPeriodsController');
	Route::post('process', 'PayrollController@process');
	Route::get('export', 'PayrollController@export');
	Route::get('history', 'PayrollController@history');
	
});

// =========== Settings =====================
Route::group(array('before' => 'auth'), function()
{
	Route::resource('payroll', 'PayrollController');
	Route::get('settings', 'SettingsController@index' );
	Route::resource('settings/roles', 'RolesController');
});

// =========== AUX =====================
Route::group(array('before' => 'auth'), function()
{
	Route::get('/import', 'ImportsController@create');
	Route::post('/import/upload', 'ImportsController@upload');
	Route::post('/import/start', 'ImportsController@start');
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







