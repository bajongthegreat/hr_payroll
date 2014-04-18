<?php

namespace Services\Validators;

class User extends Validator {
	public static $rules = [
		'username' => 'required',
		'email' => 'required|email',
		'password' => 'required|confirmed',

	];

	function __construct($rules = NULL) {
		if (!$rules === NULL)
		{
			$this->rules = $rules;
		}
	}
}