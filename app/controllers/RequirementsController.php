<?php 

use Acme\Repositories\Requirement\RequirementRepositoryInterface;
use  Acme\Services\Validation\RequirementValidator as jValidator;

class RequirementsController extends BaseController {

	protected $requirements;
	protected $validator;

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(RequirementRepositoryInterface $requirements, jValidator $validator)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->requirements = $requirements;
	                                                                                                                                  
	        // Validator Service Repository
	        $this->validator = $validator;
	    }
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$requirements = $this->requirements->all();

		if (Request::get('output') == 'json') {

			if (Request::get('select')) {

				if (Request::get('id')) 
				{
					$id = Request::get('id');
					$requirements = $this->getByStageProcessID($id);
				}
				else 
				{
					$requirements = ['Please select requirement.'] + $requirements->lists('document','id');
				}
				
			}

			return Response::json($requirements);
		}

        return View::make('requirements.index', compact('requirements'));
	}

	public function getByStageProcessID($id) {
		return $this->requirements->find($id, 'stage_process_id')->lists('document','id');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('requirements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
		
		$input = Input::all();
		
		// Validate Inputs
		if ($this->validator->validate($input)) {
		
			$this->requirements->create($input);
			
			return Redirect::route('requirements.index');
		
		
		}

		return Redirect::route('requirements.create')
					->withInput()
					->withErrors($this->validator->errors())
					->with('message', ['error' => 'There were validation errors.']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$requirements = $this->requirements->find($id)->get();

        return View::make('requirements.show', compact('requirements'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$requirement = $this->requirements->find($id)->get()[0];



        return View::make('requirements.edit', compact('requirement'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::except('_method','_token');

		// Validate Inputs
		if ($this->validator->isValidForUpdate(NULL, $input)) {
		
			$this->requirements->find($id)->update($input);
			
			return Redirect::route('requirements.edit',$id);
		
		
		}



		return Redirect::action('requirements.edit', $id)
					->withInput()
					->withErrors($this->validator->errors())
					->with('message', ['error' => 'There were validation errors.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$RequirementsController = $this->requirements->find($id)->get(); 
		return Redirect::action("RequirementsController@index");
	}

}
