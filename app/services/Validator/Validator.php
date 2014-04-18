<?php 

namespace Services\Validators;

abstract class Validator {

	protected $attributes;
	public  $errors;

	function __construct($attributes = null) {
		$this->attributes = $attributes ?: \Input::all();
	}

	public function passes() {

		// Load default validator
		$validation = \Validator::make($this->attributes, static::$rules);

		// Check if validation passes
		if ($validation->passes()) return true;

		// Stack all errors in a variable
		$this->errors  = $validation->messages();

		return false;

	}
}