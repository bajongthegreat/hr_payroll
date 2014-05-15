<?php namespace Acme\Repositories\Holiday;

use Acme\Repositories\Holiday\Holiday;
use Acme\Repositories\RepositoryAbstract;

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

}
