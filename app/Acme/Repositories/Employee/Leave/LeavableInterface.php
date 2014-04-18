<?php namespace Acme\Repositories\Employee\Leave;



interface LeavableInterface {

	
	/**
	 * Employee files a leave
	 *
	 * @param array $data
	 */
	public function file($data);

	/**
	 * Approves leave application
	 *
	 * @param int $leave_id
	 * @param int $employee_id
	 */

	public function approve($leave_id, $data);

	/**
	 * Gets all accumulated leave credits of an employee
	 *
	 * @param int $employee_id
	 */

	// public function getTotalLeaveCredits($employee_id);

}


?>