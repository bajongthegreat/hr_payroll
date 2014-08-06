<?php namespace Acme\Repositories\Loans\SSS;

use SSS_loan_payment;
use Acme\Repositories\RepositoryAbstract;

class SSSLoanPaymentRepository extends RepositoryAbstract implements SSSLoanPaymentRepositoryInterface {


	
		  /**
	   		* @var Model
	  	    */
		  protected $model;
		 
		  /**
		   * Constructor
		   */
		public function __construct(SSS_loan_payment $model)
		{
		    $this->model = $model;
		 }
	
	
	


}