<?php

class AuthController extends BaseController {

	  /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        $this->afterFilter('log', array('only' =>
                            array('fooAction', 'barAction')));
    }


	public function index() {


		return  (!Auth::check() ) ? View::make('users.login') : Redirect::to('dashboard');
	}

	public function login()
	{
		$user = Input::only('user','password', 'remember_me');
		$account_status= "";
		// Holder of identification type
		$type= NULL;

		// Check if login session needs to be remembered
		$remember_me = (is_null($user['remember_me'])) ? false : true;


		$validation = Validator::make($user, ['user' => 'required',
				                                  'password' => 'required']);

		if ($validation->fails() )
		{
			return Redirect::back()->withInput()->withErrors($validation);
		}



		// Check if it is an email
		if (filter_var($user['user'], FILTER_VALIDATE_EMAIL))
		{
			// Get the status of account
			$account_status = User::where('email', '=', $user['user'])->pluck('status');
			$type="email";
		}
		else 
		{
			// Get the status of account
			$account_status = User::where('username', '=', $user['user'])->pluck('status');
			$type="username";
		}



		if (Auth::attempt(array($type => $user['user'], 'password' => $user['password'], 'status' => 'Active'), $remember_me ))
		{
			$email = User::where($type, '=', $user['user'])->pluck('email');
			Session::put('email', $email);
			
						
			return Redirect::to('dashboard');
		}
		else
		{
			return Redirect::back()->withInput()->with('errors', array('Invalid Username/Email or Password'));
		}


	}



	public function logout()
	{
		if (Auth::check())
		{
			Auth::logout();
			if (Request::ajax() ) return Response::json(['logout' => true]);
		}

		return Redirect::to('/login');
	}

}
