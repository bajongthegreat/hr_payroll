<?php

use Acme\Repositories\Employee\DisciplinaryAction\DisciplinaryActionRepositoryInterface;
use Acme\Services\Validation\DisciplinaryActionsValidator as jValidator;

class DisciplinaryActionsController extends \BaseController {


	protected $disciplinaryactions;
	protected $validator;

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(DisciplinaryActionRepositoryInterface $disciplinaryactions ,jValidator $validator)
	    {

	    	parent::__construct();

	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->disciplinaryactions = $disciplinaryactions;
	                                                                                                                                  
	        $this->validator = $validator;
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /disciplinaryactions
	 *
	 * @return Response
	 */
	public function index()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess('employees/disciplinary_actions', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		if (Input::has('src')) {
			$src= Input::get('src');

			$employee_violators = $this->disciplinaryactions->findWIthJoins($src);
		} else {
			$employee_violators = $this->disciplinaryactions->getAllWithJoins();	
		}
		
		$disciplinaryactions = $this->disciplinaryactions;

		if (Input::has('jq_ax')){

			$employee_id = (int)  Input::get('employee_id');
			$violation_id = (int) Input::get('violation_id');

			$violations = $this->disciplinaryactions->getEmployeeViolations($employee_id, $violation_id)->get();
			return Response::json($violations);
		}
		
		return View::make('disciplinary_actions.index', compact('employee_violators', 'disciplinaryactions'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /disciplinaryactions/create
	 *
	 * @return Response
	 */
	public function create()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess('employees/disciplinary_actions', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		return View::make('disciplinary_actions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /disciplinaryactions
	 *
	 * @return Response
	 */
	public function store()
	{
		
		// Check access control
		if ( !$this->accessControl->hasAccess('employees/disciplinary_actions', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$post_data = Input::only('violation_id', 'violation_date','violation_effectivity_date','employee_id');
		$work_id = Input::get('employee_work_id');
		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($post_data['violation_id'] == 0) {
			return Redirect::action('DisciplinaryActionsController@create', ['workid' => $work_id,'#employee='. $work_id])
							->withInput()->withErrors('Please select violation!');			
		}

		$violation_count = $this->disciplinaryactions
		                        ->find($post_data['employee_id'], 'employee_id')
		                        ->where('violation_id', '=', $post_data['violation_id'])
		                        ->count();

		 $offense_count = DB::table('violations_offenses')->where('violation_id', '=', $post_data['violation_id'])->count();

		// Limit violation
		if ($violation_count >= $offense_count) {
			
			$message = 'Maximum of ' . $offense_count .' attempts of this violation is allowed.';
			

			// dd($work_id);

			if (Request::ajax()) {
				return Response::json(['message' => $message]);
			} else {
				Session::flash('message', $message);
				return Redirect::action('DisciplinaryActionsController@create', ['workid' => $work_id,'#employee='. $work_id])
							->withInput();			
			}
		}

		if ($post_data['violation_effectivity_date'] == '') unset($post_data['violation_effectivity_date']);

		if ($this->disciplinaryactions->create($post_data)) {
			if (Input::has('ref')) {
				$url = base64_decode(Input::get('ref'));
				return Redirect::to($url);
			} else return Redirect::action('DisciplinaryActionsController@index')->with('message', ['Violation added.']);
		}

		 return Redirect::action('DisciplinaryActionsController@create')->withInputs()->with('error', ['Something went wrong while processing your data. Please try again.']);

	}

	/**
	 * Display the specified resource.
	 * GET /disciplinaryactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess('employees/disciplinary_actions', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		return Redirect::action('DisciplinaryActionsController@edit', $id);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /disciplinaryactions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess('employees/disciplinary_actions', 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$employee_violation =  $this->disciplinaryactions->find($id)->get()->first();

		if (!$employee_violation) Redirect::action('DisciplinaryActionsController@index')->with('message', 'Employee Violation not found.');

		return View::make('disciplinary_actions.edit', compact('employee_violation'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /disciplinaryactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{


		// Check access control
		if ( !$this->accessControl->hasAccess('employees/disciplinary_actions', 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$post_data = Input::only('violation_id', 'violation_date','violation_effectivity_date','employee_id');

		if ($post_data['violation_effectivity_date'] == '') unset($post_data['violation_effectivity_date']);


		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($this->disciplinaryactions->find($id)->update($post_data)) {
			if (Input::has('ref')) {
				$url = base64_decode(Input::get('ref'));
				return Redirect::to($url);
			} else return Redirect::action('DisciplinaryActionsController@index')->with('message', ['Employee violation updated.']);
		}

		 // return read_exif_data()irect::action('DisciplinaryActionsController@edit', $id)->withInputs()->with('error', ['Something went wrong while processing your data. Please try again.']);

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /disciplinaryactions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('employees/disciplinary_actions', 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$id = (int) Input::get('id');


		return $this->disciplinaryactions->find($id)->delete();
	}

}