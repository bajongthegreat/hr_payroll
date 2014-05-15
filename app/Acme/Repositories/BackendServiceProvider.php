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

		// Bind the PositionInterface into the class PositionRepository
		$this->app->bind(
			'Acme\Repositories\Company\Position\PositionRepositoryInterface',
		    'Acme\Repositories\Company\Position\PositionRepository'
		);

		// Bind the DepartmentInterface into the class DepartmentRepository
		$this->app->bind(
			'Acme\Repositories\Company\Department\DepartmentRepositoryInterface',
		    'Acme\Repositories\Company\Department\DepartmentRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Company\CompanyRepositoryInterface',
		    'Acme\Repositories\Company\CompanyRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Loans\SSS\SSSLoanRepositoryInterface',
		    'Acme\Repositories\Loans\SSS\SSSLoanRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Requirement\RequirementRepositoryInterface',
		    'Acme\Repositories\Requirement\RequirementRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\StageProcess\StageProcessRepositoryInterface',
		    'Acme\Repositories\StageProcess\StageProcessRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Employee\EmployeeRequirementRepositoryInterface',
		    'Acme\Repositories\Employee\EmployeeRequirementRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Holiday\HolidayRepositoryInterface',
		    'Acme\Repositories\Holiday\HolidayRepository'
		);


				
	}
}