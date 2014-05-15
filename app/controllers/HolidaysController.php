<?php

use Acme\Repositories\Holiday\HolidayRepositoryInterface;

class HolidaysController extends BaseController {


	protected $holidays;
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(HolidayRepositoryInterface $holidays)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->holidays = $holidays;
	                                                                                                                                  
	        
	    }
	

	/**
	 * Display a listing of the resource.
	 * GET /holidays
	 *
	 * @return Response
	 */
	public function index()
	{
		$holidays = $this->holidays->all();

		return View::make('holidays.index', compact('holidays'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /holidays/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('holidays.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /holidays
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only('holiday_start','holiday_end','remarks','type','name');

		if ($this->holidays->create($data))  {
			$status = "success";
		} else {
			$status = "failed";
		} 
		return Redirect::action('HolidaysController@index')->with('status', $status);
	}

	/**
	 * Display the specified resource.
	 * GET /holidays/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('holidays.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /holidays/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$holiday = $this->holidays->find($id)->get();

		if (count($holiday) == 1) {
			$holiday = $holiday[0];
		}
		return View::make('holidays.edit', compact('holiday'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /holidays/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$new_holiday_data = Input::only('holiday_start','holiday_end','remarks','type','name');

		if ($this->holidays->find($id)->update($new_holiday_data)) {
			$status = 'success';
		} else {
			$status = 'failed';
		}

		return Redirect::action('HolidaysController@index');

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /holidays/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}