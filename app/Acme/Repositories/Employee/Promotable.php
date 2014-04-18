<?php namespace Acme\Repositories\Employee;

interface Promotable {

	// Promotes an employee
	public function promote($employee_id, $position_id );

}


?>