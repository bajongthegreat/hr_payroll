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

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\User\Role\RolesRepositoryInterface',
		    'Acme\Repositories\User\Role\RolesRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\User\RolesPermission\RolesPermissionRepositoryInterface',
		    'Acme\Repositories\User\RolesPermission\RolesPermissionRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Employee\MedicalExamination\EmployeePhysicalExaminationRepositoryInterface',
		    'Acme\Repositories\Employee\MedicalExamination\EmployeePhysicalExaminationRepository'
		);		

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Employee\MedicalEstablishment\MedicalEstablishmentRepositoryInterface',
		    'Acme\Repositories\Employee\MedicalEstablishment\MedicalEstablishmentRepository'
		);		
		
		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Employee\MedicalExamination\Disease\DiseaseRepositoryInterface',
		    'Acme\Repositories\Employee\MedicalExamination\Disease\DiseaseRepository'
		);	


		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Violations\ViolationRepositoryInterface',
		    'Acme\Repositories\Violations\ViolationRepository'
		);	

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Employee\DisciplinaryAction\DisciplinaryActionRepositoryInterface',
		    'Acme\Repositories\Employee\DisciplinaryAction\DisciplinaryActionRepository'
		);	

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Payroll\DailyTimeRecord\DailyTimeRecordRepositoryInterface',
		    'Acme\Repositories\Payroll\DailyTimeRecord\DailyTimeRecordRepository'
		);

		// Bind the CompanyInterface into the class CompanyRepository
		$this->app->bind(
			'Acme\Repositories\Payroll\Rates\RatesRepositoryInterface',
		    'Acme\Repositories\Payroll\Rates\RatesRepository'
		);	

	}
}