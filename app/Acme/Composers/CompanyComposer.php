<?php namespace Acme\Composers;

use Acme\Repositories\Company\CompanyRepositoryInterface;

class CompanyComposer {

	protected $companies;

	public function __construct(CompanyRepositoryInterface $companies) {
		$this->companies = $companies;
	}

	public function compose($view) 
	{
		$companies = ['Please select company'] + $this->companies->all()->lists('name','id');
		$view->with('companies', $companies);
	}


	public function raw($view) {
		$companies =  $this->companies->all(['name','id']);
		$view->with('companies', $companies);
	}


}