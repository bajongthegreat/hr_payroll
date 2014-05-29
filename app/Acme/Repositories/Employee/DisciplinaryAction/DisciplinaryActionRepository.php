<?php namespace Acme\Repositories\Employee\DisciplinaryAction;

use Acme\Repositories\Employee\DisciplinaryAction\DisciplinaryAction;
use Acme\Repositories\RepositoryAbstract;
use DB;


class DisciplinaryActionRepository extends RepositoryAbstract implements DisciplinaryActionRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	  protected $table= 'disciplinary_actions';
	 
	  /**
	   * Constructor
	   */
	public function __construct(DisciplinaryAction $model)
	{
	    $this->model = $model;
	 }


	 public function getAllWithJoins() {
	 	$table = $this->table;
	 	return DB::table($this->table)
            ->join('employees', "$table.employee_id" , '=', 'employees.id')
            ->leftJoin('positions', "employees.position_id", '=', 'positions.id')
            ->leftJoin('departments', "positions.department_id", '=', 'departments.id')
            ->leftJoin('violations', "$table.violation_id", '=', 'violations.id')
            ->leftJoin('companies', 'employees.company_id', '=', 'companies.id')
            ->select("$table.id", "$table.employee_id", "$table.violation_date", "$table.violation_effectivity_date", "$table.violation_id", 
            	    'employees.lastname', 'employees.firstname', 'employees.middlename', 'employees.employee_work_id',
            	    'positions.name as position',
            	    'departments.name as department',
            	    'violations.code as violation_code',
            	    'violations.penalty as violation_penalty',
            	    'companies.name as company')
            ->get();
	 }

	 public function findViolation($id, $field="id") {
	 	$table = $this->table;
	 	return DB::table($this->table)
	 		->where($field, '=', $id)
            ->join('employees', "$table.employee_id" , '=', 'employees.id')
            ->leftJoin('positions', "employees.position_id", '=', 'positions.id')
            ->leftJoin('departments', "positions.department_id", '=', 'departments.id')
            ->leftJoin('violations', "$table.violation_id", '=', 'violations.id')
            ->leftJoin('companies', 'employees.company_id', '=', 'companies.id')
            ->select("$table.id", "$table.employee_id", "$table.violation_date", "$table.violation_effectivity_date", "$table.violation_id", 
            	    'employees.lastname', 'employees.firstname', 'employees.middlename', 'employees.employee_work_id',
            	    'positions.name as position',
            	    'departments.name as department',
            	    'violations.code as violation_code',
            	    'violations.penalty as violation_penalty',
            	    'companies.name as company')
            ->get();	
	 }

}
