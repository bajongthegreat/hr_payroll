<?php 
class Position extends \Eloquent {
	protected $guarded = array();

	public static $rules = array();
		protected $softDelete = 'true';


	public function department()
	{
		return $this->belongsTo('department');
	}

	
}
