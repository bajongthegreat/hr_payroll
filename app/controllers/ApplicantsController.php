<?php

use Acme\Repositories\Employee\EmployeeRepositoryInterface;
use Acme\Repositories\Employee\EmployeeRequirementRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\EmployeeValidator as jValidator;

class ApplicantsController extends BaseController {


	// Dependencies
	protected $applicants;
	protected $validator;
	protected $applicant_requirements;

	protected $limit = 10;

	protected $employment_status = [];

	protected $membership_status = [0 => 'Applicant'];

	protected $fields_to_use_on_search = ['firstname','lastname','middlename','employee_work_id'];
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(EmployeeRepositoryInterface $applicants, jValidator $validator, EmployeeRequirementRepositoryInterface $applicant_requirements)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->applicants = $applicants;
	                                                                                                                                  
	        $this->validator= $validator;

	        $this->applicant_requirements = $applicant_requirements;
	    }
	


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// Number of results to get
		$limit  = (Input::has('limit')) ? Input::get('limit') : $this->limit;


		// Checks if an array key "searchTerm" exists in $_POST variable
		if (Input::has('searchTerm') || Input::has('status')) {

			$searchTerm = Input::get('searchTerm');
			$status = Input::get('status');

			// Is it absolute or relative type of search
			if ( Input::get('stype') != 'absolute') 
			{
				$applicants = $this->applicants->findLike($searchTerm, $this->fields_to_use_on_search , ['position'] )->where(function($query) use ($status){
					$query->where('membership_status','=', 'applicant');
					if (strlen($status) > 0 ) {
						$query->where('employment_status','=', $status);

					}
				});
			} 
			else 
			{
				$applicants	= $this->applicants->find($searchTerm)->take($limit)->where('membership_status','=', 'applicant');
			}
		
						
		} else {

			$applicants =  $this->applicants->getAllWith(['position'])->where('membership_status','=', 'applicant');
		}

		if (Request::get('output') == 'json') {
			return Response::json($applicants->get());
		}


		// Final processing
		$applicants = $applicants->paginate($limit);




        return View::make('applicants.index', compact('applicants'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('applicants.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user_data = Input::except('_method','_token','department_id','stage_process_id','requirement_id');
	
		$custom_message = ['messages' => ['sss_id.regex' => 'SSS ID must have a format of XX-XXXXXXX-X (2-7-1)' ,
		                                  'philhealth_id.regex' => 'Philhealth ID must have a format of XX-XXXXXXXXX-X (2-9-1)'] ];

		$requirements = Input::get('requirement_id');

		// Validate Inputs
		if (!$this->validator->validate($user_data, NULL, $custom_message)) {

			$requirements_id = json_encode(Input::get('requirement_id'));

			return Redirect::back()->withInput(Input::all() + ['requirement_id' => $requirements_id])->withErrors($this->validator->errors());
		}




		// Generate the ID of employee
		$user_data['employee_work_id'] = NULL; 

		// Register employee	
		$employee = $this->applicants->create( $user_data );

		if ($employee) {

			foreach ($requirements as $key => $value) {
				$employee_requirement[] = ['employee_id' => $employee->id, 'requirement_id' => $value];

			}

			$this->applicant_requirements->create($employee_requirement);
		}

		

		return Redirect::route('applicants.index');
	}

	public function requirements() {

		$employee_id = Input::get('employee_id');
		$requirement_id = Input::get('requirement_id');
		$type = Input::get('process_type');

		$check = $this->applicant_requirements->find($requirement_id, 'requirement_id')->where('employee_id','=', $employee_id)->get();

		

		if ($type == 'pass') {
			if (count($check) > 0) return "";
			return ($this->applicant_requirements->create(['employee_id' => $employee_id, 'requirement_id' => $requirement_id])) ? json_encode(['status' => 'created']) : json_encode(['status' => 'error']);
		}
		elseif ($type == 'remove') {
			return ($this->applicant_requirements->delete($requirement_id, 'requirement_id')) ? json_encode(['status' => 'created']) : json_encode(['status' => 'error']);
		}
		
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
		$applicant = $this->applicants->find($id)->get()[0];

		if (!($applicant)) return Redirect::action('ApplicantsController@index');

		// Get all requirements passed by applicants
		$requirements_passed = $this->applicants->getAllRequirements($applicant->id);

		// Figure out how to remove it to this controller but still using it on the view
		$company = Company::where('id','=', $applicant->company_id)->pluck('name');

	

		if (!$applicant) return Redirect::to('applicants');
		
        return View::make('applicants.show',  compact(['applicant','company']));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$applicant	= $this->applicants->find($id)->take(1)->where('membership_status','=', 'applicant')->get()[0];

        return View::make('applicants.edit', compact('applicant'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	function jsonApplicantInfo() {

		// Only accept ajax request
		if (Request::ajax())
		{
		    $id = Input::get('id');

		    $decoded_json_id  = json_decode($id);

		    // Get all data of all the ids in the array
		    if (count($decoded_json_id) > 0) {
		    	$data = $this->applicants->findWhereIn('id', $decoded_json_id, ['position'])->get();

		    	 return Response::json($data);
		    }

		   
		}
	}

	function jsonUpdateApplicant() {

		// Only accept ajax request
		if (Request::ajax())
		{
		    $id = Input::get('id');
		    $status = Input::get('status');

		    $decoded_json_id  = json_decode($id);


		    // Get all data of all the ids in the array
		    if (count($decoded_json_id) > 0) {

		    	if ($status == 'hire') {
		    		$date_hired = Input::get('date_hired');

		    		foreach ($decoded_json_id as $id) {

		    			$employee_work_id = $this->applicants->generate_work_id(2317);

		    			$data = $this->applicants->find($id, 'id')->update(['employment_status' => 'active',
		    			                                                                                  'membership_status' => 'associate',
		    			                                                                                  'date_hired' => $date_hired,
		    			                                                                                  'employee_work_id' => $employee_work_id]);	
		    		}
		    		
		    	} else {
		    		$data = $this->applicants->findWhereIn('id', $decoded_json_id, ['position'])->update(['employment_status' => $status]);
		    	}
		    	
		    	 return Response::json($data);
		    }

		   
		}
	}

}
