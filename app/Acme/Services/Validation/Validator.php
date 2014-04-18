<?php namespace Acme\Services\Validation;

Use Validator as V;


abstract class Validator {

	protected $errors;
	protected $status;

	public function validate($input, $rules = NULL, $options = array() )
	{
		// Check if rules needs to be override
		if (!is_null($rules)){

			// Check if custom messages are set and set an appropriate arguments for validation
			$validation = (isset($options['messages']))
						  ? V::make($input, $rules, $options, $options['messages']) 
						  : V::make($input, $rules, $options) ;
		} 
		else
		{
			// Check if custom messages are set and set an appropriate arguments for validation
			$validation = (isset($options['messages'])) 
			              ? V::make($input, static::$rules, $options['messages'])
			              : V::make($input, static::$rules);
		}

		

		if ($validation->fails())
		{
			$this->errors = $validation->messages();
			$this->status = 'failed';
			return false;
		}

		$this->status = 'success';

		return true;
	}

	public function isValideForCreation($input)
	{
		return $validation = $this->validate($input, static::$create_rules);

	}

	public function isValidForUpdate($id = NULL, $input, $options = array())
	{

		// If ID is set, check also if in the options array, the key "Current key" exists
		// Then, replace the value of that array key in the update rules set in User Validator
		// and add a code to only validate unique if the id is not equal to the specified ID in the first parameter.

		if (!is_null($id))
		{
			if (isset($options['current_key']))
			{
				static::$update_rules[$options['current_key']] = static::$update_rules[$options['current_key']] . ',' .$options['current_key'] .',' . $id;
			}

			// Remove from array
			unset($options['current_key']);
		}

		return $validation = $this->validate($input, static::$update_rules, $options);

	}


	public function errors()
	{
		return $this->errors;
	}

	public function status()
	{
		return $this->status;
	}

}
