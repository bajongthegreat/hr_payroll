<?php namespace Acme\Repositories\Employee;


/*** Author: James Norman Mones Jr.
**   Date: June 2014
**/

/*

Delete Duplicates

CREATE TABLE employees_verify AS SELECT DISTINCT  FROM employees;

DELETE FROM employees;

INSERT INTO employees SELECT * FROM employees_verify;

DROP TABLE employees_verify;

*/

use Employee;
use Acme\Repositories\RepositoryAbstract;
use DB;

class EmployeeRepository extends RepositoryAbstract implements EmployeeRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	  protected $table = "employees";
	  protected $pivot_table = "employee_requirement";
	 
	  /**
	   * Constructor
	   */
	public function __construct(Employee $model)
	{
	    $this->model = $model;
	 }

	 public function notApplicant() {
	 	return $this->model->where('membership_status', '!=', 'applicant');
	 }

	 public function removeDuplicates() {
	 	return DB::statement('
	 		CREATE TABLE employees_verify AS SELECT DISTICT * FROM employees;

	 		DELETE FROM employees;

	 		INSERT INTO employees SELET * FROM employees_verify;

	 		DROP TABLE employees_verify;
	 		');
	 }

	 public function profile($id, $field = 'employee_work_id') {
	 	return $this->model->where($field, '=', $id)->leftJoin('positions', 'positions.id', '=', 'employees.position_id')
	 	                              ->leftJoin('departments','departments.id', '=', 'positions.department_id')
	 	                              ->select('employees.*', DB::raw(' CONCAT_WS(" ", COALESCE(employees.firstname, NULL), COALESCE(employees.middlename, NULL), COALESCE(employees.lastname, NULL), COALESCE(employees.name_extension, NULL)) as fullname ') ,
	 	                                       'departments.name as department_name','departments.id as department_id', 'positions.name as position_name')
	 	                              ->first();
	 }

	 public function getFullName($id) {
	 	$employee = $this->model->where('employee_work_id', '=', $id)->first(['lastname','firstname','middlename','name_extension']);	

	 	$lastname = isset($employee->lastname) ? ucfirst($employee->lastname) : '';
	 	$middlename = isset($employee->middlename) ? ucfirst($employee->middlename) : '';
	 	$firstname = isset($employee->firstname) ? ucfirst($employee->firstname) : '';

	 	$name_extension = isset($employee->name_extension) && $employee->name_extension != 'None'  && $employee->name_extension != "" ? ucfirst($employee->name_extension) . '.' : '';

	 	// return $employee;

	 	return $firstname . ' ' . $middlename . ' ' . $lastname . ' ' . $name_extension;


	 }

	 /** Generates unique employee ID
	**
	**	@param string $start [optional]  - The starting pattern to use
	** 	@param string $end [optional] - The ending pattern to use
	**  @param string $seperator [optional] - Used to separate the starting and ending pattern
	**
	**  @return string $id
	*/
	public function generate_work_id($start=NULL, $end=NULL, $seperator="-", $random=true)
	{	
		if (is_null($start)) {
			$applicable_id_start = [9520, 2370, 9620, 9720];
			$start = $applicable_id_start[rand(0,3)];
		}

		if (is_null($end)){

			if ($random == true) {
				$end = rand(1000, 9999);
			}
			else {

				$last_id = Employee::orderBy('employee_work_id', 'desc')->take(1)->pluck('employee_work_id');
				
				$last_id = explode('-', $last_id);
				
				$end = end($last_id);
			}

		}

			$id = $start . $seperator . $end;

			while (true) {
				
				if (Employee::where('employee_work_id', '=', $id)->count() == 1) {
					$id = $start . $seperator . ($end + 1);					
				} else {
					break;
				}
			}

		return $id;
	}

	

	public function getAllRequirements($id, $db_field="employee_id") {
		return \DB::table($this->pivot_table)->where($db_field, '=', $id )->lists('requirement_id');
	}

}
