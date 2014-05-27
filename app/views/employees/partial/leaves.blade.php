<div class="panel panel-default ">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          Leaves Information
        </a></h4></h3>
		  </div>

		  <?php 
		  	$leaves = $leaves->find($employee->id, 'employee_id');
		  	$accumulated_days = 0;
		  ?>
			  <div class="panel panel-default smooth-panel-edges">
			  <div class="panel-body">
			    
			    <table class="table table-striped">
				  	<thead>
				  		
				  		<th>Start date</th>
				  		<th>End date</th>
				  		<th>Duration</th>
				  		<th>Status</th>
				  	</thead>

				  	<tbody>
				 
				 	@foreach ($leaves as $leave)
				 			<?php 
				 			$duration = dateDiff($leave->start_date, $leave->end_date, 'days');
				 			if ($leave->status == 'Approved') $accumulated_days += $duration;
				 			 ?>
				 		<tr>
				 			<td> {{ $leave->start_date }}</td>
				 			<td> {{ $leave->end_date }}</td>
				 			<td> {{ $duration}}</td>
				 			<td> {{ $leave->status }}</td>
				 		</tr>

				 	@endforeach
				  		
				  	</tbody>

				  </table>
			  </div>
			</div>
		  

		  @if (count($leaves) == 0)
		  
		  	<div class="alert alert-warning text-center smooth-panel-edges">No leave records found.</div>

		  @else 

			<div class="alert alert-info text-center smooth-panel-edges"><strong>Accumulated days: </strong> {{ $accumulated_days }}	</div>

		  
		  @endif

		  <div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		    <a href="{{ action('LeavesController@create') }}?ref=profile#employee={{$employee->employee_work_id}}" class="btn btn-primary pull-left">Add record</a>
		    <a href="{{ action('LeavesController@index') }}" class="btn btn-default pull-right">Go to Leaves</a>
		  </div>
		</div>
				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
