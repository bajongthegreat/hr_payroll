<?php

class RolesPermission extends \Eloquent {
	protected $table = 'roles_permissions';
	protected $guarded = array();
	public static $rules = array();
}