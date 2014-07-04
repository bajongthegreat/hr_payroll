<?php namespace Acme\Repositories\Violations\Offense;

use Acme\Repositories\Violations\Offense\ViolationOffense;
use Acme\Repositories\RepositoryAbstract;

class ViolationOffenseRepository extends RepositoryAbstract implements ViolationOffenseRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(ViolationOffense $model)
	{
	    $this->model = $model;
	 }

	 public function getPenalty($violation_id, $times_committed) {
	 	$penalty = $this->model->where('offense_number', '=', $times_committed)
	 	            ->where('violation_id', '=', $violation_id)
	 	            ->first(['punishment_type','days_of_suspension']);

	 	 return $penalty;
	 }

}
