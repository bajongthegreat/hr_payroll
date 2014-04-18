<?php

class PositionsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// Get all positions and order by rank
		$positions = Position::with('department')->orderBy('rank')->get();

		if (Request::get('output') == 'json') {
			return Response::json($positions);
		}

        return View::make('positions.index', compact('positions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$departments = Department::lists('name','id');

		$selection_array = ['Please select item'];
		$companies_db  = Company::lists('name','id');

		$companies = array_merge($selection_array, $companies_db);





        return View::make('positions.create', compact(['departments','companies']));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$position = Input::only('name', 'department_id');

		$position =  Position::create($position);
		

		if ($position){
			return Redirect::route('positions.index');
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
        return View::make('positions.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$position = Position::findOrFail($id);
		$departments = $departments = Department::lists('name','id');

        return View::make('positions.edit', compact(['position','departments']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$position = Input::only('name','department_id');

		



		$position = Position::where('id', '=', $id)->update($position);

		if ($position){
			return Redirect::route('positions.index');
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
		$position = Position::where('id', '=', $id)->delete();

		if ($position){
			return Redirect::route('positions.index');
		}
	}

}
