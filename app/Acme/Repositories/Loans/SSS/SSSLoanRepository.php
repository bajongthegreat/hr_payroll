<?php namespace Acme\Repositories\Loans\SSS;

use SSS_loan;
use Acme\Repositories\RepositoryAbstract;

class SSSLoanRepository extends RepositoryAbstract implements SSSLoanRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;

	  protected $loan_payment_table = "sss_loans_remittance";
	 
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


	 public function getPayments($loan_id) {
	 	$table = $this->loan_payment_table;

	 	$payments = DB::table($table)->where('sss_loans.sss_loan_id','=', $loan_id)
	 	                 ->leftJoin('sss_loans', 'sss_loans.id', '=', "$table.sss_loan_id")
	 	                 ->sum('amount');

	 	 if (!$payments) return 0;

	 	 return $payments;

	 }

	 public function savePayment($payment_info) {
	 
	 	return DB::table($this->loan_payment_table)->insert($payment_info);

	 }

	 public function updatePayment($id, $payment_info) {
	 
	 	return DB::table($this->loan_payment_table)->find($id)->insert($payment_info);

	 }

	public function getPaymentInfo($id) {
		return DB::table($this->loan_payment_table)->find($id)->first();
	}

	public function allPayments($id = NULL){
		if ($id == NULL) {
			return DB::table($this->loan_payment_table)->get();
		}
		return DB::table($this->loan_payment_table)->find($id)->get();
	}	 

	public function deletePayment($id) {
		return DB::table($this->loan_payment_table)->find($id)->delete();
	}


}

