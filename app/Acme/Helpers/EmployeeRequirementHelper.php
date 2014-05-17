<?php namespace Acme\Helpers;

use Carbon\Carbon;
use Acme\Repositories\Employee\EmployeeRequirementRepository as EmployeeRequirement;

class EmployeeRequirementHelper {


	protected $employee_requirement;
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct()
	    {
	    	
	        // UsersRepository Dependency
	        $this->employee_requirement = new EmployeeRequirement;
	                                                                                                                                  
	        
	    }
	

	public function isRequirementPassed($requirement_id, $employee_id) {
		$employee_requirement = $this->employee_requirement->find($requirement_id, 'requirement_id')->where('employee_id','=', $employee_id)->get(['id']);

		return (count($employee_requirement) == 1) ? true : false;
		// return 'demp';
	}

	public function areAllRequirementsPassed() {
		return $this->employee_requirement->find($requirement_id, 'requirement_id');
	}

}