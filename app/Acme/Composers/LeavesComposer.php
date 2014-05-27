<?php namespace Acme\Composers;

use Acme\Repositories\Employee\Leave\LeavableInterface;

class LeavesComposer {

	protected $leaves;

	public function __construct(LeavableInterface $leaves) {
		$this->leaves = $leaves;
	}

	public function compose($view) 
	{
		$view->with('leaves', $this->leaves->all()->lists('id'));
	}

	public function raw($view) 
	{
		$view->with('leaves', $this->leaves->all());
	}

	public function leavesObject($view) {
		$view->with('leaves', $this->leaves);
	}

}