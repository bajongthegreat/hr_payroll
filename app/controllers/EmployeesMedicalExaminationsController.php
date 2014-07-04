
<?php

use Acme\Repositories\Employee\MedicalExamination\EmployeePhysicalExaminationRepositoryInterface;
use Acme\Repositories\Employee\EmployeeRepositoryInterface;


class EmployeesMedicalExaminationsController extends \BaseController {

	protected $physical_examinations;
	protected $employees;

	protected $default_uri = 'employees/medical_examinations';
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(EmployeeRepositoryInterface $employees, EmployeePhysicalExaminationRepositoryInterface $physical_examinations)
	    {
	    	parent::__construct();

	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->employees = $employees;
	        $this->physical_examinations = $physical_examinations;                                                                                                
	        
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /employeesmedicalexaminations
	 *
	 * @return Response
	 */
	public function index()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}


		if (Input::has('jq_ax') && Input::get('jq_ax') == 'employees_included') {
			$employees = $this->physical_examinations->getIncludedEmployeesOnExamination(  Input::get('date_conducted'), (int) Input::get('medical_establishment_id') );
			// return Response::json($employees);
			// return var_dump(Input::all());
			return Response::json($employees);
			// return ['hello'];
		}

		if (Input::has('src')) {
			$src = Input::get('src');

			$physical_examinations = $this->physical_examinations->findAllExaminationsWithEmployee($src);
		} else {
			$physical_examinations = $this->physical_examinations->getAllExaminationDataWithEmployee();
	
		}

		if (Input::get('output') == 'json') {
			return Response::json($physical_examinations);
		}

		$physical_examinations = $physical_examinations->paginate(10);


