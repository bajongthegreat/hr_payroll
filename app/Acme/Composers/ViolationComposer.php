<?php namespace Acme\Composers;

use Acme\Repositories\Violations\ViolationRepositoryInterface;
use Acme\Repositories\Violations\Offense\ViolationOffenseRepositoryInterface;
class ViolationComposer {

	protected $violations;
	protected $offenses;

	public function __construct( ViolationRepositoryInterface $violations, ViolationOffenseRepositoryInterface $offenses ) {
		$this->violations = $violations;
		$this->offenses = $offenses;
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

	public function ViolationsOffenseObject($view) {
		$view->with('offense', $this->offenses);
	}

}