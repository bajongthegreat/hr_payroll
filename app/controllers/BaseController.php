<?php

class BaseController extends Controller {



	protected $accessControl;
	protected $byPassRoles = [0, 1];
		 /**
	     * Instantiate a newController instance.
	     */
	    public function __construct()
	    {
	    	// For Cross Site Request Forgery protection
	        // $this->beforeFilter('csrf', array('on' => 'post'));
	
	   
	        // UsersRepository Dependency
	        $this->accessControl = App::make('AccessControl');
	                                                                                                                                  
	        
	    }
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{

		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function paginate($collection, $perPage, $page){

	  $results = new StdClass;
	
	  try {

	  	$results->items = (is_array($collection)) ? $collection : $collection->toArray();


	  	$results->totalItems = count($results->items) + 1;
	    

	  } catch (Exception $e) {
	  	echo $e->getMessage();
	  }
	
	  $paginated = Paginator::make($results->items, $results->totalItems, $perPage);

	  return $paginated;
	}

	public function notAccessible() {
		return Response::view('layout.not_accessible', array(), 404);
	}

	public function checkAccess($uri, $action, $bypass = array() ) {
		// Check access control
		if ( !$this->accessControl->hasAccess($uri, $action, $bypass) ) {
				return Response::view('layout.not_accessible', array(), 404);	
		}
	}

	
}