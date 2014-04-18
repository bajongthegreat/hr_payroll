<?php namespace Acme\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
	public function register()
	{
		// Bind the UserRepositoryInterface into the class UserRepository
		$this->app->bind(
			'Acme\Repositories\User\UserRepositoryInterface',
		    'Acme\Repositories\User\UserRepository'
		);

		// Bind the MemberRepositoryInterface into the class MemberRepository
		$this->app->bind(
			'Acme\Repositories\Employee\EmployeeRepositoryInterface',
		    'Acme\Repositories\Employee\EmployeeRepository'
		);


		// Bind the MemberRepositoryInterface into the class MemberRepository
		$this->app->bind(
			'Acme\Repositories\Employee\Contributions\ContributableInterface',
		    'Acme\Repositories\Employee\Contributions\HDMFRepository'
		);


		// Bind the MemberRepositoryInterface into the class MemberRepository
		$this->app->bind(
			'Acme\Repositories\Employee\Leave\LeavableInterface',
		    'Acme\Repositories\Employee\Leave\LeaveRepository'
		);

				
	}
}