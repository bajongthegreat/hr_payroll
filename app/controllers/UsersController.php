<?php

/** 
**FIXES 12/31/13
** -> Injected the Users repository and Validator dependency to this controller
**
** FIXES: 1/1/14
** -> User creation validates if the username and email exists
** -> Search query with sorting and pagination capability implemented
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

		// Search term
		$src = Request::get('src');

		// Sorting stuffs
		$sort_by = (strlen(Request::get('sb')) > 0) ? Request::get('sb') : $this->sort_by;
		$sort_type = (strlen(Request::get('sort')) > 0) ? Request::get('sort') : $this->sort_type;
		
		// Pagination
		$limit = (strlen(Request::get('limit')) > 0) ? Request::get('limit') : $this->limit;


		if (strlen($src) > 0) {	
			 // Work more with pagination, were getting close
			 $users = $this->users->search(['email','username','status'], $src , ['paginate' => ['limit' => 10],  'sort' => ['by' => $sort_by, 'type' => $sort_type] ] );
		}
		else {
			$users = $this->users->paginate(NULL, $limit, array('orderBy' => $sort_by, 'orderType' => $sort_type));
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
        return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user_data = Input::only('username', 'password', 'password_confirmation', 'email');

		
		if (!$this->validator->validate($user_data)) {
			return Redirect::back()->withInput()->withErrors($this->validator->errors());
		}

		// Attempt to create user
		$new_user = $this->users->create($user_data, array('fields' => ['status' => 'active'] ,
			                                               'unset' => ['password_confirmation']));

		// Trigger a create method
		//Event::fire('user.create');

		// Check if there's an error while user is being created
		if (isset($new_user['errors'])) return Redirect::back()->withInput()->with('errors', $new_user['errors']);
		
			
		return Redirect::to('users');

	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		// Find the user
		$user = $this->users->find($id);

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
		$user = $this->users->find($id);
 
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

		// Update the user
		$this->users->update($id, $user_post, array('change_password' => $change_password));
		
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
