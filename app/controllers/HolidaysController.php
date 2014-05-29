<?php

use Acme\Repositories\Holiday\HolidayRepositoryInterface;

class HolidaysController extends BaseController {


	protected $holidays;
	protected $db_fields_to_use = ['name', 'type', 'remarks'];
	protected $default_uri = 'holidays';
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(HolidayRepositoryInterface $holidays)
	    {
	    	parent::__construct();

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$year = Input::get('year');
		




		if (Input::has('src')) {
			$src = Input::get('src');

			$holidays =  $this->holidays->findLike($src, $this->db_fields_to_use)->get();

		} 


			if ($year) {
				$holidays = $this->holidays->byYear($year)->get();
			} else {
			$holidays = $this->holidays->all();
		}


		
		

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$data = Input::only('holiday_date','remarks','type','name');

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$new_holiday_data = Input::only('holiday_date','remarks','type','name');

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}
		return $this->holidays->find($id)->delete();
	}

}