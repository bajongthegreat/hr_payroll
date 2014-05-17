<?php

use Acme\Repositories\User\Role\RolesRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\RolesValidator as jValidator;

class RolesController extends \BaseController {


	protected $roles;
	protected $validator;

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(RolesRepositoryInterface $roles, jValidator $validator)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->roles = $roles;
	        $this->validator = $validator;
	                                                                                                                                  
	        
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /roles
	 *
	 * @return Response
	 */
	public function index()
	{
		$roles = $this->roles->all();

		return View::make('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /roles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /roles
	 *
	 * @return Response
	 */
	public function store()
	{
		$errors = [];

		// --------- Data Gathering --------------

		$role = Input::get('name');
		$roles_data = json_decode(Input::get('rolesData'));


		// --------- Validation Area -------------


		if (is_null($roles_data)) {
			$errors[] = 'Role data not set';
		}


		if (count($errors) > 0) return Redirect::back()->with('errors', $errors)->withInput();


		if (!$this->validator->isValideForCreation(['name' => $role])) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}


		// --------- Database Layer --------------- [ Not should be, extract to repo please..]

		DB::transaction(function() use ($role, $roles_data) {

			try {
				$roleDB = DB::table('roles')->insertGetId(['name' => $role]);

			} catch (Exception $e) {
				
				 DB::rollback();
				 return Redirect::to('/settings/roles')
				        ->withErrors( $e->getErrors() )
				        ->withInput();
			}
			

			if ($roleDB) {
				foreach($roles_data as $key => $value) {

					try {
						DB::table('roles_permissions')->insert(['role_id' => $roleDB,
												                'uri_segment' => $key,
												                'action_permitted' => implode('|', $value)]);
					} catch (Exception $e) {   
						DB::rollback();
					}
 
				}
			}
		});


		// return Redirect::action('RolesController@index');



	}

	/**
	 * Display the specified resource.
	 * GET /roles/{id}
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
	 * GET /roles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /roles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}