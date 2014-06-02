<?php namespace Acme\Repositories\Employee;


use Employee;
use Acme\Repositories\RepositoryAbstract;

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

	 /** Generates unique employee ID
	**
	**	@param string $start [optional]  - The starting pattern to use
	** 	@param string $end [optional] - The ending pattern to use
	**  @param string $seperator [optional] - Used to separate the starting and ending pattern
	**
	**  @return string $id
	*/
	public function generate_work_id($start=NULL, $end=NULL, $seperator="-")
	{	
		// Checks if the first id segment must be a preset
		if (is_null($start))
		{
			$start = rand(1000,9999);
		}

		// Checks if the last id segment must be a preset
		if (is_null($end))
		{
			$end = rand(1000,9999);
		}

		// Generated ID
		$id  = $start . $seperator . $end;
	
		// Check if that ID exist
		$fetched_id = Employee::where('employee_work_id', '=' , $id)->lists('employee_work_id');

		// If ID already existed, run this function again
		if (count($fetched_id) > 0)
		{
			$this->generate_work_id($start, $end, $seperator);
		}


		return $id;
	}

	

	public function getAllRequirements($id, $db_field="employee_id") {
		return \DB::table($this->pivot_table)->where($db_field, '=', $id )->lists('requirement_id');
	}

}
