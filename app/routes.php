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
	return View::make('index');
}]);

Route::get('/demo', function()
{

	return '<br><br>demo';
});




// Route::get('dashboard', array('as' => 'dashboard', function()
// {
// 	return View::make('hello');


// }) );




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
	Route::resource('positions', 'PositionsController');


	Route::resource('sss', 'SSSController');
	Route::resource('philhealth', 'PhilhealthsController');

	Route::get('basic-files', function() {
		return View::make('basic-files.index');
	});

	Route::get('employees/promote', 'EmployeesController@promoteview');
	Route::get('employees/getposition', 'EmployeesController@getPosition');
	Route::post('promote', 'EmployeesController@promote');

		// User controller
   Route::resource('users', 'UsersController');
   
   // Employee Controller
   Route::resource('employees', 'EmployeesController');
   // Route::resource('employees.leaves', 'LeavesController');
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




Route::post('leaves/approve', 'LeavesController@approve');
Route::post('leaves/reject', 'LeavesController@reject');
Route::resource('leaves', 'LeavesController');


Route::resource('philhealths', 'PhilhealthsController');

Route::resource('companies', 'CompaniesController');

Route::resource('work_assignments', 'WorkAssignmentsController');