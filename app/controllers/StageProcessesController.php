<?php

use Acme\Repositories\StageProcess\StageProcessRepositoryInterface;
// Use a Validation Service
use Acme\Services\Validation\StageProcessValidator as jValidator;

class StageProcessesController extends BaseController {

	/**
	 * StageProcess Repository
	 *
	 * @var StageProcess
	 */
	protected $stageProcess;

	/**
	 * StageProcess Validator
	 *
	 * @var validator
	 */
	protected $validator;



	public function __construct(StageProcessRepositoryInterface $stageProcess, jValidator $validator)
	{
		$this->stageProcess = $stageProcess;
		$this->validator = $validator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cstage_processes = $this->stageProcess->all();

		if (Request::get('output') == 'json') {

			if (Request::get('select')) {
				$cstage_processes = ['Please select stage process.'] + $cstage_processes->lists('stage_process','id');
			}

			return Response::json($cstage_processes);
		}

		return View::make('stageProcesses.index', compact('cstage_processes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return View::make('stageProcesses.create', compact('stage_processes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();


		// Validate Inputs
		if ($this->validator->validate($input)) {

			$this->stageProcess->create($input);
			return Redirect::route('stageprocesses.index');
		}


		return Redirect::route('stageProcesses.create')
			->withInput()
			->withErrors($this->validator->errors())
			->with('message', ['error' => 'There were validation errors.']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$stageProcess = $this->stageProcess->find($id);

		return View::make('stageProcesses.show', compact('stageProcess'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$stage_process  = $this->stageProcess->find($id)->get()[0];

		if (is_null($stage_process))
		{
			return Redirect::route('stageProcesses.index');
		}

		$parents = ['This stage process has no parent.'] + $this->stageProcess->findExcept($id)->lists('stage_process','id');

		return View::make('stageProcesses.edit', compact('stage_process','parents'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::except('_token','_method');
		$validation = Validator::make($input, StageProcess::$rules);

		if ($validation->passes())
		{
			$stageProcess = $this->stageProcess->find($id);
			$stageProcess->update($input);

			return Redirect::route('stageprocesses.index');
		}

		return Redirect::route('stageprocesses.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->stageProcess->find($id)->delete();

		return Redirect::route('stageprocesses.index');
	}

}
