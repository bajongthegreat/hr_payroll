@extends('layout.master')


@section('content')

<div class="content-center">

<div class="page-header">
<h1>Add Company  <a  href="{{ action('CompaniesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container">

	{{ Form::open(['action' => 'CompaniesController@store', 'class' => 'form-horizontal', 'role' => 'form']) }}

	<div class="row">
	

			<div class="form-group">
						
				{{ Form::label('name', 'Company Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('name', Input::old('name'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('address', 'Address: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::textarea('address', Input::old('address'), array('class' => 'form-control') ) }}
				</div>
				
			</div>



			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary ')) }}</div>
	      </div>
				
		

	</div>


	{{ Form::close() }}

	@include('partials.errors')


</div>

</div> <!-- Content Center End -->
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