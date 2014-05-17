<!-- Needs Requirements -->
		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#requirements_overview">Requirements Overview</a></h3>
		  </div>
		  <div class="panel-body">

		  	 <div  id="requirements_overview" class="panel-body panel-collapse collapse in">
		   
<?php 

	$employee_requirement_helper = new Acme\Helpers\EmployeeRequirementHelper();
	$sp = ['Interview', 'Orientation'];

	$id = isset($applicant->id) ? $applicant->id : $employee->id;
	$canEdit = $accessControl->hasAccess($uri, 'edit', $GLOBALS['_byPassRole']);

?>			
	
		@foreach ($sp as $stage) 

		  	<strong>{{ $stage }}</strong>
		    <ul class="list-group" style="list-style: none;">
		      @foreach ($requirements as $requirement)
			       @if ($requirement->StageProcess->stage_process == $stage)
			         <?php 

			         	$type = 'pass';
			         	$requirement_class = ($canEdit) ? '_applicant_show_requirement' : "";
			         	if (!$employee_requirement_helper->isRequirementPassed($requirement->id, $id)) {
			         		$button = ($canEdit) ? '<span class="label label-info">Submit</span>' : "";
			         		$icon = '<a href="#"  class="requirement_class"> '  .$button . ' <span class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></a>';
			         	} else {
			         		$type = 'remove';
			         		$button = ($canEdit) ? '<span class="label label-default">Redo</span>' : "";
			         		$icon = '<a href="#" class="$requirement_class"> ' . $button .' <span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span></a>';
			         	}
			         ?>
					 <li data-type="{{ $type }}" data-document="{{ ucfirst($requirement->document) }}" data-applicant_id="{{ $id }}" data-requirement_id="{{ $requirement->id }}"> {{$icon}} {{ ucfirst($requirement->document) . " (" . (ucfirst($requirement->document_type)) . ")" }} </li>		      
				   @endif
		      @endforeach

		      <hr>

		@endforeach



		  </div>
		</div>
	</div>