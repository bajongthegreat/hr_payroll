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
		$daily_time_records = $this->daily_time_records->all();

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
			
			foreach ($decoded_dtr_data as $data) {
				# code...
				// var_dump((array) $data);
				
				$id = $this->employees->find($data->employee_work_id, 'employee_work_id')->pluck('id');
				// $medical_findings = ($data->medical_findings == 'None') ? NULL : $data->medical_findings;
				$remarks = $data->remarks;


				$employee_data = ['employee_id' => $id,
				                  'work_date' => $work_date,
					              'shift' => $shift,  
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
		//
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
		//
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