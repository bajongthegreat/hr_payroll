<?php namespace Acme\Repositories;

interface RepositoryInterface {

	// Create data
	public function create($data);

	// Updates data
	public function update($id, $data);

	// Fetches all data
	public function all($fields = ['*'],$options = array());

	// Deletes data
	public function delete($id, $field="id");


	// Find specific data
	public function find($id, $field="id");

}