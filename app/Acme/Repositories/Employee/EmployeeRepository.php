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
		// Checks if the first id segment must be a preset
		if (is_null($start))
		{
			$start = rand(1000,9999);
		}

		// Checks if the last id segment must be a preset
		if (is_null($end))
		{
			if ($random) {
				$end = rand(1000,9999);
			} else {

				// Sort employee_work_id in descending order
				// Grab the last item
				$employee = Employee::orderBy('employee_work_id', 'desc')->take(1)->pluck('employee_work_id');

				// Explode the employee_work_id by its separator "-" to make an array 
				$work_id = explode('-', $employee);

				// Grab the ending array item
				$id_right = end($work_id);

				// Increment ID
				$end = $id_right + 1;
			}
		}

		// Generated ID
		$id  = $start . $seperator . $end;
	
		// Check if that ID exist
		$fetched_id = Employee::where('employee_work_id', '=' , $id)->lists('employee_work_id');

		// If ID already existed, run this function again
		if (count($fetched_id) > 0)
		{
			if (!$random) {
				$end += 1;
			}
			
			$id = $this->generate_work_id($start, $end, $seperator);
		}


		return $id;
	}

	

	public function getAllRequirements($id, $db_field="employee_id") {
		return \DB::table($this->pivot_table)->where($db_field, '=', $id )->lists('requirement_id');
	}

}
