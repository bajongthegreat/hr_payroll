<?php namespace Acme\Services\Validation;

class RequirementValidator extends Validator
{
	static $rules = array(
							'document' => 'required',
							'document_type' => 'required',
							'stage_process_id' => 'required'

						);	

	static $create_rules = array(
							'document' => 'required',
							'document_type' => 'required',
							'stage_process_id' => 'required'

						);


	static $update_rules = array(
							'document' => 'required',
							'document_type' => 'required',
							'stage_process_id' => 'required'
						);


}


?>