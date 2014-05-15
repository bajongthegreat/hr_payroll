<?php

use Acme\Repositories\Company\CompanyRepositoryInterface;

class CompaniesController extends BaseController {

	protected $companies;

	public function __construct(CompanyRepositoryInterface $companies) {
		$this->companies = $companies;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$companies = $this->companies->all();

        return View::make('companies.index', compact('companies'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('companies.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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
		//
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
		$company = $this->companies->find($id)->delete();

		return Redirect::action('CompaniesController@index');
	}

}
