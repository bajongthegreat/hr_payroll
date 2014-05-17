<?php 

class AccessControl {

	protected $user_id;
	protected $role_id;

	public function __construct($user_id, $role_id) {
		$this->user_id = $user_id;
		$this->role_id  = $role_id;
	}

	// Check if user can do this action
	public function hasAccess($uri, $action, $byPassRole = []) {

		// If the current checking class accepts a by-passing of roles, then do it
		if (count($byPassRole) >= 1) {
			if (in_array($this->role_id, $byPassRole)) return true;
		}

		// Get Role Permissions
		$permissionsRepository = $this->resolvePermissionRepository();

		$permission = $permissionsRepository->find($this->role_id, 'role_id')->get(['uri_segment','action_permitted']);

		// Check if the role exists
		foreach ($permission->toArray() as $key => $value) {
			
			if ($value['uri_segment'] == $uri) {
				$perm_actions = explode('|', $value['action_permitted']);

				if (in_array($action, $perm_actions)) return true;
			}	
		}

		 return false;

	}

	public function resolvePermissionRepository() {
		return App::make('Acme\Repositories\User\RolesPermission\RolesPermissionRepositoryInterface');
	}

	

	public function dump() {
		dd('You found me!');
	}

}