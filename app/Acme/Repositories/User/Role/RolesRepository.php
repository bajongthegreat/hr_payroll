<?php namespace Acme\Repositories\User\Role;

use Roles;
use Acme\Repositories\RepositoryAbstract;

class RolesRepository extends RepositoryAbstract implements RolesRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Roles $model)
	{
	    $this->model = $model;
	 }

}
