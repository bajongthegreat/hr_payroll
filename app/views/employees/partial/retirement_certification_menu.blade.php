

{{ Form::open(array('action' => 'EmployeesController@store', 'class'=> 'form-horizontal validateForm', 'role' => 'form')) }}

	<div class="form-group">
						
				{{ Form::label('date_issued', 'Date Issued', array('class' => 'col-sm-3 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('date_issued', date('Y-m-d'), array('class' => 'form-control') ) }}
				</div>
				
	</div>

<hr>

	<div class="form-group">
						
				{{ Form::label('retirement_date', 'Date Retired', array('class' => 'col-sm-3 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('retirement_date', date('Y-m-d'), array('class' => 'form-control') ) }}
				</div>
				
	</div>

<hr>
<input type="checkbox" name="system_default" id="system_default"> Use system defaults
<hr>

	{{ Form::hidden('employee_id', $employee->employee_work_id) }}

	<div class="form-group">
						
				{{ Form::label('name', 'Name', array('class' => 'col-sm-3 text-right')) }}

				<div class="col-sm-9">
					{{ Form::text('name', $fullname , array('class' => 'form-control') ) }}
				</div>
				
	</div>


	<div class="form-group">
						
				{{ Form::label('date_hired', 'Date Hired', array('class' => 'col-sm-3 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('date_hired', $employee->date_hired, array('class' => 'form-control') ) }}
				</div>
				
	</div>


	<div class="form-group">
						
				{{ Form::label('department', 'Department', array('class' => 'col-sm-3 text-right')) }}

				<div class="col-sm-6">
					{{ Form::text('department', $employee->department_name, array('class' => 'form-control', 'id' => 'department_id') ) }}
				</div>
				
	</div>


	<div class="form-group">
						
				{{ Form::label('position', 'Position', array('class' => 'col-sm-3 text-right')) }}

				<div class="col-sm-6">
					{{ Form::text('position', $employee->position_name, array('class' => 'form-control', 'id'=>'position_id') ) }}
				</div>
				
	</div>

{{ Form::close() }}

