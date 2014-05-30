<?php
use Acme\Repositories\Employee\MedicalEstablishment\MedicalEstablishmentRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\MedicalEstablishmentValidator as jValidator;

class MedicalEstablishmentsController extends \BaseController {


	protected $medical_establishments;
	protected $validator;
	protected $default_uri = 'employees/medical_examinations/establishments';
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(MedicalEstablishmentRepositoryInterface $medical_establishments, jValidator $validator)
	    {
	    	parent::__construct();
	    	
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->medical_establishments = $medical_establishments;
	                                                                                                                                  
	        $this->validator = $validator;
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /medicalestablishments
	 *
	 * @return Response
	 */
	public function index()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$medical_establishments = $this->medical_establishments->all();

		return View::make('medical_establishments.index', compact('medical_establishments'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /medicalestablishments/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		return View::make('medical_establishments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /medicalestablishments
	 *
	 * @return Response
	 */
	public function store()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$post_data = Input::only('name','address', 'telephone_number', 'email');


		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($this->medical_establishments->create($post_data)) {
			if (Input::has('ref')) {
				$url = base64_decode(Input::get('ref'));
				
				return Redirect::to($url);
			} else return Redirect::action('MedicalEstablishmentsController@index');
		
		} else {
			return Redirect::back()->withInput()->withErrors(['There was a problem while processing your request. Please try again.']);
		} 
	}

	/**
	 * Display the specified resource.
	 * GET /medicalestablishments/{id}
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
	 * GET /medicalestablishments/{id}/edit
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

		$medical_establishment = $this->medical_establishments->find($id)->get()->first();

		if (!$medical_establishment) {
			return Redirect::action('MedicalEstablishmentsController@index')->with('errors', ['Cannot find the establishment.']);		
		}

		return View::make('medical_establishments.edit', compact('medical_establishment'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /medicalestablishments/{id}
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

		$post_data = Input::only('name','address', 'telephone_number', 'email');


		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($this->medical_establishments->find($id)->update($post_data)) {
			return Redirect::action('MedicalEstablishmentsController@index');
		} else {
			return Redirect::back()->withInput()->withErrors(['There was a problem while processing your request. Please try again.']);
		} 


	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /medicalestablishments/{id}
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

		return $this->medical_establishments->find($id)->delete();
	}

}