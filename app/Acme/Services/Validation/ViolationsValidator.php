<?php namespace Acme\Services\Validation;

class ViolationsValidator extends Validator
{
	static $rules = array(
							'code' => 'required',
							'description' => 'required',
							'first_offense' => 'required'
						);

	static $create_rules = array(
							'code' => 'required',
							'description' => 'required',
							'first_offense' => 'required'
						);


	static $update_rules = array(
							'code' => 'required',
							'description' => 'required',
							'first_offense' => 'required'
						);


}


?>