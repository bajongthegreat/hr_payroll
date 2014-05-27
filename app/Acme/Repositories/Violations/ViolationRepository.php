<?php namespace Acme\Repositories\Violations;

use Violation;
use Acme\Repositories\RepositoryAbstract;

class ViolationRepository extends RepositoryAbstract implements ViolationRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Violation $model)
	{
	    $this->model = $model;
	 }

}
