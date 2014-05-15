<?php namespace Acme\Repositories\Company\Department;

use Department;
use Acme\Repositories\RepositoryAbstract;

class DepartmentRepository extends RepositoryAbstract implements DepartmentRepositoryInterface {

	/**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Department $model)
	{
	    $this->model = $model;
	 }

}