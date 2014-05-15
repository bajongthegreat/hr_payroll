<?php namespace Acme\Repositories\StageProcess;

use StageProcess;
use Acme\Repositories\RepositoryAbstract;

class StageProcessRepository extends RepositoryAbstract implements StageProcessRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(StageProcess $model)
	{
	    $this->model = $model;
	 }

	 

}
