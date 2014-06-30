<?php

use Acme\Repositories\Employee\EmployeeRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\EmployeeValidator as jValidator;



class EmployeesController extends BaseController {

	// Employee Dependency
	protected $employees;

	// Employee Validator Dependency
	protected $validator;

	protected $limit = 10;


	protected $fields_to_use_on_search = ['firstname','lastname','middlename','employee_work_id', 'name_extension'];
	protected $fields_to_use_on_listings = ['firstname','lastname','middlename','employee_work_id','position_id','employment_status','membership_status','name_extension'];


	protected $custom_message = ['messages' => ['sss_id.regex' => 'SSS ID must have a format of XX-XXXXXXX-X (2-7-1)' ,
			                                    'philhealth_id.regex' => 'Philhealth ID must have a format of XX-XXXXXXXXX-X (2-9-1)',
			                                    'position_id.required_select' => 'Please select work assignment.',
			                                    'gender.required_select' => 'Please select gender.'] ];

	public function __construct(EmployeeRepositoryInterface $employees, jValidator $validator)
    {
    	parent::__construct();
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

		// Check access control
		if ( !$this->accessControl->hasAccess('employees', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$filter_params = json_decode(urldecode(Input::get('filterby')));

		// Number of results to get
		$limit  = (Input::has('limit')) ? Input::get('limit') : $this->limit;
		
		// Checks if an array key "src" exists in $_POST variable
		if (Input::has('src')) {

			$src = Input::get('src');

			// Relative searching, using LIKE in SQL queries
			if ( Input::get('stype') != 'absolute') 
			{
				if (Input::has('department_id') && Input::get('department_id') != 0){
					$department_id = [ Input::get('department_id') ];


					$employees = $this->relativeDataSearch($src, $filter_params, $this->fields_to_use_on_search, NULL, ['field' => 'departments.id', 'values' => $department_id]);
				} else {
					$employees = $this->relativeDataSearch($src, $filter_params, $this->fields_to_use_on_search);	
				}
				
			} 

			// Absolute Searching, used specific field
			else 
			{
				$employees = $this->absoluteDataSearch('employee_work_id', $src, $filter_params, $limit);
			}
		
						
		} 


		// No seaching was made
		else {

			$employees =  $this->getAllEmployeeData($filter_params);
		}

		// dd($employees);

		// Cast data to json
		if (Request::get('output') == 'json') {
			if (Input::has('count')) {
				return Response::json(count($employees->get()));	
			}
			return Response::json($employees->get());
		}

		


		// Final processing
		$employees = $employees->paginate($limit, $this->fields_to_use_on_listings);


      	return View::make('employees.index', compact('employees'));
      
	
	}


	function addFilterFieldsToDB($query, $params) {

		foreach ($params as $key => $value) {
					if (is_array($value) && count($value) > 1) {
						$query->whereIn($key, $value);	
					
					} else {
						$query->where($key, '=', $value[0]);
					}
					
					}
	}

	function relativeDataSearch($src, $filter_params, $db_field_to_use, $concat=[], $whereIn = []) {

		return $this->employees->findLike($src, $db_field_to_use , ['position'], ['lastname', 'firstname'] )
		->where('membership_status', '!=', 'applicant')->where(function($query) use ($filter_params, $src, $whereIn) {
				
		

				if (isset($filter_params)) {
					$this->addFilterFieldsToDB($query, $filter_params);
				}
					

				if (count($whereIn) > 0) {
							$query->whereIn($whereIn['field'], $whereIn['values']);	
		        	
				}
		        		
		        		
		        	
				
				})->leftJoin('positions', 'positions.id', '=', 'employees.position_id')
		          ->leftJoin('departments', 'positions.department_id', '=', 'departments.id')->limit(50)
		          ->select(DB::raw('employees.*'), 'departments.id as department_id', 'positions.id as position_id',
		          	         'departments.name as department_name', 'positions.name as position_name');
	}


	function absoluteDataSearch($field, $src, $filter_params, $limit) {
		return $this->employees->find($src, $field)->take($limit)->where('membership_status', '!=', 'applicant')->where(function($query) use ($filter_params) {
				
				if (isset($filter_params)) {
					$this->addFilterFieldsToDB($query, $filter_params);
				}

				});
	}

	function getAllEmployeeData($filter_params) {
		return $this->employees->getAllWith(['position'])->where('membership_status', '!=', 'applicant')->where(function($query) use ($filter_params) {
				
				if (isset($filter_params)) {
					$this->addFilterFieldsToDB($query, $filter_params);
				}

			
				
			});
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('employees', 'create', $this->byPassRoles) ) {
				return $this->notAccessible();	
		}

        return View::make('employees.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('employees', 'create', $this->byPassRoles) ) {
				return $this->notAccessible();	
		}


		$user_data = Input::except('_method','_token','department_id');

		// Validate Inputs
		if (!$this->validator->validate($user_data, NULL, $this->custom_message)) {

			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		// Generate the ID of employee
		$user_data['employee_work_id'] = (isset($user_data['employee_work_id']) && strlen($user_data['employee_work_id']) > 0) ? $user_data['employee_work_id'] : $this->employees->generate_work_id('2317'); 

		// Register employee	
		$employee = $this->employees->create( $user_data );

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
		// Check access control
		if ( !$this->accessControl->hasAccess('employees', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$employee_work_id = $id;
		
		// Use Employee Work ID or table ID for retrieving data
		$employee = $this->checkID($id, '-', 'employee_work_id');

		if (!$employee) return Redirect::action('EmployeesController@index');


		// Figure out how to remove it to this controller but still using it on the view
		$company = Company::where('id','=', $employee->company_id)->pluck('name');

		// dd($employee);

		if (!$employee) return Redirect::to('employees');
		
        return View::make('employees.show', compact(['employee','company', 'employee_work_id']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('employees', 'edit', [0, 1]) ) {
				return  $this->notAccessible();		
		}

		$employee_work_id = $id;
		// Use Employee Work ID or table ID for retrieving data
		$employee = $this->checkID($id, '-', 'employee_work_id');

		if (!$employee) return Redirect::to('employees');

		// Figure out how to remove it to this controller but still using it on the view
		$company = Company::where('id','=', $employee->company_id)->pluck('name');

        return View::make('employees.show', compact(['employee', 'employee_work_id', 'company']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user_data = Input::except('_method','_token','department_id');


		$user_data['ppe_issuance'] = Input::has('ppe_issuance') ? $user_data['ppe_issuance'] : 0;
		$user_data['with_r1a'] = Input::has('with_r1a') ? $user_data['with_r1a'] : 0;
		$user_data['annual_pe'] = Input::has('annual_pe') ? $user_data['with_r1a'] : 0;

		
		 // Warning: Validating for existing id is not yet implemented
		$id_check = $this->employees->find(Input::get('employee_work_id'), 'employee_work_id')->where('employee_work_id','!=', $id)->lists('employee_work_id');
		


		// Validate Inputs
		if (!$this->validator->isValidForUpdate( $id , $user_data, $this->custom_message)) {
			return Redirect::route('employees.edit', [$id,'#errors'])->withInput()->withErrors($this->validator->errors());
		} else {
			
			// It has the same ID
			if (count($id_check) == 1 ) {
				return Redirect::route('employees.edit', [$id,'#errors'])->withInput()->withErrors(['ID already existed.']);
			}
		}
		
		// Update employee	
		$employee = $this->employees->find($id, 'employee_work_id')->update($user_data);


		return Redirect::route('employees.show', $id);
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

			$employee = $this->employees->find($id, 'employee_work_id')->delete($id);

		    return Response::json($employee);
		} else {
			$employee = $this->employees->find($id)->delete();
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
			$employee = $this->employees->find($id, $column)->get();
		} else {
			$employee = $this->employees->find($id)->get();
		}


		return (isset($employee[0])) ? $employee[0] : false; 
	}

	

}
