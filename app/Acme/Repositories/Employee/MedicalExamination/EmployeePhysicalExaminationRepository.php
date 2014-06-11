<?php namespace Acme\Repositories\Employee\MedicalExamination;

use Acme\Repositories\RepositoryAbstract;
use DB;

class EmployeePhysicalExaminationRepository extends RepositoryAbstract implements EmployeePhysicalExaminationRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	  protected $table = "employees_physical_examinations";
	 
	  /**
	   * Constructor
	   */
	public function __construct(EmployeePhysicalExamination $model)
	{
	    $this->model = $model;
	 }


	 public function findAllExaminationsWithEmployee($src) {
	 	$table = $this->table;
	 	return DB::table($this->table)
	 		->orWhere('employees.lastname', 'LIKE', "%$src%")
	 		->orWhere('employees.firstname', 'LIKE',  "%$src%")
	 		->orWhere('employees.middlename', 'LIKE', "%$src%")
	 		->orWhere('medical_establishments.name', 'LIKE', "%$src%")
	 		->orWhere('diseases.name', 'LIKE', "%$src")
	 		->orWhere("$table.recommendations", 'LIKE', "%$src%")
            ->join('employees', "$table.employee_id" , '=', 'employees.id')
            ->leftJoin('medical_establishments', "$table.medical_establishment_id", '=', 'medical_establishments.id')
            ->leftJoin('diseases', "$table.medical_findings_id", '=', 'diseases.id')
            ->select("employees.lastname", "employees.firstname", "employees.middlename", 
            	     "employees.employee_work_id", "$table.medical_findings_id", "$table.date_conducted",
            	     "$table.recommendations", "$table.medical_establishment_id","$table.remarks", 'medical_establishments.name as establishment',
            	     'diseases.name as medical_findings')
            ->orderBy("$table.date_conducted", 'DESC');
	 }

	 public function getIncludedEmployeesOnExamination($date_conducted, $med_estab_id) {
	 	$table = $this->table;
	 	return DB::table($this->table)
	 		->where("$table.date_conducted", '=', $date_conducted)
	 		->where("$table.medical_establishment_id", '=', $med_estab_id)
            ->leftJoin('employees', "$table.employee_id" , '=', 'employees.id')
            ->leftJoin('medical_establishments', "$table.medical_establishment_id", '=', 'medical_establishments.id')
            ->leftJoin('diseases', "$table.medical_findings_id", '=', 'diseases.id')
            ->select("employees.lastname", "employees.firstname", "employees.middlename", 
            	     "employees.employee_work_id", "$table.medical_findings_id", "$table.date_conducted",
            	     "$table.recommendations", "$table.medical_establishment_id","$table.remarks", 'medical_establishments.name as establishment',
            	     'diseases.name as medical_findings', DB::raw('CONCAT(lastname, ", ", firstname) as fullname'))
            ->get();
	 }

	 public function getAllExaminationDataWithEmployee() {
	 	$table = $this->table;
	 	return DB::table($this->table)
            ->join('employees', "$table.employee_id" , '=', 'employees.id')
            ->leftJoin('medical_establishments', "$table.medical_establishment_id", '=', 'medical_establishments.id')
            ->leftJoin('diseases', "$table.medical_findings_id", '=', 'diseases.id')
            ->select("employees.lastname", "employees.firstname", "employees.middlename", 
            	     "employees.employee_work_id", "$table.medical_findings_id", "$table.date_conducted",
            	     "$table.recommendations", "$table.medical_establishment_id","$table.remarks", 'medical_establishments.name as establishment',
            	     'diseases.name as medical_findings', "$table.id")
            ->groupBy("$table.date_conducted")
            ->orderBy("$table.date_conducted", 'DESC');
	 }

	 public function getExaminationDataWithJoins($id) {

	 	$table = $this->table;
	 	return DB::table($this->table)
	 		->where('employee_id', '=', $id)
            ->join('employees', "$table.employee_id" , '=', 'employees.id')
            ->leftJoin('medical_establishments', "$table.medical_establishment_id", '=', 'medical_establishments.id')
            ->leftJoin('diseases', "$table.medical_findings_id", '=', 'diseases.id')
            ->select("employees.lastname", "employees.firstname", "employees.middlename", 
            	     "employees.employee_work_id", "$table.medical_findings_id", "$table.date_conducted",
            	     "$table.recommendations", "$table.medical_establishment_id","$table.remarks", 'medical_establishments.name as establishment',
            	     'diseases.name as medical_findings', "$table.id")
            ->orderBy("$table.date_conducted", 'DESC')
            ->get();	
	 }


}
