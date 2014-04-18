<?php

class DepartmentsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$departments = Department::with('company')->get();
		

		if (Request::get('output') == 'json') {
			return Response::json($departments);
		} 
		



        return View::make('departments.index', compact('departments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$companies = Company::lists('name','id');

        return View::make('departments.create', compact('companies'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$new_department = Input::only('name','company_id');

		$new_department['status'] = 'active';

		
		
		$validator = Validator::make( $new_department, ['name' => ['required','min:2'] ]);

		if ($validator->fails() ) {
			return Redirect::back()->withErrors($validator)->withInput();
		} else {
			
			$department =  Department::create($new_department);

			if ($department){
				return Redirect::route('departments.index');
			}
		}
		

		

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('departments.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$department = Department::findOrFail($id);

		$companies = Company::lists('name','id');

		
        return View::make('departments.edit', compact(['department', 'companies']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$new_department = array();
		$new_department = Input::only('name','status','company_id');

		



		$department = Department::where('id', '=', $id)->update($new_department);

		if ($department){
			return Redirect::route('departments.index');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$department =  Department::where('id', '=', $id)->delete();

		if ($department){
			return Redirect::route('departments.index');
		}
	}


	public function departmentsByCompany() {

			$company_id = (int) Input::get('company_id');

			$departments = Department::where('company_id','=', $company_id)->lists('name','id');

			if ($departments) return Response::json($departments);
			else return Response::json([]);
	}

}
