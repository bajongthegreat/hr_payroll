<?php

class CustomValidator extends Illuminate\Validation\Validator {

    public function validateFoo($attribute, $value, $parameters)
    {
        return $value == 'foo';
    }

    public function validateRequiredSelect($attribute, $value) {
    	if ($value == 0) 
        {
    		return  false;
    	}
         elseif ($value == -1) 
        {
            return false;
        }

    	return true;
    }

}