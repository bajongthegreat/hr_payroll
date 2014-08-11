<?php namespace Acme\Composers;

use Acme\Repositories\Employee\EmployeeRepositoryInterface;

class EmployeeComposer {

	protected $employment_status = [  'active' => 'Active',
				                      'inactive' => 'Inactive',
				                      'resigned' => 'Resigned',
				                      'retired' => 'Retired',
				                      'pending' => 'Pending',
									  ];

	protected $membership_status = [ 'applicant' => 'Applicant',
									 'associate' => 'Associate',
	                                 'regular' => 'Regular'];

	protected $marital_status = ['single' => 'Single',
	                           'married' => 'Married',
	                           'divorced' => 'Divorced',
	                           'widowed' => 'Widowed'];

	protected $employees;

	public function __construct(EmployeeRepositoryInterface $employees) {
		$this->employees = $employees;
	}

	public function compose($view) 
	{
		$view->with('employees', $this->employees->all()->lists('name','id'));
	}

	public function employee_status($view) {
		$view->with('employment_status', $this->employment_status);
	}

	public function marital_status($view) {
		$view->with('marital_status', $this->marital_status);
	}

	public function employment_status_create($view) {
	
		$view->with('employment_status', [ 'active' => $this->employment_status['active']]);
	}

	public function membership_status_applicant($view) {


		$view->with('membership_status', ['applicant' => 'Applicant']);
	}

	public function membership_status($view) {
		$membership_status = $this->membership_status;

		unset($membership_status['applicant']);

		$view->with('membership_status', $membership_status);
	}



}