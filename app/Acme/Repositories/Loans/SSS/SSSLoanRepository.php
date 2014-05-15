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

}

