<?php namespace Acme\Repositories\User\Role;

use Acme\Repositories\RepositoryInterface;

interface RolesRepositoryInterface extends RepositoryInterface {

	public function hasRole($user_id, $role_id);
}


