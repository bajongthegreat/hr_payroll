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
	 
	 	/* 
	 	SELECT * 
		FROM disciplinary_actions
		LEFT OUTER JOIN violations ON violations.id = disciplinary_actions.violation_id

		WHERE employee_id =6 AND ( TIMESTAMPDIFF(YEAR, '2009-01-01', CURDATE() ) )  <= violations.period_before_reset
	*/

	 	$penalty = $this->model->where('offense_number', '=', $times_committed)
	 	                       ->where('violation_id', '=', $violation_id)
	 	                       ->first(['punishment_type','days_of_suspension']);

	 	 return $penalty;
	 }

}
