@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Edit Position  <a  href="{{ action('PositionsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container">

	{{ Form::model($position, ['action' => ['PositionsController@update', $position->id], 'method'=>'patch', 'class' => 'form-horizontal', 'role' => 'form']) }}

	<div class="row">
	

			<div class="form-group">
						
				{{ Form::label('name', 'Position Title: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('name', Input::old('name'), array('class' => 'form-control') ) }}
				</div>
				
			</div>


			<div class="form-group">
						
				{{ Form::label('department_id', 'Department', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::select('department_id', $departments, Input::old('department_id'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('lastname', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary ')) }}</div>
	      </div>
				
		

	</div>


	{{ Form::close() }}

</div>

@stop

@section('scripts')
<script>
	$(document).load(function () {
		$('#name').keyup(function () {
			var name = $(this).val();

			$.ajax({
				method: 'GET',
				data: { department: name },
				success: function(obj) {

					// Parse JSON object

					// Highlight input form if department name already exist

					// If the name doesn't exits, enable submit button
				}
			});

		});
	});
</script>
@stop