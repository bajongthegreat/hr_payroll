<?php namespace Acme\Repositories;

abstract class RepositoryAbstract {

	// Create data
	public function create($data) 
	{
		return $this->model->create($data);
	}

	// Updates data
	public function update($id, $data)
	{
		return $this->find($id)->update($data);
	}

	// Fetches all data
	public function all($fields = ['*'], $options = array() )
	{
		if (isset($options['paginate'])) {
			return $this->model->paginate($options['paginate']);
		}
		return $this->model->all($fields);
	}

	// Deletes data
	public function delete($id, $field='id')
	{
		return $this->find($id, $field)->delete();
	}


	// Find specific data
	public function find($id, $field="id") 
	{
		return $this->model->where($field, '=', $id);
	}

	// Find specific data
	public function findWith($id, $with="", $field="id") 
	{
		return $this->model->with($with)->where($field, '=', $id);
	}

	public function findExcept($id, $field="id") {
		return $this->model->where($field, '!=', $id);
	}

	public function findWhereIn($field, $collection, $with=array()) {
		if (count($with) > 0) {
			return $this->model->with($with)->whereIn($field, $collection);
		}
		return $this->model->whereIn($field, $collection);
	}

	public function findLike($value, $fields = array(), $with ) {
		if (count($fields) == 0) return false;
		
		// No relationship
		if (count($with) == 0) {
			return  $this->model->where(function($query) use ($fields, $value) {
		      				
		      				foreach ($fields as $field) {
		      					 $query->orWhere($field, 'LIKE', "%$value%");
		      				}
		              
		              });
		}

		// With relationship
		else {


			return  $this->model->with($with)->where(function($query) use ($fields, $value) {
		      				
		      				foreach ($fields as $field) {
		      					 $query->orWhere($field, 'LIKE', "%$value%");
		      				}
		              
		              });
		}


		
	}

	// Get with another model
	public function getAllWith($with) {
		
		$query = $this->make($with);

		return $query;
	}



	/**
	 * Make a new instance of the entity to query on
	 *
	 * @param array $with
	 */
	public function make(array $with = array())
	{
	  return $this->model->with($with);
	}



	// Addons for Eloquent and Fluent

	function addFilterFieldsToDB($query, $params) {

		foreach ($params as $key => $value) {
					if (is_array($value) && count($value) > 1) {
						$query->whereIn($key, $value);	
					
					} else {
						$query->where($key, '=', $value[0]);
					}
					
					}
	}

}