<?php

class SyncController extends BaseController {

	  /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        $this->afterFilter('log', array('only' =>
                            array('fooAction', 'barAction')));
    }


	public function index() {
		if (Input::has('get')) {
			$get = Input::get('get');

			return Response::json($this->getSelectOptions($get));
		}

	}

	protected function getSelectOptions($get) {

		switch ($get) {
			case 'medical_establishments':
				$medical_establishments = App::make('Acme\Repositories\Employee\MedicalEstablishment\MedicalEstablishmentRepositoryInterface');
				
				$arr = $medical_establishments->all()->lists('name', 'id');

				// $arr = ['Donasco Medical Clinic', 'Howard Hubbard Hospital'];
				break;
			 
			case 'recommendations':
				$arr = ['Fit to work', 'Unfit to work', 'Pending'];
			break;

			case 'medical_findings':

				$medical_findings = App::make('Acme\Repositories\Employee\MedicalExamination\Disease\DiseaseRepositoryInterface');
				
				$arr = $medical_findings->all()->lists('name', 'id');

			 	// $arr = ['None','Hypertension', 'Urinary Tract Infection', 'Cardiomegaly', 'Pulmonary Tuberculosis'];
			break;

			default:
				$arr = [];
				break;
		}

		return $arr;
	}


}
