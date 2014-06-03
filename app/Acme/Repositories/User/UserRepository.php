<?php namespace Acme\Repositories\User;

use User;
use Role;
use Acme\Repositories\RepositoryAbstract;

class UserRepository extends RepositoryAbstract implements UserRepositoryInterface {
	
	  /**
   		* @var Model
  	    */
	  protected $model;
	 
	  /**
	   * Constructor
	   */
	public function __construct(User $model)
	{
	    $this->model = $model;
	 }

	 // public function relativeSearch($src, $filter_params, $db_field_to_use) {
	 	
	 // 		return $this->findLike($src, $db_field_to_use , [] )->where(function($query) use ($filter_params) {

		// 		if (isset($filter_params)) {
		// 			$this->addFilterFieldsToDB($query, $filter_params);
		// 		}
			
		// 	});
	 // }

	 public function _create($userdata, $options = array() )
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
	public function _update($id, $userdata = array(), $options = array() )
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
