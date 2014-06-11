<?php namespace Acme\Services\Validation;

class DailyTimeRecordValidator extends Validator {

	static $rules = array(
							'employee_id' => 'required|numeric',
							'work_date' => 'required|date'
						);

	static $create_rules = array(
							'employee_id' => 'required|numeric',
							'work_date' => 'required|date'
						);


	static $update_rules = array(	
							'employee_id' => 'required|numeric',
							'work_date' => 'required|date'
						);

}

?>