
	
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
			@endif
		