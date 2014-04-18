<?php namespace Acme\Repositories\User;

Use User;


class UserRepository implements UserRepositoryInterface
{

	protected $pagination_limit = 10;
	protected $order_by = 'id';
	protected $order_type = 'asc';
 

	// Get all users
	public function all() 
	{
		return User::all();
	}

	public function search($fields,  $search_term, $options=  array() )
	{
		$users = NULL;

		$callback_variable = ['fields' => $fields, 
		                      'search_term' => $search_term 
		                       ];
		 // Sorting                   
		 $this->order_by = isset($options['sort']['by']) ? $options['sort']['by'] : $this->order_by; 
		 $this->order_type = isset($options['sort']['type']) ? $options['sort']['type'] : $this->order_type;



		if (is_array($fields))
		{
			
				
				// Check if the user wants to paginate it
				if (isset($options['paginate']))
				{

						 $this->pagination_limit = $options['paginate']['limit'];
						

						 $users= User::where(function($query) use ($callback_variable) {

					  		
					  		$search_term = $callback_variable['search_term'];


							// Loop through each field given and compare the value found in the  DB
					 		foreach($callback_variable['fields'] as $field)
					 		{
					 			  $query->orWhere($field, 'LIKE', "%$search_term%");


					 		}

			
					 	})->orderBy($this->order_by, $this->order_type)->paginate($this->pagination_limit);

						

					

					
				}
				// Return un-paginated result
				else
				{
					 $users= User::orWhere(function($query) use ($callback_variable) {

					  		$search_term = $callback_variable['search_term'];

					 		foreach($callback_variable['fields'] as $field)
					 		{
					 			  $query->orWhere($field, 'LIKE', "%$search_term%");
					 		}
					 	})->orderBy($this->order_by, $this->order_type)->get();
				}

			 
		}
		else
		{
			throw new \Exception('Fields must be an in the form of array.');
		}

		

		
		// Check if the user wants other return types
		if (isset($options['return_type']))
		{
			if ($options['return_type'] == 'json') return \Response::json($users->toArray());
		}

		return $users;
	}

	// Paginate user result
	public function paginate($limit, $options = array() )
	{
		// Order Users by specified db field
		if ( isset($options['orderBy']) )
		{
			return User::orderBy($options['orderBy'])->paginate($limit);
		}

		// Order Users by specified db field and sort in ascending or descending
		elseif (isset($options['orderBy']) && isset($options['orderType']))
		{
			return User::orderBy($options['orderBy'], $options['orderType'])->paginate($limit);
		}

		// Return all users and paginate it
		else
		{
			return User::paginate($limit);
		}

		
	}

	// Find a user
	public function find($id){
		return User::findOrFail($id);
	}

	// Creates a new user
	public function create($userdata, $options = array() )
	{	
		// Add additional fields but doesn't override the existing values 
		if (isset($options['fields']))
		{
			foreach ($options['fields'] as $key => $value) 
			{
				// Don't overwrite existing values
				// sif (array_key_exists($key, $userdata))  continue;

				// Add new values to the userdata array
				$userdata[$key] = $value;
			}			
		}


		// Unset all array values with a specified keys in unset options 
		if (isset($options['unset']))
		{
			foreach ($options['unset'] as $field) {
				unset($userdata[$field]);
			}
		}


			// Remove the password confirmation from POST data 
			// unset($userdata['password_confirmation']); ---> Not checked if working

			// Trim spaces in username
			$userdata['username'] = preg_replace('/\s+/', '', $userdata['username']);
			$userdata['email'] = preg_replace('/\s+/', '', $userdata['email']);

			// Set always the status to active
			//$userdata['status'] = 'Active';---> Not checked if working

			// Hash the password
			$userdata['password'] = \Hash::make($userdata['password']);


			// Checks if username and email already exists and dump all errors in $error_dump variable
			$error_dump = $this->checkIfExists(array('username' => $userdata['username'],
				                                        'email' => $userdata['email']));
		
			if (count($error_dump) > 0) 
				return ['errors' => $error_dump];


			// Create the user if no errors were found
			$new_user = User::create($userdata);  

			return  $new_user;

		
			
	}


	// Update Information of a user
	public function update($id, $userdata = array(), $options = array() )
	{
		// Check if it will change only the password
		$change_password = isset($options['change_password']) ? $options['change_password'] : false;

		
		//Unset current and confirmation password
		unset($userdata['password_confirmation']);

		// Hash password if the password field is not empty and passes the validation
		if ($change_password === true)
		{
			$userdata['password'] = \Hash::make($userdata['password']);
		}
		else
		{
			unset($userdata['password']);
		}


		
		// Update the user
		return User::where('id', '=', $id)->update($userdata);
	}

	// Delete a user
	public function delete($id, $option = array() )
	{
		return User::where('id', '=', $id)->delete();
	}


	function checkIfExists($data)
	{
		$error_dump = array();

		try
		{
			foreach($data as $key=>$value)
			{
				if (count(User::where($key, '=', $value)->get([$key])->toArray()) == 1 )
				{
					$error_dump[$key] = ucfirst($key) . ' already exist.';
				}
			}
		}
		catch(Exception $e)
		{
			throw new Exception('Failed to check the field. [' . implode(',', array_keys($data)) . ']' ) ;
		}

		return $error_dump;
	}
}