
<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Daily Time Record Information</h4></h3>
		  </div>
		  <div class="panel-body">

		<?php $work_id = (Input::has('work_id')) ? Input::get('work_id') : Input::old('employee_work_id');  ?>

		@if (Input::has('ref'))
			{{ Form::hidden('ref', Input::get('ref')) }}
		@endif
				<div class="form-group">
							
					{{ Form::label('employee_work_id', 'Employee ID', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('employee_work_id', $dtr->employee_work_id, array('class' => 'form-control', 'required') ) }}
					</div>

					 {{Form::hidden('employee_id', $dtr->employee_id)}}
				</div>


				<div class="form-group">
							
					{{ Form::label('employee_work_id', 'Name', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4" style="margin-top:5px;">
						<p> {{ $dtr->lastname . ', ' . $dtr->firstname . ' ' . $dtr->middlename}}</p>
					</div>

					 {{Form::hidden('employee_id', $dtr->employee_id)}}
				</div>


				<hr>
							<div class="form-group">
							
					{{ Form::label('work_date', 'Date', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('work_date', Input::old('work_date') , array('class' => 'form-control date', 'required', 'data-date-format' => 'YYYY-MM-DD') ) }}
					</div>
					</div>

						<div class="form-group">
							
					{{ Form::label('shift', 'shift', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::select('shift', ['ns' => 'Night shift', 'ds' => 'Day shift'] ,Input::old('shift') , array('class' => 'form-control date', 'required', 'data-date-format' => 'YYYY-MM-DD') ) }}
					</div>
					</div>

					<div class="form-group">
							
						{{ Form::label('department_id', 'Department', array('class' => 'col-sm-2 text-right')) }}

						<div class="col-sm-4">
							{{ Form::select('department_id', $departments ,Input::old('department_id') , array('class' => 'form-control', 'id' => 'department_id') ) }}
						</div>
					</div>	

					<div class="form-group">
							
						{{ Form::label('work_assignment_id', 'Work Assignment', array('class' => 'col-sm-2 text-right')) }}

						<div class="col-sm-4">
							{{ Form::select('work_assignment_id', ['Please wait while content is loaded.'] ,Input::old('work_assignment_id') , array('class' => 'form-control', 'id' =>'position_id') ) }}
						</div>
					</div>				
					<hr>

					<div class="form-group">
							
						{{ Form::label('time_in_am', 'Time in AM', array('class' => 'col-sm-2 text-right')) }}

						<div class="col-sm-2">
							{{ Form::text('time_in_am', Input::old('time_in_am') , array('class' => 'form-control date') ) }}
						</div>
					</div>	

					<div class="form-group">
							
						{{ Form::label('time_out_am', 'Time out AM', array('class' => 'col-sm-2 text-right')) }}

						<div class="col-sm-2">
							{{ Form::text('time_out_am', Input::old('time_out_am') , array('class' => 'form-control date') ) }}
						</div>
					</div>					


					<div class="form-group">
							
						{{ Form::label('time_in_pm', 'Time in PM', array('class' => 'col-sm-2 text-right')) }}

						<div class="col-sm-2">
							{{ Form::text('time_in_pm', Input::old('time_in_pm') , array('class' => 'form-control date') ) }}
						</div>
					</div>	

					<div class="form-group">
							
						{{ Form::label('time_out_pm', 'Time out PM', array('class' => 'col-sm-2 text-right')) }}

						<div class="col-sm-2">
							{{ Form::text('time_out_pm', Input::old('time_out_pm') , array('class' => 'form-control date') ) }}
						</div>
					</div>		

				<hr>


					<div class="form-group">
							
						{{ Form::label('remarks', 'Remarks', array('class' => 'col-sm-2 text-right')) }}

						<div class="col-sm-4">
							{{ Form::text('remarks', Input::old('remarks') , array('class' => 'form-control date') ) }}
						</div>
					</div>	



</div>  <!-- End of Body -->
		</div> <!-- End of Panel -->


<div class="container" id="buttons">
		<div class="form-group">
		 <div class="form-group pull-left">
		 	

	     	{{ Form::submit('Submit', array('class' => 'btn btn-primary ', 'id'=> 'processTableData')) }}
	      	 {{ Form::reset('Clear', array('class' => 'btn btn-default', 'id' => 'clear')) }} 
	      	 <div id="submitload"></div>
	      </div>
	    
		</div>
		
		
	</div>

@section('scripts')
<script type="text/javascript">
	(function() {
		var oldPosition = {{ $dtr->position_id or 0}};
		
		setTimeout(function(){
			$('#department_id').trigger('change');
		}, 1000);

		// Show positions based on the selected department
     $('#department_id').change(function(e, old) {
        var department_id = $(this).find(":selected").val();
        

        $('#position_id').parent().parent().show();
               hrApp.getSelectOptions(_globalObj._baseURL + '/positions/positionsByDepartment', department_id, 'position_id', oldPosition);
     });

	})()
</script>
@stop