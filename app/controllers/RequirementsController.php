<?php 

use Acme\Repositories\Requirement\RequirementRepositoryInterface;
use  Acme\Services\Validation\RequirementValidator as jValidator;

class RequirementsController extends BaseController {

	protected $requirements;
	protected $validator;
	protected $db_fields_to_use = ['document','document_type'];
	protected $default_uri = 'requirements';

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(RequirementRepositoryInterface $requirements, jValidator $validator)
	    {

	    	parent::__construct();

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		if (Request::has('src')) {
			$src = Input::get('src');

			$requirements = $this->requirements->findLike($src, $this->db_fields_to_use);
		} else {

			$requirements = $this->requirements->getAllWith(['stageProcess']);
		
		}

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

		$requirements = $requirements->paginate(10);

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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

        return View::make('requirements.create');
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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$RequirementsController = $this->requirements->find($id)->delete(); 
		return Redirect::action("RequirementsController@index");
	}

}
