<?php namespace Acme\Repositories\User;


interface UserRepositoryInterface {

	// Get all users
	public function all();

	// Paginate user result
	public function paginate($limit, $options = array() );

	// Search user
	public function search($fields,  $search_term, $options=  array() );

	// Find a user
	public function find($id);

	// Creates a new user
	public function create($userdata, $options = array() );


	// Update Information of a user
	public function update($id, $userdata = array(), $options = array() );

	// Delete a user
	public function delete($id, $options = array() );

}


?>