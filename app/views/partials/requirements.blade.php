
<!-- Needs Requirements -->
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#requirements_overview">Requirements Overview</a></h3>
		  </div>
		  <div class="panel-body">

		  	 <div  id="requirements_overview" class="panel-body panel-collapse collapse in">
		   
<?php 

	$employee_requirement_helper = new Acme\Helpers\EmployeeRequirementHelper();
	$sp = [1 => 'Interview', 2 => 'Orientation'];

	$id = isset($applicant->id) ? $applicant->id : $employee->id;
	$canEdit = $accessControl->hasAccess($uri, 'edit', $GLOBALS['_byPassRole']);

?>			
	
		@foreach ($sp as $key => $stage) 
<a href="#" class="_popover" data-toggle="popover" title="{{ $stage }}" data-content="<a href='{{ route('requirements.create') }}?stage_process={{ ($key)}}&ref={{ base64_encode( URL::current() ) }}' class='btn btn-sm btn-primary col-md-12'>Create new requirement</a> <br>"><strong>{{ $stage }}</strong></a>
		  	
	
		    <ul class="list-group" style="list-style: none;">

		    <?php 
		 	  $requirements_obj = $requirements->find($key, 'stage_process_id')
					    	            	   ->leftJoin('stageprocesses', 'stageprocesses.id','=', 'requirements.stage_process_id')
					    	            	   ->get(['requirements.*']);


			 if (count($requirements_obj) == 0) {
			 	echo '<br><span class="label label-danger">No requirement specified.</span>';
				echo '<li style="margin-top:15px" class="alert alert-info">
							<ul>
					            <li>You can create a new requirement by clicking the header above.</li> 
					            <li>For this stage, ' . $stage .', clicking it will show a popover. </li>
					            <li>Click "Create new requirement" to redirect you to requirement creation form.</li>
					            <li>Once done, you will be redirect back here.</li>
				      		</ul>
				      </li>';		 
			 } else {

			 		foreach ($requirements_obj as $requirement_item) {
			 			# code...

			 		// Default Action => pass requirements
			 		$type = "pass";

			 		// Requirement style
			 		$requirement_class = ($canEdit) ? '_applicant_show_requirement' : "";

			 		// Check if the requirement is passed
			 		if ( !$employee_requirement_helper->isRequirementPassed($requirement_item->id, $id) ) {
			 			// Initialize date passed variable
						$date_passed = "";

						// Button to display and perform action
						$button = ($canEdit) ? '<span class="label label-info">Submit</span>' : "";

						// Icon to be used if not passed
		         		$icon = '<a href="#"  class="' . $requirement_class . '"> '  .$button . ' <span class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></a>';

			 		} else {

			 			// If the employee passed the requirement, set the date when
			 			$date_passed = $employee_requirement_helper->datePassed($requirement_item->id, $id);
					    
					    // If passed, give an option to remove it.     		
			 			$type = 'remove';

			 			// Button used to perform action
					    $button = ($canEdit) ? '<span class="label label-default">Redo</span>' : "";

					    // Icon to be used
					    $icon = '<a href="#" class="' . $requirement_class .'"> ' . $button .' <span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span></a>';
					         	
			 		}

				echo '<li style="margin-top: 5px" data-type="' . $type. '" data-document="' . ucfirst($requirement_item->document). '" data-applicant_id="' . $id . '" data-requirement_id="' . $requirement_item->id .'"> ' . $icon . ' ' . ucfirst($requirement_item->document) . '(' . ucfirst($requirement_item->document_type).')' . '   <span class="label label-default">' . $date_passed . '</span>' .'</li>';

				}
			 }

		    ?>

		    <hr>
		    	@endforeach
		  </div>
		</div>
	</div>
