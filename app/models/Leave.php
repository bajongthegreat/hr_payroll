<?php

class Leave extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	protected $softDelete = 'true';


	public function employee()
	{
		return $this->belongsTo('employee');
	}
}
