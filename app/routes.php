<?php
use Carbon\Carbon;


/*
|--------------------------------------------------------------------------
| Access Role
|--------------------------------------------------------------------------
|
| Here are the initialization of AccessControl class, responsible for managing user access 
| on every page. 
|
*/


if (Auth::check() ) {	

	App::singleton('AccessControl', function()  { 
		return  new AccessControl(Auth::user()->id, Auth::user()->role_id);
	}); 

	// Resolve Access Control class on IOC container
	$acessControl = App::make('AccessControl');
	
	// Share global variable defaults
	View::share('accessControl', $acessControl);
	View::share('uri', Input::segment(1));
	View::share('page_limit', 10);

} 

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
	// DB::statement(' 
	// 	DELETE FROM disciplinary_actions 		
	// 	LEFT OUTER JOIN violations ON violations.id = disciplinary_actions.violation_id
	// 	WHERE ( TIMESTAMPDIFF(YEAR, disciplinary_actions.violation_date , CURDATE() ) )  <= violations.period_before_reset');

	DB::table('disciplinary_actions')->leftJoin('violations','violations.id', '=', 'disciplinary_actions.violation_id')
	                                 ->where(DB::raw('( TIMESTAMPDIFF(YEAR, disciplinary_actions.violation_date , CURDATE() ) )') , '>', 'violations.period_before_reset')
	                                 ->update(['deleted_at' => Carbon::now() ]);





	return Redirect::to('dashboard');

}]);

Route::get('/dashboard/main', [ 'as' => 'dashboard_main',function() {
	
  		return View::make('dashboard.main');
}]);


Route::get('/dashboard/reports', [ 'as' => 'dashboard_reports',function() {
	
  		return View::make('dashboard.reports');
}]);




Route::get('/demo', function()
{

Mail::send('index', ['name' => 'James Mones'], function($message) {
    $message->to('bajongthegreat@gmail.com', 'James Mones')->subject('Welcome to the Laravel 4 Auth App!');
});

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

	Route::get('/download', 'EmployeesFileController@documents');


	
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
	Route::get('employees/masterfile', 'EmployeesController@masterfile');


	// Employee Controller
	Route::post('employees/change_position', 'EmployeesController@changePosition');
    Route::resource('employees', 'EmployeesController');
	Route::get('employees/promote', 'EmployeesController@promoteview');
	Route::get('employees/getposition', 'EmployeesController@getPosition');
	Route::post('promote', 'EmployeesController@promote');
	Route::post('employees/photo', 'EmployeesPhotoController@upload');

	Route::get('modals/employment_certification', 'EmployeesFileController@employment_certification_show');
	Route::post('modals/employment_certification', 'EmployeesFileController@employment_certification_post');

	Route::get('modals/retirement_certification', 'EmployeesFileController@retirement_certification_show');
	Route::post('modals/retirement_certification', 'EmployeesFileController@retirement_certification_post');


	// Applicants
	Route::post('applicants/requirements', 'ApplicantsController@requirements');
	Route::post('applicants/requirements_multiple', 'ApplicantsController@requirements_multiple');
	Route::get('applicants/jsonApplicantInfo', 'ApplicantsController@jsonApplicantInfo');
	Route::patch('applicants/jsonApplicant', 'ApplicantsController@jsonUpdateApplicant');
	Route::resource('applicants', 'ApplicantsController');



   	Route::post('leaves/approve', 'LeavesController@approve');
	Route::post('leaves/reject', 'LeavesController@reject');
	Route::resource('leaves', 'LeavesController');

	Route::resource('sss_loans/payment', 'SSS_loan_paymentsController');
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
	Route::get('detailed_view', 'PayrollController@detailed_view');
	
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
	Route::get('/dashboard', function() {
		return View::make('dashboard.index');
	});
	Route::get('/reports', 'ReportsController@index');
	Route::get('/reports/employee/generate_excel_masterlist', 'ReportsController@create_employee_masterlist_excel');
	Route::get('/reports/dpc/generate_excel', 'ReportsController@create_dpc_excel');
	Route::get('/reports/sss_loans/generate_excel', 'ReportsController@create_sss_monthly_report');
	
	Route::get('/reports/employee', 'ReportsController@employee_index');

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







