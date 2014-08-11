<style type="text/css">
 .chkbox {
 	padding: 5px 4px !important;
 	margin-top: 5px !important;
 	margin-right: 10px;
 }
 .list-item {
 	margin-top: 5px;
 }

 .list-item span {
 	margin-left: 10px;
 }
</style>

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
		         		$icon =  '<a href="#"  class="' . $requirement_class . '"> '  .$button . ' <span class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></a>';

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

				echo '<li style="margin-top: 5px" data-type="' . $type. '" data-document="' . ucfirst($requirement_item->document). '" data-applicant_id="' . $id . '" data-requirement_id="' . $requirement_item->id .'"> '. '<input type="checkbox" style="width: 20px;" class="chkbox">' . $icon . ' ' . ucfirst($requirement_item->document) . '(' . ucfirst($requirement_item->document_type).')' . '   <span class="label label-default">' . $date_passed . '</span>' .'</li>';

				}
			 }

		    ?>

		    <hr>
		    	@endforeach

		    	<div style="margin-top: 15px">
		    		<img src="http://localhost/phpmyadmin/themes/pmahomme/img/arrow_ltr.png"> <span style="font-size: 12px;"> <input type="checkbox" class="checkall"> Check all</span>   <span style="margin-left: 20px; color: #FF9966; font-size: 12px;"> With selected: </span> <span style="font-size: 12px;"> <a href="#" class="btn btn-sn btn-default submit-checked" style="padding: 1px 34px !important;">Submit</a></span>
		    	</div>
		  </div>
		</div>
	</div>

	<div class="demo"></div>
<script type="text/javascript">

(function(){

	setTimeout(function() {
			

			// Checks all checkbox
			$('.checkall').on('click', function() {
				$(':checkbox.chkbox').prop('checked', this.checked);
			});

			// Trigger action to checked requirements
			$('.submit-checked').on('click', function(e) {
				
				var content = "You selected this items to update: <br>";
				var requirementsContainer = [];
				var tempArray = [];

				// Reset storage requirements
				localStorage.setItem('requirements', '');

				// Loop through each checked checkbox
				($(':checkbox.chkbox:checked').parent()).each(function(i) {
					
					if ($(this).data('type') == 'pass') {
						content += '<li class="list-item">' + '<span class="label label-success">ADD</span><span>' + $(this).data('document') +'</span>' +'</li>';	
					} else {
						content += '<li class="list-item">' + '<span class="label label-danger">REMOVE</span><span>' + $(this).data('document') +'</span>' +'</li>';							
					}
					
					requirementsContainer[i] = { 'action' : $(this).data('type'),
					                             'requirement_id' : $(this).data('requirement_id') };


				});

				if ($(':checkbox.chkbox:checked').parent().length > 0 ) {

					localStorage.setItem('requirements', JSON.stringify(requirementsContainer) );

        		    $('#myModalLabel').html('Employee Requirement');
	   	            $('#requirement-modal-multiple').modal('show');
					$('.requirement-modal').html(content);					
				}

				e.preventDefault();
			});

			// Process the selected items
			// Still, Server side code not yet implemented.

	}, 1000);

})();

</script>