<?php namespace Acme\Composers;

use Acme\Repositories\Employee\DisciplinaryAction\DisciplinaryActionRepositoryInterface;

class EmployeeViolationsComposer {

	protected $violations;

	public function __construct( DisciplinaryActionRepositoryInterface $violations ) {
		$this->violations = $violations;
	}

	public function compose($view) 
	{
		$violations =  ['Please select rule violated'] + $this->violations->all()->lists('code','id');
		$view->with('violations', $violations);
	}

	public function raw($view) 
	{
		$violations =  $this->violations->all();
		$view->with('violations', $violations);
	}

	public function ViolationsObject($view) {
		$view->with('violations', $this->violations);
	}



}