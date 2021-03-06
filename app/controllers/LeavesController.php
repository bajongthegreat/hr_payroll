<?php
use Acme\Repositories\Employee\Leave\LeavableInterface;

// Use a Validation Service
use Acme\Services\Validation\LeaveValidator as jValidator;



class LeavesController extends BaseController {

	protected $leaves;
	protected $validator;

	protected $leave_type;

	// Helper class for leaves
	private $helper;
	protected $default_uri = "leaves";

	public function __construct(LeavableInterface 	$leaves, jValidator $validator) {
		
		parent::__construct();
		// Leave repository dependency
		$this->leaves = $leaves;

		// Leave validator dependency
		$this->validator = $validator;

		// Helper dependency
		 $this->helper = new Acme\Helpers\LeaveHelper;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id = NULL)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$helper = $this->helper;

		$leave_type = $this->leave_type;

		if (!is_null($id)) {

			// Get all leaves for an employee with the specified ID
			$leaves = $this->leaves->find_by_employee_id($id);
			
		}
		else {
			$leaves = $this->leaves->get();
		}


        return View::make('leaves.index', compact(['leaves', 'leave_type', 'helper']));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

        return View::make('leaves.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		$leave_data = Input::except('_token', 'work_id', 'ref');

		$id = Input::get('work_id');
		
		// 
		$hash_segment = '#employee=' . $id;



		// Validate Inputs
		if (!$this->validator->validate($leave_data, NULL)) {
			return Redirect::action('LeavesController@create',$hash_segment )->withInput()->withErrors($this->validator->errors());
		}

		// Store leave data into the database
		$leave = $this->leaves->file($leave_data);


		// Check if the process has a reference page
		if (Input::has('ref')) {
			if (Input::get('ref')) {
				
				$url = base64_decode(Input::get('ref'));
				return Redirect::to($url);

			}
		}


		return Redirect::action('LeavesController@index');;
	}


	public function approve() {


		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$id = (int) Input::get('id');
		$data = Input::except('id','_token');

		// Approve Leave
		$approval_status = $this->leaves->approve($id, $data);


		if ($approval_status) {
			return  Redirect::action('LeavesController@show', $id);
		} 


		 return Redirect::action('LeavesController@index');
	}

	public function reject() {


		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$id = (int) Input::get('id');
		$data = Input::except('id','_token');

		// Approve Leave
		$rejection_status = $this->leaves->reject($id, $data);


		if ($rejection_status) {
			return  Redirect::action('LeavesController@show', $id);
		} 

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, $id_sec=NULL)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$helper = $this->helper;
		
		// This was accessed with leaves route directly
		if (is_null($id_sec) && isset($id)) {
			
		
			$leave = $this->leaves->find($id);



		// This was accessed in Employees route and Leaves became a nested route.
		// Using two IDs : $id and $id_sec
		} else {
			
			echo 'Main controller: Employees';


		}

		if (count($leave) == 1) {
			return View::make('leaves.show', compact(['leave', 'helper']));
		}

        return Redirect::action('LeavesController@index')->with('message', ['error' => 'Failed to show the requested leave data.']);
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
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}




		$leave = $this->leaves->find($id);

		if (isset($leave[0])) {
			$leave = $leave[0];
		}


        return View::make('leaves.edit', compact(['leave']));
	}

	/**
	 * Update the specified resource in storage.
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

		$id = (int) Input::get('id');
		$data = Input::except('id','_token','_method', 'ref');

		$work_id = Input::get('work_id');

		
		// 
		$hash_segment = '#employee=' . $work_id;


		$update_status = $this->leaves->update($id, $data);

		if ($update_status) {
			
		// Check if the process has a reference page
		if (Input::has('ref')) {
			if (Input::get('ref')) {
				
				$url = base64_decode(Input::get('ref'));
				return Redirect::to($url);

			}
		}
			return  Redirect::action('LeavesController@show', [$id, $hash_segment]);
		}
		
	}

	/**
	 * Remove the specified resource from storage.
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
