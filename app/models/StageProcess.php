<?php

class StageProcess extends Eloquent {
	protected $guarded = array();

	public $table = 'stageprocesses';

	public static $rules = array(
		'stage_process' => 'required'
	);
}
