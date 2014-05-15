<?php

class Employee extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	protected $softDelete = 'true';

	public function position()
	{
		return $this->belongsTo('Position');
	}

	public function company() 
	{
		return $this->belongsTo('Company');
	}

	
}
