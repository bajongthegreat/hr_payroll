<?php namespace Acme\Composers;

use Acme\Repositories\Employee\MedicalExamination\EmployeePhysicalExaminationRepositoryInterface;
use App;

class MedicalExaminationsComposer {

	protected $medicals;
	// protected $medical_establishments = ['Donasco Medical Clinic' => 'Donasco Medical Clinic', 'Howard Hubbard Hospital' => 'Howard Hubbard Hospital'];
	// protected $medical_findings = ['None' => 'None','Hypertension' => 'Hypertension', 'Urinary Tract Infection' => 'Urinary Tract Infection', 'Cardiomegaly' => 'Cardiomegaly', 'Pulmonary Tuberculosis' => 'Pulmonary Tuberculosis'];
	protected $recommendations = ['Fit to work' => 'Fit to work', 'Unfit to work' => 'Unfit to work', 'Pending' => 'Pending'];

	public function __construct(EmployeePhysicalExaminationRepositoryInterface $medicals) {
		$this->medicals = $medicals;
	}

	public function compose($view) 
	{
		$view->with('medicals', $this->medicals);
	}

	public function medical_establishments($view) {

		$medical_establishments = App::make('Acme\Repositories\Employee\MedicalEstablishment\MedicalEstablishmentRepositoryInterface');
				
		$this->medical_establishments = $medical_establishments->all()->lists('name', 'id');
		
		$view->with('medical_establishments', $this->medical_establishments);
	}

	public function medical_findings($view) {
		$medical_findings = App::make('Acme\Repositories\Employee\MedicalExamination\Disease\DiseaseRepositoryInterface');
				
				$arr = $medical_findings->all()->lists('name', 'id');

		$view->with('medical_findings', $arr);	
	}

	public function recommendations($view) {
		$view->with('recommendations', $this->recommendations);
	}




}