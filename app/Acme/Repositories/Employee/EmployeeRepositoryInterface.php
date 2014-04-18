<?php namespace Acme\Repositories\Employee;

interface EmployeeRepositoryInterface {

	// Registers a member
	public function register($profile, $options= array() );

	// Updates the profile of a member
	public function updateProfile($id, $new_profile);

	// Gets the profile of the member
	public function getProfile($id);

	// Get all members
	public function all();

	// Terminates a member
	public function terminate($id, $permanent=false, $field="id");
}



?>