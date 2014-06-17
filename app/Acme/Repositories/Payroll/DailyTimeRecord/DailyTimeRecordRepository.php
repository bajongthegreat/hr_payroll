<?php namespace Acme\Repositories\Payroll\DailyTimeRecord;

use Acme\Repositories\Payroll\DailyTimeRecord\DailyTimeRecord as DTR;
use Acme\Repositories\RepositoryAbstract;
use DB;

class DailyTimeRecordRepository extends RepositoryAbstract implements DailyTimeRecordRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;

	  protected $table = "dailytimerecords";
	 
	  /**
	   * Constructor
	   */
	public function __construct(DTR $model)
	{
	    $this->model = $model;
	 }

	 public function allGrouped() {
	 	$table = $this->table;
	 	return DB::table($this->table)->leftJoin('positions', "$table.work_assignment_id", '=', 'positions.id')->groupBy('shift', 'work_date', 'work_assignment_id')->get();
	 }
}
