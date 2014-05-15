<?php

class Roles extends \Eloquent {
	protected $table = 'user_roles';
	protected $guarded = array();
	public static $rules = array();
}