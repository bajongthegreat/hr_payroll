<?php

class BaseController extends Controller {

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

	
}