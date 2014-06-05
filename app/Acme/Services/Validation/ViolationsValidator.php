<?php namespace Acme\Services\Validation;

class ViolationsValidator extends Validator
{
	static $rules = array(
							'code' => 'required',
							'description' => 'required',
							'offenses' => 'required'
						);

	static $create_rules = array(
							'code' => 'required',
							'description' => 'required',
							'offenses' => 'required'
						);


	static $update_rules = array(
							'code' => 'required',
							'description' => 'required',
							'offenses' => 'required'
						);


}


?>