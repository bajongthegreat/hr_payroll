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
				  		
				  		<th>Violation Code</th>
				  		<th>Date Violated</th>
				  		<th>Effectivity Date</th>
				  	</thead>

				  	<tbody>

				  		@foreach($violations as $violation)
				  			<tr>
				  				<td> {{ $violation->violation_code }}</td>	
				  				<td> {{ $violation->violation_date }}</td>
				  				<td> {{ $violation->violation_effectivity_date or '<span class="label label-default">N/A</span>' }} </td>
				  				<td> <a href="{{ action('DisciplinaryActionsController@edit', $violation->id) }}?ref={{ base64_encode(URL::current() . '?v=violations') }}#employee={{ $employee->employee_work_id}}" class="btn btn-default"> <span class="glyphicon glyphicon-pencil" ></span> </a></td>
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
		    <a href="{{ action('DisciplinaryActionsController@create') }}?ref={{ base64_encode(URL::current() . '?v=violations') }}#employee={{$employee->employee_work_id}}" class="btn btn-primary pull-left">Add record</a>
		    <a href="{{ action('DisciplinaryActionsController@index') }}" class="btn btn-default pull-right">Go to Disciplinary Actions </a>
		  </div>
		</div>
				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
