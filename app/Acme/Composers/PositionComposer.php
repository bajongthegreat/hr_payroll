<?php namespace Acme\Composers;

use Acme\Repositories\Company\Position\PositionRepositoryInterface;

class PositionComposer {

	protected $positions;

	public function __construct(PositionRepositoryInterface $positions) {
		$this->positions = $positions;
	}

	public function compose($view) 
	{
		$view->with('positions', $this->positions->all()->lists('id'));
	}

	public function raw($view) 
	{
		$view->with('positions', $this->positions->all());
	}

}