<div class="panel panel-default ">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          Violations
        </a></h4></h3>
		  </div>

		  <?php 
		  	$violations = $violations->find($employee->id, 'employee_id');
		  	
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

				 
				  		
				  	</tbody>

				  </table>
			  </div>
			</div>
		  

		  @if (count($violations) == 0)
		  
		  	<div class="alert alert-warning text-center smooth-panel-edges">No leave records found.</div>

		  @endif

		  <div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		    <a href="{{ action('LeavesController@create') }}?ref=profile#employee={{$employee->employee_work_id}}" class="btn btn-primary pull-left">Add record</a>
		    <a href="{{ action('LeavesController@index') }}" class="btn btn-default pull-right">Go to Leaves</a>
		  </div>
		</div>
				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
