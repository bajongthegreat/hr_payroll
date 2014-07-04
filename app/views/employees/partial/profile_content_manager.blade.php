
	
			@if (Request::segment(3) == 'edit') 
			{{ Form::model($employee, array('method' => 'patch', 'action' => ['EmployeesController@update', $employee->employee_work_id])) }}
			


			@include('employees.partial.employee_edit')
			
			@elseif ($v == 'medical')
				@include('employees.partial.medical');
			@elseif ($v == 'leaves')
				@include('employees.partial.leaves');
			@elseif($v =='violations')
				@include('employees.partial.violations');
			@elseif($v == 'dtr')
				@include('employees.partial.dtr');
			@else
				@include('partials.requirements')
				@include('employees.partial.profile')

				
		<!-- Modal start -->

		
		<!-- Modal -->
		<div class="modal fade" id="edit_position" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">Change Position</h4>
		      </div>
		      <div class="modal-body">
		      	<input type="hidden" id="employee_id" value="{{$employee->id}}"> 
		      <form  class="form-horizontal" role="form">
			         <div class="form-group hidden">
					{{ Form::label('company_id', 'Company', array('class' => 'col-sm-3 text-right')) }}

					<div class="col-sm-8">
						{{ Form::select('company_id', $companies, $employee->company_id , array('class' => 'form-control', 'id' => 'company_id', 'required') ) }}
					</div>
			</div>


			 <div class="form-group" id="department_row">
					{{ Form::label('department_id', 'Department', array('class' => 'col-sm-3 text-right')) }}

					<div class="col-sm-8">
						{{ Form::select('department_id', [], Input::old('department_id') , array('class' => 'form-control', 'id' => 'department_id', 'required') ) }}
					</div>
			</div>

            	<div class="form-group" id="position_row">
				{{ Form::label('position_id', 'Work Assignment', array('class' => 'col-sm-3 text-right')) }}

				<div class="col-sm-8">
					{{ Form::select('position_id', [] , Input::old('position_id') , array('class' => 'form-control', 'disabled', 'id' => 'position_id', 'required') ) }}
				</div>
			</div>

			</form>	

		      	

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" id="change_position">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal end -->
			@endif
		