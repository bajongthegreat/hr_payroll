<?php namespace Acme\Repositories\Employee\MedicalEstablishment;


/*** Author: James Norman Mones Jr.
**   Date: June 2014
**/

use Acme\Repositories\Employee\MedicalEstablishment\MedicalEstablishment;
use Acme\Repositories\RepositoryAbstract;

class MedicalEstablishmentRepository extends RepositoryAbstract implements MedicalEstablishmentRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(MedicalEstablishment $model)
	{
	    $this->model = $model;
	 }

}
