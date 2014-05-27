<?php namespace Acme\Repositories\Employee\MedicalExamination\Disease;

use Acme\Repositories\Employee\MedicalExamination\Disease\Disease;
use Acme\Repositories\RepositoryAbstract;

class DiseaseRepository extends RepositoryAbstract implements DiseaseRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(Disease $model)
	{
	    $this->model = $model;
	 }

}
