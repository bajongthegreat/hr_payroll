
<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Medical Examination Information</h4></h3>
		  </div>
		  <div class="panel-body">

		<?php $work_id = (Input::has('work_id')) ? Input::get('work_id') : Input::old('employee_work_id');  ?>

		@if (Input::has('ref'))
			{{ Form::hidden('ref', Input::get('ref')) }}
		@endif
				<div class="form-group">
							
					{{ Form::label('employee_work_id', 'Employee ID', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('employee_work_id', $work_id, array('class' => 'form-control', 'required') ) }}
					</div>

					 {{Form::hidden('employee_id', Input::get('employee_id'))}}
				</div>


				<hr>
							<div class="form-group">
							
					{{ Form::label('date_conducted', 'Date Conducted', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-2">
						{{ Form::text('date_conducted', Input::old('date_conducted') , array('class' => 'form-control date', 'required', 'data-date-format' => 'YYYY-MM-DD') ) }}
					</div>
					</div>



				<div class="form-group">
							
					{{ Form::label('medical_establishment', 'Medical Establishment', array('class' => 'col-sm-2 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::select('medical_establishment',$medical_establishments, Input::old('medical_establishment'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>


				<div class="form-group">
							
					{{ Form::label('medical_findings', 'Medical Findings', array('class' => 'col-sm-2 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::select('medical_findings', $medical_findings ,Input::old('medical_findings'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>

				<div class="form-group">
							
					{{ Form::label('recommendation', 'Recommendation', array('class' => 'col-sm-2 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::select('recommendation',$recommendations ,Input::old('recommendation'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>

				<div class="form-group">
							
					{{ Form::label('remarks', 'Remarks', array('class' => 'col-sm-2 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::text('remarks', Input::old('remarks'), array('class' => 'form-control') ) }}
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