<?php
use Acme\Repositories\Company\Position\PositionRepositoryInterface;

class PositionsController extends BaseController {
		
	protected $positions;
	protected $default_uri = 'positions';

	 /**
     * Instantiate a new UserController instance.
     */
    public function __construct(PositionRepositoryInterface $positions)
    {
    	parent::__construct();

    	// For Cross Site Request Forgery protection
        $this->beforeFilter('csrf', array('on' => 'post'));

   
        // UsersRepository Dependency
        $this->positions = $positions;
                                                                                                                                  
        
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		if (Request::has('src') ) {
			$src= Input::get('src');
			$positions = DB::table('positions')
			                  ->OrWhere('positions.name', 'LIKE', "%$src%")
			                  ->OrWhere('departments.name', 'LIKE', "%$src%")
			                  ->join('departments', 'departments.id', '=' ,'positions.department_id')
			                  ->select('positions.name', 'positions.id', 'departments.name as department');

		} else {

			// Get all positions and order by rank
			$positions = $this->positions->getAllWith(['department'])->orderBy('rank');
		}

		if (Request::get('output') == 'json') {
			return Response::json($positions);
		}

			$positions = $positions->paginate(10);
        return View::make('positions.index', compact('positions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

        return View::make('positions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'create', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$data = Input::only('name', 'department_id');

			Event::listen('illuminate.query', function ($sql, $bindings, $times) {
			echo '<h3 class="page-header">Database Query</h3>';
				var_dump($sql);
		});

		$position =  $this->positions->create($data);
		

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'view', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

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


		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$position = $this->positions->find($id)->get();


		if (!isset($position[0])) {
			return Redirect::action('PositionsController@index');
		}

		$position = $position[0];

        return View::make('positions.edit', compact(['position']));
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
		if ( !$this->accessControl->hasAccess($this->default_uri, 'edit', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$position = Input::only('name','department_id');

		$position = $this->positions->update($id, $position);

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

		// Check access control
		if ( !$this->accessControl->hasAccess($this->default_uri, 'delete', $this->byPassRoles) ) {
				return  $this->notAccessible();		
		}

		$position = $this->positions->delete($id);

		if ($position){
			return Redirect::route('positions.index');
		}
	}

	public function positionsByDepartment() {

			$department_id = (int) Input::get('id');

			$positions =  $this->positions->find($department_id, 'department_id')->lists('name','id') ;

			if (count($positions) == 0 && $department_id == 0) {
				$positions += ['No positions available'];
			} else {
				$positions += ['Select position'];
			}

			



			if ($positions) return Response::json($positions);
			else return Response::json([]);
	}

}
