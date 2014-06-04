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

       public function getOffensesCount($employee_id, $violation_id) {
            $table = $this->table;
            return DB::table($this->table)->where("$table.employee_id", '=', $employee_id)
                                          ->where("$table.violation_id", '=', $violation_id)
                                          ->select(DB::raw('count(*) as count '))
                                          ->pluck('count');
       }
       
       public function getEmployeeViolations($employee_id, $violation_id) {
            $table = $this->table;
            return DB::table($this->table)->where("$table.employee_id", '=', $employee_id)
                                          ->where("$table.violation_id", '=', $violation_id)
                                          ->leftJoin('employees', 'employees.id', '=', "$table.employee_id")
                                          ->select("$table.*", "employees.employee_work_id");
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
                      'violations.id as violation_id',
            	    'companies.name as company')
            ->groupBy('employees.id', 'violations.code')
            ->get();
	 }

   public function findWithJoins($src) {
    $table = $this->table;
    return DB::table($this->table)
            ->orWhere('employees.lastname', 'LIKE', "%$src%")
            ->orWhere('employees.firstname', 'LIKE', "%$src%")
            ->orWhere('employees.middlename', 'LIKE', "%$src%")
            ->orWhere('violations.code', 'LIKE', "%$src%")
            ->orWhere('violations.description', 'LIKE', "%$src%")
            ->orWhere('departments.name', 'LIKE', "%$src%")
            ->orWhere('positions.name', 'LIKE', "%$src%")
            ->orWhere('companies.name', 'LIKE', "%$src%")
            ->orWhere('violations.first_offense', 'LIKE', "%$src%")
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
                      'violations.id as violation_id',
                  'companies.name as company')
            ->groupBy('violations.code')
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
            	    'companies.name as company')
            ->get();	
	 }

}
