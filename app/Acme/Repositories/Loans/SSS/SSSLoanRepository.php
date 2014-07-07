<?php namespace Acme\Repositories\Loans\SSS;

use SSS_loan;
use Acme\Repositories\RepositoryAbstract;

class SSSLoanRepository extends RepositoryAbstract implements SSSLoanRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(SSS_Loan $model)
	{
	    $this->model = $model;
	 }

	 public function all_with_employee() {
	 	return $this->model
	 				->where('employees.employment_status', '=', 'active')
	 	            ->leftJoin('employees', 'employees.id','=', 'sss_loans.employee_id')
	 	            ->select('sss_loans.*', 'employees.sss_id', 'employees.firstname', 'employees.lastname', 'employees.middlename', 'employees.name_extension', 'employees.employee_work_id')
	 	            ->get();
	 }

}

