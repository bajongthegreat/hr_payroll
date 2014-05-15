<?php

class SSS_loan extends Eloquent {
	protected $guarded = array();

	public static $rules = array();
	protected $table = 'sss_loans';

	public function employee() {
		return $this->belongsTo('employee');
	}
}
