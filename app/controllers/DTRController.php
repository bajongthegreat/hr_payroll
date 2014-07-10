<?php

use Acme\Repositories\Payroll\DailyTimeRecord\DailyTimeRecordRepositoryInterface;
use Acme\Services\Validation\DailyTimeRecordValidator as jValidator;
use Acme\Repositories\Employee\EmployeeRepositoryInterface;


class DTRController extends \BaseController {


	protected $daily_time_records;
	protected $employees;
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(DailyTimeRecordRepositoryInterface $daily_time_records, EmployeeRepositoryInterface $employees)
	    {
	    	// Initialize base controller
	    	parent::__construct();

	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->daily_time_records = $daily_time_records;

	        $this->employees = $employees;
	                                                                                                                                  
	        
	    }
	
	/**
	 * Display a listing of the resource.
	 * GET /dtrs
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Input::has('group') && Input::get('group') == 'none') {
			$daily_time_records = $this->daily_time_records->allNotGrouped();
		} else {
			$daily_time_records = $this->daily_time_records->allGrouped();
		}
		

		if (Input::has('jq_ax')) {

			if (Input::has('company_id') && Input::has('start_date') && Input::has('end_date')) {
			$company_id = Input::get('company_id');
			$start = Input::get('start_date');
			$end = Input::get('end_date');


			$dtr = DB::table('dailytimerecords')->whereBetween('work_date', [$start, $end])
			                                    ->where('employees.company_id', '=', $company_id)
			                                ->leftJoin('employees', 'employees.id', '=', "dailytimerecords.employee_id")
			                                ->leftJoin('positions', 'positions.id', '=', 'work_assignment_id')
			                                ->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
			                                ->select("dailytimerecords.id",
			                                	    "dailytimerecords.work_date",
			                                	    "dailytimerecords.shift",
			                                	    "dailytimerecords.time_in_am",
			                                	    "dailytimerecords.time_out_am",
			                                	    "dailytimerecords.time_in_pm",
			                                	    "dailytimerecords.time_out_pm",
			                                	    "dailytimerecords.work_assignment_id",
			                                	    "employees.lastname",
			                                	    "employees.firstname",
			                                	    "employees.middlename",
			                                	    "departments.id as department_id",
			                                	    "departments.name as department_name",
			                                	    "positions.name as position_name",
			                                	    "employees.id as employee_id");
			        
			         $dtr_notgrouped = $dtr->get();
			        if (Input::has('unique')) {
			        	$dtr->groupBy('employee_id');
			        }

			        $departments = $dtr->lists('department_id');	
			        

			        
			        return Response::json(['data' => $dtr->get(),
			        				'raw_data' => $dtr_notgrouped,
				                   'count' => count( $dtr->get() ),
				                   'departments' => $departments]);
			} else {

			$work_date =  Input::get('work_date');
			$work_assignment_id = Input::get('work_assignment');
			$shift = Input::get('shift');

			$dtr = $this->daily_time_records->find($shift, 'shift')
			                                ->where('work_date', '=', $work_date)
			                                ->where('work_assignment_id', '=', $work_assignment_id)
			                                ->leftJoin('employees', 'employees.id', '=', "dailytimerecords.employee_id")
			                                ->leftJoin('positions', 'positions.id', '=', 'work_assignment_id')
			                                ->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
			                                ->select("dailytimerecords.id",
			                                	    "dailytimerecords.work_date",
			                                	    "dailytimerecords.shift",
			                                	    "dailytimerecords.time_in_am",
			                                	    "dailytimerecords.time_out_am",
			                                	    "dailytimerecords.time_in_pm",
			                                	    "dailytimerecords.time_out_pm",
			                                	    "dailytimerecords.work_assignment_id",
			                                	    "employees.lastname",
			                                	    "employees.firstname",
			                                	    "employees.middlename",
			                                	    "departments.id as department_id",
			                                	    "departments.name as department_name",
			                                	    "positions.name as position_name")
			                                ->get();

			                            return Response::json($dtr);
			}                                

			

		}

		return View::make('dtr.index', compact('daily_time_records'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /dtrs/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('dtr.create');
	}


	protected function processJobs() {

	}

	// For saving multiple records at once
	protected function SaveBulk() {
		// return 'Processing';
		$dtr_data = Input::get('dtr_data');

		$decoded_dtr_data = json_decode($dtr_data);

		// Data container
		$employee_data = [];
		$json_employee_data = [];

		// Job checkers
		$failed_jobs = [];
		$success_jobs = [];
		$jobs = [];
		$duplications = [];
		$not_included = [];

		if (count($decoded_dtr_data) == 0 ) return false;
		else {

			$work_date = Input::get('date');
			$shift = Input::get('shift');
			$work_assignment_id = Input::get('work_assignment_id');
			
			foreach ($decoded_dtr_data as $data) {
				# code...
				// var_dump((array) $data);
				
				$id = $this->employees->find($data->employee_work_id, 'employee_work_id')->pluck('id');
				// $medical_findings = ($data->medical_findings == 'None') ? NULL : $data->medical_findings;
				$remarks = $data->remarks;


				$employee_data = ['employee_id' => $id,
				                  'work_date' => $work_date,
					              'shift' => $shift,  
					              'work_assignment_id' => $work_assignment_id,
									'time_in_am'  =>$data->time_in_am,
									'time_out_am' => $data->time_out_am,
									'time_in_pm'  => $data->time_in_pm,
									'time_out_pm' => $data->time_out_pm,
									'remarks' => $remarks,
									'encoded_by' => Auth::user()->username,
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



					$status = $this->daily_time_records->create($employee_data);	
					
					unset($employee_data['encoded_by']);

					$employee_data['employee_id'] = $data->employee_work_id;
					$employee_data['id'] = $status->id;

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
						$json_employee_data[] = $employee_data;
						
						$jobs[] = $data->employee_work_id;
						$duplications[] = $data->employee_work_id;
					}
				}

				
			}

			$output = json_encode(['all_jobs' => $jobs,
								   'failed_jobs' => $failed_jobs,
			                       'success_jobs' => $success_jobs,
			                       'success_jobs_count' => count($success_jobs),
			                       'failed_jobs_count' => count($failed_jobs),
			                       'duplications' => $duplications,
			                       'not_included' => $not_included,
			                       'data' => $json_employee_data]);

			 return Response::json($output);

		}
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /dtrs
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		// var_dump(Input::all());
		return $this->SaveBulk();
	}

	/**
	 * Display the specified resource.
	 * GET /dtrs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /dtrs/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
			if (Input::has('type') && Input::get('type') == 'bulk') {

				$work_date =  Input::get('work_date');
				$work_assignment_id = Input::get('work_assignment');
				$shift = Input::get('shift');

				$dtr = $this->daily_time_records->find($shift, 'shift')
				                                ->where('work_date', '=', $work_date)
				                                ->where('work_assignment_id', '=', $work_assignment_id)
				                                ->leftJoin('employees', 'employees.id', '=', "dailytimerecords.employee_id")
				                                ->leftJoin('positions', 'positions.id', '=', 'work_assignment_id')
				                                ->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
				                                ->select("dailytimerecords.id",
				                                	    "dailytimerecords.work_date",
				                                	    "dailytimerecords.shift",
				                                	    "dailytimerecords.time_in_am",
				                                	    "dailytimerecords.time_out_am",
				                                	    "dailytimerecords.time_in_pm",
				                                	    "dailytimerecords.time_out_pm",
				                                	    "dailytimerecords.work_assignment_id",
				                                	    "employees.lastname",
				                                	    "employees.firstname",
				                                	    "employees.middlename",
				                                	    "employees.employee_work_id",
				                                	    "dailytimerecords.remarks",
				                                	    "departments.id as department_id",
				                                	    "positions.id as position_id");

				$ids_prior_update = $dtr->lists('employee_work_id');
				$dtr_json =  json_encode($dtr->get()->toArray());
				$dtr = $dtr->get()->first();	

			} else {
				$dtr = $this->daily_time_records->find($id, 'dailytimerecords.id')
				                                ->leftJoin('employees', 'employees.id', '=', "dailytimerecords.employee_id")
				                                ->leftJoin('positions', 'positions.id', '=', 'work_assignment_id')
				                                ->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
				                                ->select("dailytimerecords.id",
				                                	    "dailytimerecords.work_date",
				                                	    "dailytimerecords.shift",
				                                	    "dailytimerecords.time_in_am",
				                                	    "dailytimerecords.time_out_am",
				                                	    "dailytimerecords.time_in_pm",
				                                	    "dailytimerecords.time_out_pm",
				                                	    "dailytimerecords.work_assignment_id",
				                                	    "employees.lastname",
				                                	    "employees.firstname",
				                                	    "employees.middlename",
				                                	    "employees.employee_work_id",
				                                	    "employees.id as employee_id",
				                                	    "dailytimerecords.remarks",
				                                	    "departments.id as department_id",
				                                	    "positions.id as position_id")->get()->first();

				$ids_prior_update = NULL;
				$dtr_json =  NULL;
				
			}	

			if ( count($dtr) == 0 ) {
				return Redirect::action('DTRController@index');
			}
			 	
			return View::make('dtr.edit', compact('dtr', 'dtr_json', 'ids_prior_update'));
	}


	protected function bulkUpdate() {

		$dtr_data = json_decode(Input::get('dtr_data'));
		$shift = Input::get('shift');
		$date = Input::get('date');
		$ids_prior_update = Input::get('ids_prior_update');
		$work_assignment = Input::get('work_assignment_id');


		// Job checkers
		$failed_jobs = [];
		$success_jobs = [];
		$jobs = [];
		$duplications = [];
		$not_included = [];
		$created = [];


		foreach ($dtr_data as $key => $value) {
			# code...

			// Get ORIGINAL id of employee from DB
			$employee_id = $this->employees->find($value->employee_work_id, 'employee_work_id')->pluck('id');
			$work_id = $value->employee_work_id;

			
			// DUplicates
			if (in_array($value->employee_work_id, $jobs)) {
				$duplications[] = $value->employee_work_id;
			}

			// Job count
			$jobs[] = $value->employee_work_id;

			// Not included
			if ($employee_id == NULL) {
				$not_included[] = $value->employee_work_id;
			}

			// Set employee ID
			$value->employee_id = $employee_id;
			$value->shift = $shift;
			$value->work_date = $date;
			$value->work_assignment_id = $work_assignment;		

			$employee_data = ['employee_id' => $employee_id,
				                  'work_date' => $date,
					              'shift' => $shift,  
					              'work_assignment_id' => $work_assignment,
									'time_in_am'  =>$value->time_in_am,
									'time_out_am' => $value->time_out_am,
									'time_in_pm'  => $value->time_in_pm,
									'time_out_pm' => $value->time_out_pm,
									'remarks' => $value->remarks,
									'encoded_by' => Auth::user()->username,
					              'created_at' => date('Y-m-d h:i:s'),
					              'updated_at'=> date('Y-m-d h:i:s')];
					

			// Check if the data is new or old	
			if (in_array($value->employee_work_id, $ids_prior_update)) {

				$id = $value->id;

				// Remove employee ID and work ID, I think it doesn't make sense to update them.
				unset($employee_data->employee_id);
				unset($value->employee_work_id);

				// Update
				if ($this->daily_time_records->find($id)->update((array) $employee_data)) {
					$success_jobs[] = $work_id;
				} else {
					$failed_jobs[] = $work_id;
				}
				$employee_data['employee_id'] = $work_id;
				$json_employee_data[] = $employee_data;

			} else {

				unset($value->employee_work_id);


				// Create
				if ($this->daily_time_records->create( (array) $employee_data)) {
					$success_jobs[] = $work_id;
					$created[] = $work_id;
				} else {
					$failed_jobs[] = $work_id;
				}

				$employee_data['employee_id'] = $value->employee_work_id;
				$json_employee_data[] = $employee_data;
			}

		}


		// Return data

			$output = json_encode(['all_jobs' => $jobs,
									'created' => $created,
								   'failed_jobs' => $failed_jobs,
			                       'success_jobs' => $success_jobs,
			                       'success_jobs_count' => count($success_jobs),
			                       'failed_jobs_count' => count($failed_jobs),
			                       'duplications' => $duplications,
			                       'not_included' => $not_included,
			                       'data' => $json_employee_data ])	;

			 return Response::json($output);

	}

	public function singleUpdate($id) {
		$shift = Input::get('shift');
		$date = Input::get('work_date');
		$work_assignment = Input::get('work_assignment_id');
		$remarks = Input::get('remarks');
		$time_in_am = Input::get('time_in_am');
		$time_out_am = Input::get('time_out_am');
		$time_in_pm = Input::get('time_in_pm');
		$time_out_pm = Input::get('time_out_pm');

		$data = [ 'shift' => $shift,
		          'work_date' => $date,
		          'work_assignment_id' => $work_assignment,
		          'time_in_am' => $time_in_am,
		          'time_out_am' => $time_out_am,
		          'time_in_pm' => $time_in_pm,
		          'time_out_pm' => $time_out_pm,
		          'remarks' => $remarks];

		return $this->daily_time_records->find($id)->update($data);

	}
	/**
	 * Update the specified resource in storage.
	 * PUT /dtrs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Request::ajax()) {	

		// Check if it is bulk or single
		return $this->bulkUpdate();
		} else {
			
			if ($this->singleUpdate($id)) {
				return Redirect::action('DTRController@index', ['group' => 'none'])->with('message', 'DTR updated.');
			} else {
				return Redirect::action("DTRController@edit", [$id])->withInputs();
			}
		}
		// return var_dump(Input::al/	l());
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /dtrs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}