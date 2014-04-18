<?php namespace Acme\Services\Validation;

class LeaveValidator extends Validator
{
	static $rules = array(
							'employee_id' => 'required',
							'start_date' => 'required|date',
							'end_date' => 'required',
							'type' => 'required',
							'reason' => 'required'
						);

	static $create_rules = array(
							'employee_id' => 'required',
							'start_date' => 'required|date',
							'end_date' => 'required',
							'type' => 'required',
							'reason' => 'required'
						);


	static $update_rules = array(
							'employee_id' => 'required',
							'start_date' => 'required|date',
							'end_date' => 'required',
							'file_date' => 'required|date',
							'type' => 'required',
							'reason' => 'required',
							'approval_date' => 'date'
						);


}


?>