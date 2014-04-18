<?php

use Acme\Repositories\Employee\EmployeeRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\EmployeeValidator as jValidator;

class EmployeesController extends BaseController {

	protected $employees;
	protected $validator;

	protected $employment_status = [  '1' => 'Active',
				                      '2' => 'Inactive',
				                      '3' => 'Resigned',
				                      '4' => 'Retired',
				                      '5' => 'Applicant' ];

	protected $membership_status = [ '1' => 'Associate',
	                                 '2' => 'Regular'];


	public function __construct(EmployeeRepositoryInterface $employees, jValidator $validator)
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

      

        // $this->afterFilter('log', array('only' =>
        //                     array('fooAction', 'barAction')));

        // Repository Dependency
        $this->employees = $employees;

        // Repository Dependency
        $this->validator = $validator;


                                      
    }



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($str = NULL)
	{	
		$page = Input::get('page',1);


		// Event::listen('illuminate.query', function ($sql, $bindings, $times) {
		// 	echo '<h3 class="page-header">Database Query</h3>';
		// 		var_dump($sql);
		// });

		// Number of results to get
		$limit  = (Input::has('limit')) ? Input::get('limit') : NULL;

		


		// Checks if an array key "searchTerm" exists in $_POST variable
		if (Input::has('searchTerm')) {

			// Is it absolute or relative type of search
			$type = (Input::has('stype')) ? Input::get('stype') : 'relative';

			$searchTerm = Input::get('searchTerm');
			
			$employees = $this->employees->find($searchTerm, ['limit' => $limit,'type' => $type]);
			
		} else {

			if (!is_null($limit) && $limit == 1) $employees = [];
			else $employees =  $this->employees->all(['limit' => 5, 'page' => $page]);
		}


		if (Request::get('output') == 'json') {
			return Response::json($employees);
		}






      	return View::make('employees.index', compact('employees'));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$positions = Position::lists('name','id');


		$companies = Company::lists('name','id');
		
		// Insert a -1 choice
		array_unshift($companies,'Please select a company');

		$employment_status = $this->employment_status;

		// Insert a -1 choice
		// array_unshift($employment_status,'Please select Employment Status');
		

		// Hide ['Retired', 'Resigned']
		for ($i=2; $i<=4; $i++) {
			unset($employment_status[$i]);
		}


		$membership_status = $this->membership_status;






        return View::make('employees.create', compact(['positions', 'companies','employment_status','membership_status']) );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user_data = Input::all();

		// dd($user_data);
	
		$custom_message = ['messages' => ['sss_id.regex' => 'SSS ID must have a format of XX-XXXXXXX-X (2-7-1)' ,
		                                  'philhealth_id.regex' => 'Philhealth ID must have a format of XX-XXXXXXXXX-X (2-9-1)'] ];

		// Validate Inputs
		if (!$this->validator->validate($user_data, NULL, $custom_message)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}




		// Generate the ID of employee
		$employee_work_id = (isset($user_data['employee_work_id']) && strlen($user_data['employee_work_id']) > 0) ? $user_data['employee_work_id'] : $this->employees->generate_work_id('2317'); 

		// Register employee	
		$employee = $this->employees->register( $user_data , ['fields' => ['employee_work_id' => $employee_work_id] ]);


		return Redirect::route('employees.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// Use Employee Work ID or table ID for retrieving data
		$employee = $this->checkID($id, '-', 'employee_work_id');

		if (!$employee) return Redirect::action('EmployeesController@index');


		$employment_status = $this->employment_status;
		$membership_status = $this->membership_status;

		$company = Company::where('id','=', $employee->company_id)->pluck('name');

		

		if (!$employee) return Redirect::to('employees');
		
        return View::make('employees.show', compact(['employee', 'employment_status', 'membership_status','company']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		// Use Employee Work ID or table ID for retrieving data
		$employee = $this->checkID($id, '-', 'employee_work_id');


		$positions = Position::lists('name','id');

		$employment_status = $this->employment_status;
		$membership_status = $this->membership_status;
		$companies = Company::lists('name','id');
		

		if (!$employee) return Redirect::to('employees');

        return View::make('employees.edit', compact(['employee', 'companies','membership_status', 'employment_status','positions']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user_data = Input::except('_method','_token');

		

		$custom_message = ['messages' => ['sss_id.regex' => 'SSS ID must have a format of XX-XXXXXXX-X (2-7-1)' ,
		                                  'philhealth_id.regex' => 'Philhealth ID must have a format of XX-XXXXXXXXX-X (2-9-1)'],
		                   ];

		// Validate Inputs
		if (!$this->validator->isValidForUpdate( $user_data['employee_work_id'] , $user_data, $custom_message)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}



		// Update employee	
		$employee = $this->employees->updateProfile($user_data['employee_work_id'], $user_data);


		return Redirect::route('employees.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		

		if (Request::ajax())
		{
			$id = Input::get('employee_work_id');
			// $employee = Employee::where('employee_work_id','=', $id)->delete();
			$employee = $this->employees->terminate($id, false, 'employee_work_id');



		    return Response::json($employee);
		} else {
			$employee = $this->employees->terminate($id);
		}
		
		return Redirect::route('employees.index');
	}

		/**
	 * Checks what id is used to retrieve data and return the collection of Employees
	 *
	 * @param  int  $id
	 * @param string $seperator
	 * @param string $column
	 * @return Collection
	 */

	protected function checkID($id, $separator= "-", $column = 'employee_work_id') {

		// Separator is present inside the ID i.e [2965-1029]
		if (strpos($id, $separator) != false) {
			$employee = $this->employees->getProfile($id, $column);
		} else {
			$employee = $this->employees->getProfile($id);
		}





		return $employee;
	}

	

}
