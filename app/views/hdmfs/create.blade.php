@extends('layout.master')

@section('content')

	<div class="page-header">
<h1>Add contribution</h1>
</div>


	
<div class="container">

{{ Form::open(array('action' => 'HdmfController@store', 'class'=> 'form-horizontal', 'role' => 'form')) }}

	<div class="row">

			<div class="form-group">
						
				{{ Form::label('id', 'Employee ID: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('employee_work_id', Input::old('employee_work_id'), array('class' => 'form-control') ) }}
				</div>

			</div>	
	</div>

</div>

@stop