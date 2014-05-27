<?php namespace Acme\Composers;

use Acme\Repositories\Company\Department\DepartmentRepositoryInterface;

class DepartmentComposer {

	protected $departments;

	public function __construct(DepartmentRepositoryInterface $departments) {
		$this->departments = $departments;
	}

	public function compose($view) 
	{
		$view->with('departments', $this->departments->all()->lists('name','id'));
	}

	public function raw($view) {
		$view->with('departments', $this->departments->all(['name','id']));
	}

	public function all($view) {
		$view->with('departments', $this->departments->all());	
	}
}