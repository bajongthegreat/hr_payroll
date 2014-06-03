<?php

use Acme\Repositories\User\Role\RolesRepositoryInterface;

// Use a Validation Service
use Acme\Services\Validation\RolesValidator as jValidator;

class RolesController extends \BaseController {


	protected $roles;
	protected $validator;
	protected $default_uri='settings/roles';

		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(RolesRepositoryInterface $roles, jValidator $validator)
	    {
	    	parent::__construct();
	    	
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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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


		return Redirect::action('RolesController@index');



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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$role = $this->roles->find($id)->get()->first();

		if (!$role) return Redirect::action('RolesController@index')->with('error', ['No role found with that ID.']);
		$permissions = json_encode($role->permissions()->lists('action_permitted', 'uri_segment'));
		$old_roles = json_encode($role->permissions()->lists('uri_segment', 'id'));

		return View::make('roles.edit', compact('role', 'permissions', 'old_roles'));
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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$errors = [];

		// --------- Data Gathering --------------

		$role = Input::get('name');
		$roles_data = (array) json_decode(Input::get('rolesData'));
		$deleted_uri = json_decode(Input::get('deletedURI'));


		// --------- Validation Area -------------


		if (is_null($roles_data)) {
			$errors[] = 'Role data not set';
		}


		if (count($errors) > 0) return Redirect::back()->with('errors', $errors)->withInput();


		if (!$this->validator->isValidforUpdate($id, ['name' => $role])) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}


		// --------- Database Layer --------------- [ Not should be, extract to repo please..]

		DB::transaction(function() use ($role, $roles_data, $id, $deleted_uri) {

				// Update role name
				try {
						$roleDB = $this->roles->find($id)->update(['name' => $role]);
					} catch (Exception $e) {
						DB::rollback();	
					}				

				foreach($roles_data as $key => $value) {

					
					// Delete all URI on the specified JSON object
					if (count($deleted_uri) > 0) {
						foreach ($deleted_uri as $uri) {
							
							try {
								DB::table('roles_permissions')->where('role_id', '=', $id )
							                                  ->where('uri_segment', '=', $uri)->delete();
							} catch (Exception $e) {
								DB::rollback();	
							}

							
						}
					} 

					// Add newly added uri to this role
					if (is_array($value)) {

						try {
							DB::table('roles_permissions')->insert(['role_id' => $id,
												                    'uri_segment' => $key,
												                    'action_permitted' => implode('|', $value)]);
						} catch (Exception $e) {
							DB::rollback();	
						}
						
					}	

			
				
				}
			
		});

		return Redirect::action('RolesController@edit', $id);
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
		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		return $this->roles->find($id)->delete();
	}

}