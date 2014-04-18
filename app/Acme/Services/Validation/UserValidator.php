<?php namespace Acme\Services\Validation;

class UserValidator extends Validator
{
	static $rules = array(
							'username' => 'required|unique:users',
							'email' => 'required|email|unique:users',
							'password' => 'required|confirmed'
						);

	static $create_rules = array(
							'username' => 'required|unique:users',
							'email' => 'required|email|unique:users',
							'password' => 'required|confirmed'
						);


	static $update_rules = array(
							'email' => 'email|required|unique:users',
							'password_confirmation' => 'required_with:password'
						);


}


?>