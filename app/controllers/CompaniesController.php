<?php

use Acme\Repositories\Company\CompanyRepositoryInterface;

class CompaniesController extends BaseController {

	protected $companies;
	protected $db_field_to_use = ['name', 'address'];

	public function __construct(CompanyRepositoryInterface $companies) {
		parent::__construct();
		$this->companies = $companies;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('companies', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		if (Request::has('src')) {
			$src = Input::get('src');
			$companies = $this->companies->findLike($src, $this->db_field_to_use);
			
		} else {
					$companies = $this->companies->getAllWith([]);

		}



		if (Request::get('output') == 'json') {
			return Response::json($companies);
		}


			$companies = $companies->paginate(10);
        return View::make('companies.index', compact('companies'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('companies', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

        return View::make('companies.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess('companies', 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$company_data = Input::only('name','address');

		$company = $this->companies->create($company_data);
		
		return Redirect::action('CompaniesController@index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess('companies', 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$company = $this->companies->find($id)->get();


        return View::make('companies.show', compact('company'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		// Check access control
		if ( !$this->accessControl->hasAccess('companies', 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$company = $this->companies->find($id)->get();

		if ($company) $company = $company[0];
		else {
			return Redirect::action('CompaniesController@index')->with('message', ['error' => 'No company with such ID.']);
		}

        return View::make('companies.edit', compact('company'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
		// Check access control
		if ( !$this->accessControl->hasAccess('companies', 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$company_data = Input::only('name','address');

		$company = $this->companies->find($id)->update($company_data);

		return Redirect::action('CompaniesController@index'); 
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// Check access control
		if ( !$this->accessControl->hasAccess('companies', 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$company = $this->companies->find($id)->delete();

		return Redirect::action('CompaniesController@index');
	}

}
