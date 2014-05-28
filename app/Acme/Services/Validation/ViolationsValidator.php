<?php namespace Acme\Services\Validation;

class ViolationsValidator extends Validator
{
	static $rules = array(
							'code' => 'required',
							'description' => 'required',
							'penalty' => 'required'
						);

	static $create_rules = array(
							'code' => 'required',
							'description' => 'required',
							'penalty' => 'required'
						);


	static $update_rules = array(
							'code' => 'required',
							'description' => 'required',
							'penalty' => 'required'
						);


}


?>