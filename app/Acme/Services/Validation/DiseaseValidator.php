<?php namespace Acme\Services\Validation;

class DiseaseValidator extends Validator
{
	static $rules = array(
							'name' => 'required'
						);

	static $create_rules = array(
							'name' => 'required'
						);


	static $update_rules = array(
							'name' => 'required'
						);


}


?>