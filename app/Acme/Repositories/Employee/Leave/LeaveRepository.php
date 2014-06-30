<?php namespace Acme\Repositories\Employee\Leave;


/*** Author: James Norman Mones Jr.
**   Date: June 2014
**/

use Leave;
use Employee;

//  Doesn't follow standard repo interface
class LeaveRepository implements LeavableInterface {

	/**
	 * Get all leaves
	 *
	 * @param array $options
	 */
	public function get($options = []) {


		// Paginated Result
		if (isset($options['paginate'])) {
			$leaves = Leave::orderBy('id', 'asc')->paginate($options['paginate']);
		} else {
			$leaves = Leave::with('Employee')->get();;
		}

		return $leaves;
	}

	/**
	 * Find all leaves of an employee
	 *
	 * @param integer $id
	 * @param string $field
	 */
	public function find_by_employee_id($id, $field='employee_id') {

		return $this->find($id, $field);

	}

	/**
	 * Find specific leave
	 *
	 * @param integer $id
	 * @param string $field
	 */
	public function find($id, $field='id') {

		return Leave::with('Employee')->where($field ,'=', $id)->get();

	}

	/**
	 * Employee files a leave
	 *
	 * @param array $data
	 */
	public function file($data) {
		return Leave::create($data);;
	}


	/**
	 * Deletes leave data
	 *
	 * @param int $leave_id
	 */
	public function delete($leave_id) {
		return false;
	}





	/**
	 * Approves leave application
	 *
	 * @param int $leave_id
	 * @param int $employee_id
	 */

	public function approve($leave_id, $data){

		if (!is_array($data)) throw new \Exception('Data type of $data must be array.');

		$data['status'] = 'Approved';

		return $this->update($leave_id, $data);

	}

	/**
	 * Rejects leave application
	 *
	 * @param int $leave_id
	 * @param int $employee_id
	 */

	public function reject($leave_id, $data){

		if (!is_array($data)) throw new \Exception('Data type of $data must be array.');

		$data['status'] = 'Denied';

		return $this->update($leave_id, $data);

	}


	/**
	 * Cancels leave application
	 *
	 * @param int $leave_id
	 * @param int $employee_id
	 */

	public function cancel($leave_id, $data){

		if (!is_array($data)) throw new \Exception('Data type of $data must be array.');

		$data['status'] = 'Cancelled';

		return $this->update($leave_id, $data);

	}

	/**
	 * Updates leave data
	 *
	 * @param int $leave_id
	 * @param array $data
	 */
	public function update($leave_id, $data) {
		return Leave::where('id', '=', $leave_id)->update($data);
	}


}