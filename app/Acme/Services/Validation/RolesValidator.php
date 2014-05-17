<?php namespace Acme\Services\Validation;

class RolesValidator  extends Validator
{
	static $rules = array(
							'name' => 'required|unique:roles'

						);	

	static $create_rules = array(
							'name' => 'required|unique:roles'

						);


	static $update_rules = array(
							'name' => 'required'
						);


}


?>