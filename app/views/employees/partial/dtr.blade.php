<div class="panel panel-default ">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          Daily Time record
        </a></h4></h3>
		  </div>

			  <div class="panel panel-default smooth-panel-edges">
			  <div class="panel-body">
				
			  	<div>

		  	<div class="row">

				<div class="form-group">
							
					<label class="col-sm-4 text-right">Filter</label>

					<div class="col-sm-4">
						<input class="form-control" required name="filter">
						
					</div>

				</div>
			</div>

			  	</div>

			    <table class="table table-striped">
				  	<thead>
				  		
				  		<th>Time in AM</th>
				  		<th>Time out AM</th>
				  		<th>Time in PM</th>
				  		<th>Time in PM</th>
				  		<th>Shift</th>
				  		<th>Work Assignment</th>
				  	</thead>

				  	<tbody>
				 
				  	</tbody>

				  </table>
			  </div>
			</div>
		  

		  

		  <div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		    <a href="{{ action('DTRController@create') }}?ref={{ base64_encode(URL::current() . '?v=dtr')}}#employee={{$employee->employee_work_id}}" class="btn btn-primary pull-left">Add record</a>
		    <a href="{{ action('DTRController@index') }}" class="btn btn-default pull-right">Go to Daily Time Records</a>
		  </div>
		</div>
				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
