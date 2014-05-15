<?php namespace Acme\Repositories\Company;

use Company;
use Acme\Repositories\RepositoryAbstract;

class CompanyRepository extends RepositoryAbstract implements CompanyRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Company $model)
	{
	    $this->model = $model;
	 }

}