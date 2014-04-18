<?php


class Log extends Eloquent 
{
	protected $table = 'logs';
	protected $softDelete = 'true';

	public function user()
	{
		$this->belongsTo('User');
	}
}