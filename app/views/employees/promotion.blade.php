@extends('layout.master')


@section('content')


<div class="page-header" >
<h1>Promote Employee  <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container" ng-controller="EmployeeController">

	{{ Form::open(['action' => 'EmployeesController@promote', 'class' => 'form-horizontal', 'role' => 'form']) }}


			<div class="form-group">
						
				{{ Form::label('employee_id', 'Employee Name ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					
					<select name="employee_id" class="form-control" id="#promote_employee_select">

						@foreach($employees as $employee)
							<option value="{{ $employee->id }}"> {{ ucfirst($employee->lastname) }}, {{ $employee->firstname }} {{ ucfirst($employee->middlename[0])}}</option>
						@endforeach

					</select>
				</div>
				
			</div>


			<div class="form-group hide">
						
				{{ Form::label('current_position', 'Current Position: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					<p> Current Position</p>
				</div>

			</div>

			<div class="form-group hide">
						
				{{ Form::label('position_id', 'Promote to ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					
					<select name="position_id" class="form-control">

						

					</select>
				</div>
				
			</div>




		

			<div class="form-group">
						
				{{ Form::label('lastname', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::button('Submit', array('class' => 'btn btn-primary ', 'data-ng-click'=> 'promoteClick(demo)')) }}</div>
	      </div>
				
		

	</div>


	{{ Form::close() }}


<script type="text/javascript">

</script>
</div>

@stop

@section('after_jquery')
<script>
	(function($) {
		
		
	})(jQuery)
</script>
@stop