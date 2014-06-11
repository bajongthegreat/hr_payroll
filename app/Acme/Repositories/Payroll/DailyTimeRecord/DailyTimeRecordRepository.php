<?php namespace Acme\Repositories\Payroll\DailyTimeRecord;

use Acme\Repositories\Payroll\DailyTimeRecord\DailyTimeRecord as DTR;
use Acme\Repositories\RepositoryAbstract;

class DailyTimeRecordRepository extends RepositoryAbstract implements DailyTimeRecordRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;

	  protected $table = "dailytimerecord";
	 
	  /**
	   * Constructor
	   */
	public function __construct(DTR $model)
	{
	    $this->model = $model;
	 }

}
