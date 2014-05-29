<?php

use Acme\Repositories\Violations\ViolationRepositoryInterface;

use Acme\Services\Validation\ViolationsValidator as jValidator;

class ViolationsController extends \BaseController {


	protected $violations;
	protected $validator;

	protected $db_fields_to_use = ['code','description','penalty'];
	protected $default_uri = 'violations';
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(ViolationRepositoryInterface $violations, jValidator $validator)
	    {
	    	parent::__construct();

	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->violations = $violations;

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
			} else {
				$violations = $this->violations->findLike($src, $this->db_fields_to_use);
			}
		} else {

			$violations = $this->violations->getAllWith([]);

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

		$post_data = Input::only('code','description', 'penalty');

		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($this->violations->create($post_data)) {
			return Redirect::action('ViolationsController@index')->with('message', ['Added New Violation']);
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

		$violation = $this->violations->find($id)->get()->first();

		if (!$violation) return Redirect::action('ViolationsController@index')->with('error', ['Violation not found.']);

		return View::make('violations.edit', compact('violation'));
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

		$post_data = Input::only('code','description', 'penalty');

		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($this->violations->find($id)->update($post_data)) {
			return Redirect::action('ViolationsController@index')->with('message', [' Violation edited']);
		}

		 return Redirect::action('ViolationsController@edit')->withInputs()->with('error', ['Something went wrong while processing your data. Please try again.']);

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