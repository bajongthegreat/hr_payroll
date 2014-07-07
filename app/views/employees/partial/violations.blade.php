<div class="panel panel-default ">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          Violations
        </a></h4></h3>
		  </div>

		  <?php 
		  	$violations = $violations->findViolation($employee->id, 'employee_id');
	
		  ?>
			  <div class="panel panel-default smooth-panel-edges">
			  <div class="panel-body">
			    
			    <table class="table table-striped">
				  	<thead>
				  		
				  		<th width="10%">Code</th>
				  		<th width="40%">Description</th>
				  		<th width="5%">Times committed</th>
				  		<th>Penalty</th>
				  	</thead>

				  	<tbody>

				  		@foreach($violations as $violation)
				  		<?php $count = $violation->count; 
				  			  $penalty_object = $offense->getPenalty($violation->violation_id, $count);

				  			  $punishment_type = $penalty_object['punishment_type'];

				  			  if ($punishment_type == 'suspended') {
				  			  		$punishment_type = $punishment_type . ' for ' . $penalty_object['days_of_suspension'] . ' days';
				  			  }
				  		?>
				  			<tr>
				  				<td> {{ $violation->violation_code }}</td>	
				  				<td> {{ $violation->violation_description }}</td>
				  				<td> {{ $violation->count }} </td>
				  				<td> <span class="label label-warning">{{ ucfirst($punishment_type) }}</span> </td>
				  				<td> <a href="{{ action('DisciplinaryActionsController@edit', $violation->id) }}?ref={{ base64_encode(URL::current() . '?v=violations') }}&workid={{ $employee->employee_work_id }}#employee={{ $employee->employee_work_id}}" class="btn btn-default"> <span class="glyphicon glyphicon-pencil" ></span> </a></td>
				  			</tr>
				  		@endforeach
				 
				  		
				  	</tbody>

				  </table>
			  </div>
			</div>
		  

		  @if (count($violations) == 0)
		  
		  	<div class="alert alert-warning text-center smooth-panel-edges">No Violation records found.</div>

		  @endif

		  <div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		    <a href="{{ action('DisciplinaryActionsController@create') }}?ref={{ base64_encode(URL::current() . '?v=violations') }}&workid={{ $employee->employee_work_id }}#employee={{$employee->employee_work_id}}" class="btn btn-primary pull-left">Add record</a>
		    <a href="{{ action('DisciplinaryActionsController@index') }}" class="btn btn-default pull-right">Go to Disciplinary Actions </a>
		  </div>
		</div>
				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
