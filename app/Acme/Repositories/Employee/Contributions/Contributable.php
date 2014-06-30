<?php namespace Acme\Repositories\Employee\Contributions;

/*** Author: James Norman Mones Jr.
**   Date: June 2014
**/

abstract class Contributable {

	/** Gets Employee contribution share
	**
	**	@param double $salary - Salary of employee
	**
	**  @return double $value
	*/
	public function getEmployeeShare($salary)
	{
		$contributions = $this->getContributions();

		
		foreach ($contributions as $key => $value) {
		
			if ($salary <= $value['salary_range_end'] && $salary >= $value['salary_range_start'])
			{
				return $value['employee_share'];
			}
			
		}
		return 0;
	}

	/** Gets Employer contribution share
	**
	**	@param double $salary - Salary of employee
	**
	**  @return double $value
	*/
	public function getEmployerShare($salary)
	{
		$contributions = $this->getContributions();


		foreach ($contributions as $key => $value) {
		
			if ($salary <= $value['salary_range_end'] && $salary >= $value['salary_range_start'])
			{
				return $value['employer_share'];
			}
			
		}
		return 0;
	}

}