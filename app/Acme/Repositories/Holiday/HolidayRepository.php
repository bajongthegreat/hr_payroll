<?php namespace Acme\Repositories\Holiday;

use Acme\Repositories\Holiday\Holiday;
use Acme\Repositories\RepositoryAbstract;
use DB;

class HolidayRepository extends RepositoryAbstract implements HolidayRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Holiday $model)
	{
	    $this->model = $model;
	 }

	 public function byYear($year) {
	 	return $this->model->where(DB::raw('YEAR(holiday_date)'), '=', $year);	
	 }

	 public function byType($type) {
	 	return $this->model->find($type, 'type');
	 }
}
