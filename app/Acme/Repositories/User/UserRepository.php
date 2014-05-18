<?php namespace Acme\Repositories\User;

use User;
use Role;
use Acme\Repositories\RepositoryAbstract;

class UserRepository extends RepositoryAbstract implements UserRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(User $model)
	{
	    $this->model = $model;
	 }

	 public function relativeSearch($src, $filter_params, $db_field_to_use) {
	 	
	 	return $this->findLike($src, $db_field_to_use , [] )->where(function($query) use ($filter_params) {

				if (isset($filter_params)) {
					$this->addFilterFieldsToDB($query, $filter_params);
				}
			
			});
	 }

		


}
