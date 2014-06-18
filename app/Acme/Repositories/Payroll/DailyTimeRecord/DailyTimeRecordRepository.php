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

	 public function allGrouped($paginate= 10) {
	 	$table = $this->table;
	 	return DB::table($this->table)->leftJoin('positions', "$table.work_assignment_id", '=', 'positions.id')->groupBy('shift', 'work_date', 'work_assignment_id')->paginate(10);
	 }

	 public function allNotGrouped($paginate = 10) {
	 	$table = $this->table;
	 	return DB::table($this->table)->leftJoin('positions', "$table.work_assignment_id", '=', 'positions.id')
	 								  ->leftJoin('employees', 'employees.id', '=', "$table.employee_id")
	 	                              ->groupBy('employee_id','work_date', 'shift')
	 	                              ->leftJoin('departments', 'departments.id', '=', 'positions.department_id')
				                      ->select("dailytimerecords.id",
				                                	    "dailytimerecords.work_date",
				                                	    "dailytimerecords.shift",
				                                	    "dailytimerecords.time_in_am",
				                                	    "dailytimerecords.time_out_am",
				                                	    "dailytimerecords.time_in_pm",
				                                	    "dailytimerecords.time_out_pm",
				                                	    "dailytimerecords.work_assignment_id",
				                                	    "employees.lastname",
				                                	    "employees.firstname",
				                                	    "employees.middlename",
				                                	    "employees.employee_work_id",
				                                	    "dailytimerecords.remarks",
				                                	    "departments.id as department_id",
				                                	    "positions.id as position_id",
				                                	    'positions.name as work_assignment')->paginate($paginate);
	 }
}
