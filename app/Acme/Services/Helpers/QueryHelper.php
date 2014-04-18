<?php namespace Acme\Services\Helpers;


class QueryHelper{

	protected $table;


	public function __construct($table)
	{
		$this->table = $table;

		return 'demo';
	}

	public function exists($field) {
		return 'Haha';
	}
}