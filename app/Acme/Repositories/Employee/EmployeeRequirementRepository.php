<?php namespace Acme\Repositories\Employee;

use DB;

class EmployeeRequirementRepository  implements EmployeeRequirementRepositoryInterface {

	protected $table = 'employee_requirement';

	// Create data
	public function create($data) {
		return DB::table($this->table)->insert($data);
	}

	// Updates data
	public function update($id, $data) {
		return $this->find($id)->update($data);
	}

	// Fetches all data
	public function all($fields = ['*'], $options = array() ){
		return DB::table($this->table);
	}

	// Deletes data
	public function delete($id, $field="id")
	{
		return $this->find($id, $field)->delete();
	}


	// Find specific data
	public function find($id, $field="id") {

		return DB::table($this->table)->where($field, '=', $id);
	}

	
}