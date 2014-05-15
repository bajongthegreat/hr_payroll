<?php namespace Acme\Composers;

use Acme\Repositories\StageProcess\StageProcessRepositoryInterface;

class StageProcessComposer {

	protected $stage_processes;

	public function __construct(StageProcessRepositoryInterface $stage_processes) {
		$this->stage_processes = $stage_processes;
	}

	public function compose($view) 
	{
		$stage_processes = ['Please select Stage Process'] + $this->stage_processes->all()->lists('stage_process','id');
		$view->with('stage_processes', $stage_processes);
	}

	public function createStageProcess($view) {
		$stage_processes = ['This stage process has no parent.'] + $this->stage_processes->all()->lists('stage_process','id');
		$view->with('stage_processes', $stage_processes);
	}






}