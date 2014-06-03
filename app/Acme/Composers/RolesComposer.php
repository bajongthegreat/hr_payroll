<?php namespace Acme\Composers;

use Acme\Repositories\User\Role\RolesRepositoryInterface;

class RolesComposer {

	protected $roles;

	public function __construct(RolesRepositoryInterface $roles) {
		$this->roles = $roles;
	}

	public function compose($view) 
	{
		$roles =  ['Super user'] + $this->roles->all()->lists('name','id');
		$view->with('roles', $roles);
	}

	public function raw($view) 
	{
		$roles =  $this->roles->all();
		$view->with('roles', $roles);
	}



}