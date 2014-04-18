<?php

class Department extends Eloquent {

	protected $table = 'departments';
	protected $guarded = array();

	public static $rules = array();

	public function company()
	{
		return $this->belongsTo('company');
	}
}
