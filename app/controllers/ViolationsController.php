<?php

use Acme\Repositories\Violations\ViolationRepositoryInterface;
use Acme\Repositories\Violations\Offense\ViolationOffenseRepositoryInterface;

use Acme\Services\Validation\ViolationsValidator as jValidator;

use Carbon\Carbon;
class ViolationsController extends \BaseController {


	protected $violations;
	protected $validator;

	protected $db_fields_to_use = ['code','description'];
	protected $default_uri = 'violations';
	protected $violations_offenses;

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(ViolationRepositoryInterface $violations, 
	    						    ViolationOffenseRepositoryInterface $violations_offenses,
	    						    jValidator $validator)
	    {
	    	parent::__construct();

	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->violations = $violations;
	        $this->violations_offenses = $violations_offenses;

	        $this->validator = $validator;
	                                                                                                                                  
	        
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /violations
	 *
	 * @return Response
	 */
	public function index()
	{	
		

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		// Search
		if (Input::has('src')) {
			
			$src = Input::get('src');

			if (Input::has('field')) {
				
				$field = Input::get('field');

				$violations = $this->violations->find($src, $field)->get()->first();
				// var_dump($violations->toArray());
				$offenses = $this->violations_offenses->find($violations->id, 'violation_id' )->get();
				$violations->offenses = $offenses->toArray();

				// Get how many times an employee violated a specified violation id 
				if (Input::has('employee_id')) {
					$times_committed = DB::table('disciplinary_actions')->where('violation_id', '=',$violations->id)
					                                 ->where('employee_id', '=', (int) Input::get('employee_id'))->count();

					if (!$times_committed) {
						$times_committed = 0;
					}

				} else {
					$times_committed = 0;
				}


				 $offense_count = DB::table('violations_offenses')->where('violation_id', '=', $violations->id)->count();



				$is_warning = false;
				$is_last = false;
				$current_is_warning = false;

				// Next offense
				if ($times_committed < $offense_count) {
					$punishment_type = $this->violations_offenses->find($violations->id, 'violation_id')->where('offense_number', '=', $times_committed + 1)->pluck('punishment_type');

						if ($punishment_type != 'warning') {
							$is_warning = false;
						} else {
							$is_warning = true;
						}
				} else {
					$is_last = true;
					$is_warning = true;
				}

				
				// Current (For editing)
				$current_punishment = $this->violations_offenses->find($violations->id, 'violation_id')->where('offense_number', '=', ($times_committed == 0) ? $times_committed + 1 : $times_committed )->pluck('punishment_type');

					if ($current_punishment != 'warning') {
						$current_is_warning = false;
					} else  $current_is_warning = true;

		

				$violations->times_committed = $times_committed;
				$violations->is_current_a_warning = $current_is_warning;
				$violations->is_next_a_warning = $is_warning;
				$violations->is_last = $is_last;

			} else {
				$violations = $this->violations->findLike($src, $this->db_fields_to_use);
			}
		} else {

			$violations = $this->violations->getAllWith([]);

		}

		if (Input::has('jq_ax')) {

			$id = (int) Input::get('id');


			$offenses = $this->violations_offenses->find($id, 'violation_id' )->get();
			return Response::json($offenses);
		}

		if (Input::has('output')) {
			if (Input::get('output') == 'json') return Response::json($violations);
		}

		
		$violations = $violations->paginate(10);

		return View::make('violations.index', compact('violations'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /violations/create
	 *
	 * @return Response
	 */
	public function create()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}


		return View::make('violations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /violations
	 *
	 * @return Response
	 */
	public function store()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		$offenses_raw = Input::get('offenses');
		$offenses = json_decode($offenses_raw);
		
		if ($offenses == NULL) {
			return Redirect::back()->withInput()->with('errors', ['Offenses not specified. Please try again. If this still exists, contact the developer.']);
		}

	
		$post_data = Input::only('code','description','offenses');

		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}


		try {
			// Remove offenses for different process
			unset($post_data['offenses']);

			// Add violation
			$query = $this->violations->create($post_data);


			foreach ($offenses as $key => $value) {
				# code...
				$query_instance = DB::table('violations_offenses')
												->where('violation_id', '=', $query->id)
				                                ->where('offense_number', '=', $value->offense_number);


				$offense_count_in_db = $query_instance->select(DB::raw('COUNT(*) as count'))
				                                      ->pluck('count');

				// Determine wether to INSERT or UPDATE
				if ($offense_count_in_db && $offense_count_in_db > 0) {


					if ($value->punishment_type == 'warning' && isset($value->days_of_suspension)) {
						$value->days_of_suspension=NULL;
					}

					// UPDATE
					$value->updated_at = Carbon::now();

					$query_instance->update((array) $value);

				} else {

					// INSERT


					if ($value->punishment_type == 'warning' && isset($value->days_of_suspension)) {
						unset($value->days_of_suspension);
					}

					$value->violation_id = $query->id;
					$value->updated_at = Carbon::now();
					$value->created_at = Carbon::now();

					$query_instance->insert( (array) $value);

				}
			}

			if (Input::has('ref')) {
				$url = base64_decode(Input::get('ref'));
				return Redirect::to($url);
			} else  return Redirect::action('ViolationsController@index')->with('message', ['Added New Violation']);
	
		} catch (Exception $e) {
			$error = $e->getMessage();
		}

	
	

		 return Redirect::action('ViolationsController@create')->withInputs()->with('error', ['Something went wrong while processing your data. Please try again.']);

	}

	/**
	 * Display the specified resource.
	 * GET /violations/{id}
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
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /violations/{id}/edit
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

		$violation = $this->violations->find($id, 'violations.id')->get()->first();

		if (!$violation) return Redirect::action('ViolationsController@index')->with('error', ['Violation not found.']);
		$offenses = DB::table('violations_offenses')->where('violation_id', '=', $violation->id)->get();


		return View::make('violations.edit', compact('violation', 'offenses'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /violations/{id}
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

		$post_data = Input::only('code','description', 'offenses');

		$offenses_raw = Input::get('offenses');
		$offenses = json_decode($offenses_raw);
		
		if ($offenses == NULL) {
			return Redirect::back()->withInput()->with('errors', ['Offenses not specified. Please try again. If this still exists, contact the developer.']);
		}


		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		unset($post_data['offenses']);
		try {
			

			$violation = $this->violations->find($id)->update($post_data);


			foreach ($offenses as $key => $value) {
				# code...
				$query_instance = DB::table('violations_offenses')
												->where('violation_id', '=', $id)
				                                ->where('offense_number', '=', $value->offense_number);
				                    // var_dump($value);	

				$offense_count_in_db = $query_instance->select(DB::raw('COUNT(*) as count'))
				                                      ->pluck('count');

				// Determine wether to INSERT or UPDATE
				if ($offense_count_in_db && $offense_count_in_db > 0) {


					if (($value->punishment_type == 'warning' || $value->punishment_type == 'demotion' || $value->punishment_type == 'discharge' ) && isset($value->days_of_suspension)) {
						$value->days_of_suspension=NULL;
					}

					// UPDATE
					$value->updated_at = Carbon::now();

					$query_instance->update((array) $value);

				} else {

					// INSERT


					if ($value->punishment_type == 'warning' && isset($value->days_of_suspension)) {
						unset($value->days_of_suspension);
					}

					$value->violation_id = $id;
					$value->updated_at = Carbon::now();
					$value->created_at = Carbon::now();

					$query_instance->insert( (array) $value);

				}

			}
		} catch (Exception $e) {
			
			 return Redirect::action('ViolationsController@edit')->withInputs()->with('error', ['Something went wrong while processing your data. Please try again.']);

		}


				return Redirect::action('ViolationsController@index')->with('message', [' Violation edited']);

		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /violations/{id}
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

		return $this->violations->find($id)->delete();
	}

}