<?php namespace Acme\Services\Validation;

class EmployeeValidator extends Validator
{
	static $rules = array(
							'lastname' => 'required',
							'firstname' => 'required',
							'middlename' => 'required',
							'gender' => 'required',
							'birthdate' => 'required|date',
							'sss_id' => array('regex:/^[0-9]{2}-[0-9]{7}-[0-9]{1}$/'),
							'philhealth_id' => array('regex:/^[0-9]{2}-[0-9]{9}-[0-9]{1}$/')
						);	

	static $create_rules = array(
							'lastname' => 'required',
							'firstname' => 'required',
							'middlename' => 'required',
							'gender' => 'required',
							'birthdate' => 'required|date',
							'sss_id' => array('regex:/^[0-9]{2}-[0-9]{7}-[0-9]{1}$/'),
							'philhealth_id' => array('regex:/^[0-9]{2}-[0-9]{9}-[0-9]{1}$/')
						);


	static $update_rules = array(
							
							'lastname' => 'required',
							'firstname' => 'required',
							'middlename' => 'required',
							'gender' => 'required',
							'birthdate' => 'required|date',
							'sss_id' => array('regex:/^[0-9]{2}-[0-9]{7}-[0-9]{1}$/'),
							'philhealth_id' => array('regex:/^[0-9]{2}-[0-9]{9}-[0-9]{1}$/')
						);


}


?>