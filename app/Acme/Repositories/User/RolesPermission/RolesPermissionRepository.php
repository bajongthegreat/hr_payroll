<?php namespace Acme\Repositories\User\RolesPermission;

use RolesPermission;
use Acme\Repositories\RepositoryAbstract;

class RolesPermissionRepository extends RepositoryAbstract implements RolesPermissionRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(RolesPermission $model)
	{
	    $this->model = $model;
	 }

}
