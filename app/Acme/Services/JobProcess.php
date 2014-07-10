<?php

class JobProcess {
	
	// Job checkers
	protected $failed_jobs = [];
	protected $success_jobs = [];
	protected $jobs = [];
	protected $duplications = [];
	protected $not_included = [];
	protected $created = [];
	protected $ids_prior_update = [];

	// ID field to use
	 protected $id_field = "id";



	// Model
	protected $model;
	protected $employees;

	// Data
	protected $raw_data;



	// Check for duplicates
	public function isDuplicate($field) {
		if (in_array($field, $this->jobs)) {
				$this->$duplications[] = $field;
				return true;
		}

		return false;
	}

	public function isIncluded($field) {
		
		if ($field == NULL) {
			$this->not_included[] = $field;
			return false;
		} elseif ($field == "") {
			$this->not_included[] = $field;
			return false;
		} elseif (empty($field)) {
			$this->not_included[] = $field;
			return false;
		} 

		return true;
	}

	public function addJob($field) {
		$this->jobs[] = $field;
	}

	public function belongsToUpdate($field) {

		if (in_array($field, $this->ids_prior_update)) {
				return true;
		}

		return false;

	}


	public function belongsToInsert($field) {

		if (!in_array($field, $this->ids_prior_update)) {
				return true;
		}

		return false;

	}

	public function setStatus($status, $data) {

		// Check if it is success
		if ($status) {
			$this->success_jobs[] = $id;

			// Save data for process only on success
			$this->data[] = $data;
		}

		$this->failed_jobs[] = $id;
	}


}


$jobProcess = new JobProcess;

foreach ($data as $key => $new) {
	

	$jobProcess->addJob($id);


	// Check if it is duplicate
	if ( $jobProcess->isDuplicate($id) ) {
		continue;
	}

	if ( $jobProcess->isIncluded($id) ) {
		echo 'It is included';
		continue;
	} 

	// For editing, check if it needs update or insert
	if ( $jobProcess->belongsToUpdate($id) ) {

		echo 'Needs update';
		
		// Update = Update query
		$status = $model->find($id)->update($new);

		$jobProcess->setStatus($status, $new);

	} else {
		echo 'This is insert';


	}


}