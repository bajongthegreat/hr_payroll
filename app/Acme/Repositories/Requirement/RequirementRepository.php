<?php namespace Acme\Repositories\Requirement;


use Requirement;
use Acme\Repositories\RepositoryAbstract;

class RequirementRepository extends RepositoryAbstract implements RequirementRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Requirement $model)
	{
	    $this->model = $model;
	 }

}
