<?php namespace Acme\Composers;

use Acme\Repositories\Requirement\RequirementRepositoryInterface;

class RequirementComposer {

	protected $requirements;
	protected $document_types = ['original' => 'Original','photocopy' => 'Photocopy', 'handwritten' => 'Handwritten', 'scanned' => 'Scanned'];
	
	public function __construct(RequirementRepositoryInterface $requirements) {
		$this->requirements = $requirements;
	}

	public function compose($view) 
	{
		$requirements = ['Please select requirement'] + $this->requirements->all()->lists('name','id');


		$view->with('requirements', $requirements);
	}

	public function document_types($view) {
		$view->with('document_types', $this->document_types);
	}


	// Used by old employees show
	// public function raw($view) {
	// 	$view->with('requirements', $this->requirements->getAllWith(['StageProcess'])->get() );
	// }


	public function raw($view) {
		$view->with('requirements', $this->requirements);
	}


}