		return View::make('employees.medical_examination.index', compact('physical_examinations'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /employeesmedicalexaminations/create
	 *
	 * @return Response
	 */
	public function create()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		return View::make('employees.medical_examination.create');	
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /employeesmedicalexaminations
	 *
	 * @return Response
	 */

	// For saving multiple records at once
	protected function SaveBulk() {
		// return 'Processing';
		$examination_data = Input::get('examination_data');

		$decoded_examination_data = json_decode($examination_data);

		// Data container
		$employee_data = [];
		$json_employee_data = [];

		// Job checkers
		$failed_jobs = [];
		$success_jobs = [];
		$jobs = [];
		$duplications = [];
		$not_included = [];

		if (count($decoded_examination_data) == 0 ) return false;
		else {

			$medical_establishment = Input::get('medical_establishment');
			$date_conducted = Input::get('date_conducted');
			
			$medical_establishment_db = DB::table('medical_establishments')->where('id', '=', $medical_establishment)->pluck('name');
		

			

			foreach ($decoded_examination_data as $data) {
				# code...
				// var_dump((array) $data);
				
				$id = $this->employees->find($data->employee_work_id, 'employee_work_id')->pluck('id');
				$medical_findings = ($data->medical_findings == 'None') ? NULL : $data->medical_findings;
				$recommendation = $data->recommendation;
				$remarks = $data->remarks;
				$medical_findings_db = DB::table('diseases')->where('id', '=', $data->medical_findings)->pluck('name');

				$employee_data = ['employee_id' => $id,
				                  'medical_establishment_id' => $medical_establishment,
					              'medical_findings_id' => $medical_findings ,
					              'recommendations' => $recommendation,
					              'remarks' => $remarks,
					              'date_conducted' => $date_conducted,
					              'created_at' => date('Y-m-d h:i:s'),
					              'updated_at'=> date('Y-m-d h:i:s')];
					
				// ID not found
				if ($id == NULL ) {
					$not_included[] = $data->employee_work_id;
					$jobs[] = $data->employee_work_id;

					// Save Employee Data
					$employee_data['employee_id'] = $data->employee_work_id;
					$json_employee_data[] = $employee_data;
				} else {
					
					// Check for duplication first					
					if (!in_array($data->employee_work_id, $jobs)) {


					$count = $this->physical_examinations->find($id, 'employee_id')
					 									 ->where('date_conducted', '=', $date_conducted)
														 ->select(DB::raw('COUNT(*) as count'))->pluck('count');
					
					if ($count == 0) {
						$status = $this->physical_examinations->create($employee_data);		
					} else {
						$status = false;
					}
					

					$employee_data['employee_id'] = $data->employee_work_id;
					$employee_data['medical_establishment_id'] = $medical_establishment_db;
					$employee_data['medical_findings_id'] = is_null($medical_findings_db) ? 'N/A' : $medical_findings_db;
					
					$json_employee_data[] = $employee_data;
					
						// Record job
						$jobs[] = $data->employee_work_id;

						if ($status == false) {
							$failed_jobs[] = $data->employee_work_id;
						} else {
							$success_jobs[] = $data->employee_work_id;
						}

					} else {
					
						// Save Employee Data
						$employee_data['employee_id'] = $data->employee_work_id;
						$employee_data['medical_establishment_id'] = $medical_establishment_db;
				    	$employee_data['medical_findings_id'] = is_null($medical_findings_db) ? 'N/A' : $medical_findings_db;
				
						$json_employee_data[] = $employee_data;
						
						$jobs[] = $data->employee_work_id;
						$duplications[] = $data->employee_work_id;
					}
				}

				
			}



			$output = ['all_jobs' => $jobs,
								   'failed_jobs' => $failed_jobs,
			                       'success_jobs' => $success_jobs,
			                       'success_jobs_count' => count($success_jobs),
			                       'failed_jobs_count' => count($failed_jobs),
			                       'duplications' => $duplications,
			                       'not_included' => $not_included,
			                       'data' => $json_employee_data];


			 return Response::json($output);

		}

	}

	// For saving single medical record
	protected function SaveSingle() {

		$data = Input::except('employee_work_id');

		// dd($data);	

				$id = $data['employee_id'];
				$medical_establishment = $data['medical_establishment'];
				$medical_findings = ($data['medical_findings'] == 'None') ? NULL : $data['medical_findings'];
				$recommendation = $data['recommendation'];
				$remarks = $data['remarks'];
				$date_conducted = $data['date_conducted'];


				$employee_data = ['employee_id' => $id,
				                  'medical_establishment_id' => $medical_establishment,
					              'medical_findings_id' => $medical_findings ,
					              'recommendations' => $recommendation,
					              'remarks' => $remarks,
					              'date_conducted' => $date_conducted,
					              'created_at' => date('Y-m-d h:i:s'),
					              'updated_at'=> date('Y-m-d h:i:s')];
					
		$this->physical_examinations->create($employee_data);
		
		if (Input::has('ref')) {
			$url = base64_decode(Input::get('ref'));
			return Redirect::to($url);
		} else {
			return Redirect::action('EmployeesMedicalExaminationsController@index')->with('message', 'Added new PE Examinee data.');
		}
	}
	public function store()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		if ( Request::ajax() )
		{
			return $this->SaveBulk();
		} 
		else 
		{
			return $this->SaveSingle();
		}
			
		
	}

	/**
	 * Display the specified resource.
	 * GET /employeesmedicalexaminations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		View::make('employees.medical_examination.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /employeesmedicalexaminations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		$date_conducted = Input::get('date_conducted');
		$medical_establishment_id = Input::get('medical_establishment_id');

		$pe = $this->physical_examinations->find($date_conducted, 'date_conducted')
		                                         ->where('medical_establishment_id', '=', $medical_establishment_id)
		                                         ->join('employees', 'employees.id', '=', 'employees_physical_examinations.employee_id')
		                                         ->select('employees_physical_examinations.*', 'employees.employee_work_id', 'employees_physical_examinations.medical_findings_id as medical_findings', 'employees_physical_examinations.recommendations as recommendation')
		                                         ->get();
		 $json = json_encode($pe->toArray());

		 // dd($json_data);
		return View::make('employees.medical_examination.edit', compact(['json', 'pe']));
	}

		protected function updateBulk() {
		// return 'Processing';
		$examination_data = Input::get('examination_data');

		$decoded_examination_data = json_decode($examination_data);

		// Data container
		$employee_data = [];
		$json_employee_data = [];

		// Job checkers
		$failed_jobs = [];
		$success_jobs = [];
		$jobs = [];
		$duplications = [];
		$not_included = [];

		if (count($decoded_examination_data) == 0 ) return false;
		else {

			$medical_establishment = Input::get('medical_establishment');
			$date_conducted = Input::get('date_conducted');
			
			$medical_establishment_db = DB::table('medical_establishments')->where('id', '=', $medical_establishment)->pluck('name');
		

			

			foreach ($decoded_examination_data as $data) {
				# code...
				// var_dump((array) $data);
				
				$id = $this->employees->find($data->employee_work_id, 'employee_work_id')->pluck('id');
				$medical_findings = ($data->medical_findings == 'None') ? NULL : $data->medical_findings;
				$recommendation = $data->recommendation;
				$remarks = $data->remarks;
				$medical_findings_db = DB::table('diseases')->where('id', '=', $data->medical_findings)->pluck('name');

				$employee_data = ['employee_id' => $id,
				                  'medical_establishment_id' => $medical_establishment,
					              'medical_findings_id' => $medical_findings ,
					              'recommendations' => $recommendation,
					              'remarks' => $remarks,
					              'date_conducted' => $date_conducted,
					              'created_at' => date('Y-m-d h:i:s'),
					              'updated_at'=> date('Y-m-d h:i:s')];
					
				// ID not found
				if ($id == NULL ) {
					$not_included[] = $data->employee_work_id;
					$jobs[] = $data->employee_work_id;

					// Save Employee Data
					$employee_data['employee_id'] = $data->employee_work_id;
					$json_employee_data[] = $employee_data;
				} else {
					
					// Check for duplication first					
					if (!in_array($data->employee_work_id, $jobs)) {
			
						$status = $this->physical_examinations->find($id, 'employee_id')->update($employee_data);		
					
					

					$employee_data['employee_id'] = $data->employee_work_id;
					$employee_data['medical_establishment_id'] = $medical_establishment_db;
					$employee_data['medical_findings_id'] = is_null($medical_findings_db) ? 'N/A' : $medical_findings_db;
					
					$json_employee_data[] = $employee_data;
					
						// Record job
						$jobs[] = $data->employee_work_id;

						if ($status == false) {
							$failed_jobs[] = $data->employee_work_id;
						} else {
							$success_jobs[] = $data->employee_work_id;
						}

					} else {
					
						// Save Employee Data
						$employee_data['employee_id'] = $data->employee_work_id;
						$employee_data['medical_establishment_id'] = $medical_establishment_db;
				    	$employee_data['medical_findings_id'] = is_null($medical_findings_db) ? 'N/A' : $medical_findings_db;
				
						$json_employee_data[] = $employee_data;
						
						$jobs[] = $data->employee_work_id;
						$duplications[] = $data->employee_work_id;
					}
				}

				
			}



			$output = ['all_jobs' => $jobs,
								   'failed_jobs' => $failed_jobs,
			                       'success_jobs' => $success_jobs,
			                       'success_jobs_count' => count($success_jobs),
			                       'failed_jobs_count' => count($failed_jobs),
			                       'duplications' => $duplications,
			                       'not_included' => $not_included,
			                       'data' => $json_employee_data];


			 return Response::json($output);

		}

	}


	/**
	 * Update the specified resource in storage.
	 * PUT /employeesmedicalexaminations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		if (Request::ajax() ) {

			if (Input::has('_refer') && Input::get('_refer') == 'employee_profile') {

				$table_data = Input::get('table_data');
				$id = $table_data['id'];
				$table_data['medical_findings_id'] = ($table_data['medical_findings_id'] == 'None') ? NULL : $table_data['medical_findings_id']; 
				unset($table_data['id']);

				$status = $this->physical_examinations->find($id)->update($table_data);

				$status = ($status) ? 'success' : 'failed';

				return Response::json(['status' => $status]);
			}

			return $this->updateBulk();
				
		}
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /employeesmedicalexaminations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
	}

}