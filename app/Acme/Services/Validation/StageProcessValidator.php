<?php namespace Acme\Services\Validation;

class StageProcessValidator  extends Validator
{
	static $rules = array(
							'stage_process' => 'required'

						);	

	static $create_rules = array(
							'stage_process' => 'required'

						);


	static $update_rules = array(
							'stage_process' => 'required'
						);


}


?>