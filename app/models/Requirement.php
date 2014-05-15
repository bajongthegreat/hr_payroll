<?php

class Requirement extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public function stageProcess()
	{
		return $this->belongsTo('stageProcess');
	}

}
