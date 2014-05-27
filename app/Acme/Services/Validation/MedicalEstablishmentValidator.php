<?php namespace Acme\Services\Validation;

class MedicalEstablishmentValidator extends Validator
{
	static $rules = array(
							'name' => 'required',
							'address' => 'required',
							'telephone' => 'numeric',
							'email' => 'email'
						);

	static $create_rules = array(
							'name' => 'required',
							'address' => 'required',
							'telephone' => 'numeric',
							'email' => 'email'
						);


	static $update_rules = array(
							'name' => 'required',
							'address' => 'required',
							'telephone' => 'numeric',
							'email' => 'email'
						);


}


?>