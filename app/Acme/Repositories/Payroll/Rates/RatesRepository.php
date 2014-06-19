<?php namespace Acme\Repositories\Payroll\Rates;

use Acme\Repositories\Payroll\Rates\Rates as Rates;
use Acme\Repositories\RepositoryAbstract;
use DB;

class RatesRepository extends RepositoryAbstract implements RatesRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;

	  protected $table = "employees_flat_rates";
	 
	  /**
	   * Constructor
	   */
	public function __construct(Rates $model)
	{
	    $this->model = $model;
	 }


	 public function parentOnly() {
	 	return $this->model->where('parent_id', '=', NULL);
	 }

	 public function getChildren($id) {
	 	return $this->model->where('parent_id', '=', $id);
	 }	
}
