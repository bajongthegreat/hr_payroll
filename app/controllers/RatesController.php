<?php

use Acme\Repositories\Payroll\Rates\RatesRepositoryInterface;

class RatesController extends \BaseController {


	protected $rates;
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct(RatesRepositoryInterface $rates)
	    {
	    	// For Cross Site Request Forgery protection
	        $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->rates = $rates;	                                                                                                                                  
	        
	    }
	
	/**
	 * Display a listing of the resource.
	 * GET /rates
	 *
	 * @return Response
	 */
	public function index()
	{

		$rates = $this->rates->parentOnly()->paginate(10);

		if (Input::has('jq_ax') && Request::ajax() ) {
			
			$id = Input::get('id');

			$rates = $this->rates->getChildren($id)->get();

			return Response::json($rates);
		}

		return View::make('rates.index', compact('rates'));
	}

	public function forSelect() {
		$rates = $this->rates->parentOnly()->lists( 'rate','id' );

		foreach ($rates as $key => $value) {
			$rates[$key] = 'PHP ' . number_format($value * 8, 2);
		}

		return Response::json($rates);

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /rates/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('rates.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /rates
	 *
	 * @return Response
	 */
	public function store()
	{
		$rates = json_decode(Input::get('_rates') );

		if ($rates) {

			$parentID = NULL;
			
			foreach ($rates as $key => $value) {
				# code...
				try {

					if ($value->type == 'regular') {
						$obj = $this->rates->create( (array) $value);
						$parentID = $obj->id;
					} else {
						$value->parent_id = $parentID;
						$obj = $this->rates->create( (array) $value);
					}

						
				} catch (Exception $e) {
					var_dump($e->getMessage());
				}
				
			}
		} else {
			return Redirect::back()->withInput(json_decode(Input::only('_rates')))->with('error',  ['Invalid JSON format.'] );
		}

	}

	/**
	 * Display the specified resource.
	 * GET /rates/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /rates/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (!is_numeric($id)) {
			goto marchme;
		} 

		$parent = $this->rates->find( (int) $id)->get()->first();

		if ($parent) {
			$rate_children = $this->rates->find($id, 'parent_id')->get()->toArray();
			
			// Grab the first element and place at the bottom
			// Insert new element on the first index			
			$t= $rate_children[0];	
			$rate_children[0] = $parent->toArray();
			$rate_children[] = $t;
			$rates= $rate_children;
	
			return View::make('rates.edit', compact('rates', 'parent'));
		} else {
			marchme:
			return Redirect::action('RatesController@index')->with('message', 'Failed to gather rates with the specified ID');
		}


	}

	/**
	 * Update the specified resource in storage.
	 * PUT /rates/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rates = json_decode(Input::get('_rates'));
		try {
			
			foreach ($rates as $key => $value) {
				# code...
				$value = (array) $value;

				if (array_key_exists('id', $value)) {
					$id = $value['id'];
					unset($value['id']);

					$this->rates->find($id)->update($value);
				}
			
			}

			return Redirect::action('RatesController@index')->with('message', 'Rates updated.');
			
		} catch (Exception $e) {
			return Redirect::back()->with('error', $e->getMessage() );		
		}
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /rates/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}