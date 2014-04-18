<?php namespace Acme\Repositories\Employee;

use Employee;

// TODO: ADD EMPLOYMENT REQUIREMENTS
// TODO: ADD MORE FIELDS


class EmployeeRepository implements EmployeeRepositoryInterface
{

	/** Finds an employee into the database
	**
	**	@param string $query
	** 	@param array $options
	**
	**  @return collection $employees
	*/
	public function find($query, $options = array() )
	{
		// Absolute way of searching records
		if (isset($options['type']) && $options['type'] == 'absolute') {

			$employees = Employee::where('employee_work_id', '=', $query);

		} else {  // Relative way of searching.
			

				$employees = Employee::where('employee_work_id', 'LIKE', "%$query%")
		              ->orWhere(function($sql) use ($query) {
		      
		              		  $sql->orWhere('firstname', 'LIKE', "%$query%")
		              		      ->orWhere('middlename', 'LIKE', "%$query%")
		              		      ->orWhere('lastname', 'LIKE', "%$query%")
		              		      ->orWhere('marital_status', 'LIKE', "%$query%")
		              		      ->orWhere('address', 'LIKE', "%$query%");
		              
		              });
		}
	

		         if (isset($options['limit']) && $options['limit'] != "NULL") {
		         	$employees->take($options['limit']);
		         }
		         
		return $employees->get();
	}

	/** Adds an employee into the database
	**
	**	@param array $profile - Holds all employee information
	** 	@param array $options - Extra actions to do while adding employee
	**
	**  @return collection $employee
	*/
	public function register($profile, $options= array() )
	{
		// Add additional fields
		if (isset($options['fields']))
		{
			foreach($options['fields'] as $field => $value)
			{	
				// Filter the fields you don't want to include
				if (!empty($options['dont_include']))
				{
					if (in_array($field, $options['dont_include'])) continue;
				}

				$profile[$field] = $value;
			}
		}

		return Employee::create($profile);
	}

	/** Updates employee profile in the database
	**
	**	@param integer $id - ID of employee to update
	** 	@param array $new_profile - Holds all new informations of the employee
	**
	**  @return collection $employee
	*/
	public function updateProfile($id, $new_profile)
	{
		if (!is_array($new_profile)) 
		{
			throw new Exception('To update a profile, the container must be an array.');
		}

		return Employee::where('employee_work_id', '=',$id)->update($new_profile);
	}

	
	/** Gets employee profile from the database
	**
	**	@param string $id - ID of employee to fetch
	** 	@param array $field - Column name to use in verifying the ID
	**
	**  @return collection $employee
	*/
	public function getProfile($id, $field = "")
	{
		if ($field != "") {
			$employee = Employee::with('position')->where('employee_work_id', '=', $id)->get();

			if (count($employee) == 1) $employee = $employee[0];
			else {
				$employee = false;
			}
		}
		else {
			$employee = Employee::with('position')->where('employee_work_id', '=', $id);	
		}

		return $employee;
		
	}

	/** Fetch all employee profiles
	**
	** 	@param array $options - Extra actions to do while fetching employees
	**
	**  @return collection $employee
	*/
	public function all($options = array())
	{
		$employees = Employee::with(['position']);

		if (isset($options['limit'])) {

			return $employees->paginate($options['limit']);

		} else {
			return $employees->get();
		}

		
	}

	/** Terminates an employee
	**
	**	@param string $id - ID of the employee to be terminated
	** 	@param boolean $permanent - Set if the employee will be permanently deleted
	**
	**  @return collection $employee
	*/
	public function terminate($id, $permanent=false, $field="id")
	{

		// If softDelete is enabled, it will be transfered into trash otherwise it will be removed completely in the DB.
		$deleted_user = Employee::where($field, '=', $id)->delete();

		// Delete it from trash
		if ($permanent)
		{
			
			try
			{
				$deleted_user = Employee::withTrashed()->where($field, '=', $id)->delete();	
			}
			catch(Exception $e)
			{
				print('Cannot delete it from trash. Source:' . $e->getMessage() );
			}
			
		}

		return $deleted_user;
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
			$start = rand(100,999);
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

	

}
