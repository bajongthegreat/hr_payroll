<?php 

class AccessControl {

	protected $user_id;
	protected $role_id;
	protected $permissionsRepository;
	protected $rolesRepository;

	public function __construct($user_id, $role_id) {
		$this->user_id = $user_id;
		$this->role_id  = $role_id;

		$this->permissionsRepository = $this->resolvePermissionRepository();
		$this->rolesRepository = $this->resolveRolesRepository();

	}

	// Check if user can do this action
	public function hasAccess($uri, $action, $byPassRole = []) {

		// If the current checking class accepts a by-passing of roles, then do it
		if (count($byPassRole) >= 1) {
			if (in_array($this->role_id, $byPassRole)) return true;
		}

		// Get Role Permissions
		
		$permission = $this->permissionsRepository->find($this->role_id, 'role_id')->get(['uri_segment','action_permitted']);

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

	public function resolveRolesRepository() {
		return App::make('Acme\Repositories\User\Role\RolesRepositoryInterface');
	}

	public function pagesWithAccess($id = NULL) {

		$id = (is_null($id)) ? $this->role_id : $id;
		
		return $this->permissionsRepository->find($id, 'role_id')->lists('action_permitted', 'uri_segment');

	}

	public function getRoleName($role_id = NULL) {

		$id = (is_null($role_id)) ? $this->role_id : $role_id;

		if ($id == 0) $output = 'Super User';
		else $output = $this->rolesRepository->find($id)->pluck('name');
		
		return ($output) ? $output : NULL;
	}

	public function dump() {
		dd('You found me!');
	}

}