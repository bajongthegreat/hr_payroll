<?php namespace Acme\Repositories\Company\Position;

use Position;
use Acme\Repositories\RepositoryAbstract;

class PositionRepository  extends RepositoryAbstract implements PositionRepositoryInterface{

	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Position $model)
	{
	    $this->model = $model;
	 }

	 
}