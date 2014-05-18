<?php

class Roles extends \Eloquent {
	protected $table = 'roles';
	protected $guarded = array();
	public static $rules = array();

	public function permissions() {
		return $this->hasMany('RolesPermission', 'role_id');
	}
}