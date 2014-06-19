<?php namespace Acme\Repositories\Payroll\Rates;

class Rates extends \Eloquent {
	protected $fillable = [];
	protected $table = "employees_flat_rates";
	protected  $guarded = [];
}

