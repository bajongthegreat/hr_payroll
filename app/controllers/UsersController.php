<?php

/** 
**FIXES 12/31/13
** -> Injected the Users repository and Validator dependency to this controller
**
** FIXES: 1/1/14
** -> User creation validates if the username and email exists
** -> Search query with sorting and pagination capability implemented
**
** FIXES: 6/3/14
** --> User Repository added old_functions _create and _update
*/


// Use a Repository for Users
use Acme\Repositories\User\UserRepositoryInterface;

// Use a Validation Service
Use Acme\Services\Validation\UserValidator as jValidator;

class UsersController extends BaseController {

	// Items per page
	protected $limit = 10;
	protected $sort_type = 'asc';
	protected $sort_by = 'id';

	protected $users;
	protected $validator;


	
	// TODO: When sorting a search result, it returns all records instead. Fix this

	 /**
     * Instantiate a new UserController instance.
     */
    public function __construct(UserRepositoryInterface $users, jValidator $validator)
    {

    	parent::__construct();

    	// For Cross Site Request Forgery protection
        $this->beforeFilter('csrf', array('on' => 'post'));

   
        // UsersRepository Dependency
        $this->users = $users;
                                                                                                                                  
        // Validation Service Dependency
        $this->validator = $validator;
    }
	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// dd(Session::all)
		// Event::listen('illuminate.query', function ($sql, $bindings, $times) {
		// 	echo '<h3 class="page-header">Database Query</h3>';
		// 		var_dump($sql);
		// });

		// Check access control
		if ( !$this->accessControl->hasAccess('users', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}


		// Search term
		$src = Request::get('src');

		// Sorting stuffs
		$sort_by = (strlen(Request::get('sb')) > 0) ? Request::get('sb') : $this->sort_by;
		$sort_type = (strlen(Request::get('sort')) > 0) ? Request::get('sort') : $this->sort_type;
		
		// Pagination
		$limit = (strlen(Request::get('limit')) > 0) ? Request::get('limit') : $this->limit;


		if (strlen($src) > 0) {	
			$users = $this->users->_search(['username', 'email'], $src, ['paginate' => 10]);
		}
		else {
			$users = $this->users->all(['*'], ['paginate' => $limit]);
		}


        return View::make('users.index', compact('users'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('users', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

        return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('users', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$user_data = Input::only('username', 'password', 'password_confirmation', 'email');

		
		if (!$this->validator->validate($user_data)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		// Attempt to create user
		$new_user = $this->users->_create($user_data, array('fields' => ['status' => 'active'] ,
			                                               'unset' => ['password_confirmation']));

		// Trigger a create method
		//Event::fire('user.create');

		// Send Email
		if (Input::has('send_mail')) {
	
			Mail::send('mail.index', $user_data, function($message) use ($user_data) {
			    $message->to($user_data['email'],'<' . $user_data['username'] . '>')->subject('Welcome to TIBUD HR and Payroll System!');
			});

		}
		
		
			
		return Redirect::to('users');

	
	}

	/**
	*  december03
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{


		// Check access control
		if ( (!$this->accessControl->hasAccess('users', 'view', $this->byPassRoles)) ) {
				
				// Always allow logged user to view their profile
				if (Auth::user()->id == $id) {
					goto loggedUser;
				}

				return  $this->notAccessible();		
		}

		// Goto
		loggedUser:

		// Find the user
		$user = $this->users->find($id)->first();


        return View::make('users.show', compact('user'));
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
		if ( (!$this->accessControl->hasAccess('users', 'edit', $this->byPassRoles)) ) {
				
				// Always allow logged user to view their profile
				if (Auth::user()->id == $id) {
					goto loggedUser;
				}

				return  $this->notAccessible();		
		}

		// Goto
		loggedUser:

		$user = $this->users->find($id)->get()->first();
 
		// Unset the password
		$user->password = "";


        return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user_post = Input::only('password','email','password_confirmation','status');
		$user_data = Input::only('password','email','status', 'role_id');
		$change_password = (strlen($user_post['password']) > 0) ? true : false;

		// Custom Validation message
		$messages = array(
			'password.confirmed' => 'The password confirmation for your new password does not match',
		);



		// Check if we can update the user with an ID specified
		if (!$this->validator->isValidForUpdate($id, $user_post, ['messages' => $messages, 'current_key' => 'email']))
		{
			return Redirect::back()->withInput()->withErrors( $this->validator->errors()  );
		}	
		

		if ($change_password) {
			if ( isset($user_post['password']) && isset($user_post['password_confirmation']) ) {
				if (trim($user_post['password']) != trim($user_post['password_confirmation'])) {
					return Redirect::back()->withInput()->with('errors', ['Password confirmation dont match.']);  
				}	
			}
		}	
		// Update the user
		$this->users->_update($id, $user_data, array('change_password' => $change_password));
		
		// Trigger an update method
		Event::fire('user.update');
		
		return Redirect::route('users.show', array($id));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Delete user
		$this->users->delete($id);

		return Redirect::back();
	}




}
