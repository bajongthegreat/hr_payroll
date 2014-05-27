<?php

use Acme\Repositories\Employee\MedicalExamination\Disease\DiseaseRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\DiseaseValidator as jValidator;

class DiseasesController extends \BaseController {


	protected $diseases;
	protected $validator;

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(DiseaseRepositoryInterface $diseases, jValidator $validator)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->diseases = $diseases;

	        $this->validator = $validator;
	                                                                                           


	        
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /diseases
	 *
	 * @return Response
	 */
	public function index()
	{
		$diseases = $this->diseases->all();

		return View::make('diseases.index', compact('diseases'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /diseases/create
	 *
	 * @return Response
	 */
	public function create()
	{



		return View::make('diseases.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /diseases
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$post_data = Input::only('name');


		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($this->diseases->create($post_data)) {
			return Redirect::action('DiseasesController@index');
		} else {
			return Redirect::back()->withInput()->withErrors(['There was a problem while processing your request. Please try again.']);
		} 
	}

	/**
	 * Display the specified resource.
	 * GET /diseases/{id}
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
	 * GET /diseases/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$disease = $this->diseases->find($id)->get()->first();

		if (!$disease) {
			return Redirect::action('DiseasesController@index')->with('errors', ['Cannot find disease.']);		
		}

		return View::make('diseases.edit', compact('disease'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /diseases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		$post_data = Input::only('name');


		// Validate Inputs
		if (!$this->validator->validate($post_data, NULL)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		if ($this->diseases->find($id)->update($post_data)) {
			return Redirect::action('DiseasesController@edit', $id)->with('message', ['Disease data updated.']);
		} else {
			return Redirect::back()->withInput()->withErrors(['There was a problem while processing your request. Please try again.']);
		} 
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /diseases/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->diseases->find($id)->delete();
	}

}