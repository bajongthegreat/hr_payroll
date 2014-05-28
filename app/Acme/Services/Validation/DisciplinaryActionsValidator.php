<?php namespace Acme\Services\Validation;

class DisciplinaryActionsValidator extends Validator
{
	static $rules = array(
							'employee_id' => 'required|numeric',
							'violation_date' => 'required|date',
							'violation_effectivity_date' => 'date'
						);

	static $create_rules = array(
							'employee_id' => 'required|numeric',
							'violation_date' => 'required|date',
							'violation_effectivity_date' => 'date'
						);


	static $update_rules = array(
							'employee_id' => 'required|numeric',
							'violation_date' => 'required|date',
							'violation_effectivity_date' => 'date'
						);


}


?>