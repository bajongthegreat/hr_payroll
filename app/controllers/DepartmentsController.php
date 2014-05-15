<?php

use Acme\Repositories\Company\Department\DepartmentRepositoryInterface;

// What I just did:
//  Removed coupling with Company ID inside the departments table

// Expected effects:
// Departments with references to the company id would have trouble in giving output thus ends up giving an exception.
// Affected areas: departments.index, create, update 

class DepartmentsController extends BaseController {
	
	protected $departments;
	 /**
     * Instantiate a new UserController instance.
     */
    public function __construct(DepartmentRepositoryInterface $departments)
    {
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
		
		
		$departments = $this->departments->all();

		if (Request::get('output') == 'json') {
			return Response::json($departments);
		} 
		



        return View::make('departments.index', compact('departments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('departments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
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
