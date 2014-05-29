<?php

use Acme\Repositories\Company\Department\DepartmentRepositoryInterface;

// What I just did:
//  Removed coupling with Company ID inside the departments table

// Expected effects:
// Departments with references to the company id would have trouble in giving output thus ends up giving an exception.
// Affected areas: departments.index, create, update 

class DepartmentsController extends BaseController {
	
	protected $departments;
	protected $db_field_to_use = ['name', 'status'];
	 /**
     * Instantiate a new UserController instance.
     */
    public function __construct(DepartmentRepositoryInterface $departments)
    {

    	parent::__construct();
    	// For Cross Site Request Forgery protection
        $this->beforeFilter('csrf', array('on' => 'post'));

   
        // UsersRepository Dependency
        $this->departments = $departments;
                                                                                                                                  
        
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('departments', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		if (Request::has('src')) {
			$src = Input::get('src');
			$departments = DB::table('departments')
			                 ->OrWhere('departments.name', 'LIKE', "%$src%")
			                 ->OrWhere('departments.status', 'LIKE', "%$src%")
			                 ->OrWhere('companies.name', 'LIKE', "%$src%")
			                 ->join('companies', 'companies.id', '=', 'departments.company_id')
			                 ->select('companies.name as company', 'departments.id', 'departments.name', 'departments.status');

		} else {
					$departments = $this->departments->getAllWith([]);

		}

		if (Request::get('output') == 'json') {
			return Response::json($departments);
		}


			$departments = $departments->paginate(10);

        return View::make('departments.index', compact('departments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('departments', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

        return View::make('departments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		// Check access control
		if ( !$this->accessControl->hasAccess('departments', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$new_department = Input::only('name','company_id');

		$new_department['status'] = 'active';

		
		
		$validator = Validator::make( $new_department, ['name' => ['required','min:2'] ]);

		if ($validator->fails() ) {
			return Redirect::back()->withErrors($validator)->withInput();
		} else {
			
			$department =  $this->departments->create($new_department);

			if ($department){
				return Redirect::route('departments.index');
			}
		}
		

		

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
		if ( !$this->accessControl->hasAccess('departments', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

        return View::make('departments.show');
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
		if ( !$this->accessControl->hasAccess('departments', 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$department = $this->departments->find($id)->get()[0];

		
        return View::make('departments.edit', compact(['department']));
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
		if ( !$this->accessControl->hasAccess('departments', 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$new_department = array();
		$new_department = Input::only('name','status','company_id');

		



		$department = $this->departments->update($id, $new_department);

		if ($department){
			return Redirect::route('departments.index');
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
		if ( !$this->accessControl->hasAccess('departments', 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$department = $this->departments->delete($id);

		if ($department){
			return Redirect::route('departments.index');
		}
	}


	public function departmentsByCompany() {

			$company_id = (int) Input::get('id');
			
			$departments =  $this->departments->find($company_id, 'company_id')->lists('name','id') ;
			

			$departments += (count($departments) == 0) ? ['No departments available'] :['Select department'];

			if ($departments) return Response::json($departments);
			else return Response::json([]);
	}

}
