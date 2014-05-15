@extends('layout.master')


@section('content')

<div class="content-center">

<div class="page-header">
<h1>Add Position  <a  href="{{ action('PositionsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container">

	{{ Form::open(['action' => 'PositionsController@store', 'class' => 'form-horizontal', 'role' => 'form']) }}

	<div class="row">
			
			<div class="form-group">
						
				{{ Form::label('company_id', 'Please select a company', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::select('company_id', $companies, Input::old('company_id'), array('class' => 'form-control', 'id' => 'company_id') ) }}
				</div>
				
			</div>

			<div class="form-container">

					<div class="form-group">
						
				{{ Form::label('department_id', 'Department', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					<select class="form-control" id="department" name="department_id">
						
					</select>
				</div>
				
			</div>


				<div class="form-group">
						
				{{ Form::label('name', 'Position Title: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'id' => 'name') ) }}
				</div>
				
			</div>


		

			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary','disabled', 'id'=>'submit')) }}</div>
			</div>
	      </div>
				
		

	</div>


	{{ Form::close() }}

</div>

</div>

@stop

@section('scripts')
<script>
$('.form-container').hide();

$(function() {
	var departmentsURL = '{{ action("DepartmentsController@departmentsByCompany") }}';
	

	formContainer = $('.form-container');

	// Check if employee hash is present
    // Then perform an ajax search
    if (hrApp.hasHash()) {
        formContainer.fadeIn(250);
        isCompanySelected( $('#company_id').val());
     }


	
	// Company Selection
	$('#company_id').change(function() {
		var selected = $(this).val(),
		    element = 'department';

		isCompanySelected(selected);

		hrApp.getSelectOptions(departmentsURL, selected, element);
		
	});

	


	// Department Selection

	$('#name').keyup(function(e) {
	
		if ($(this).val().length > 1) {

			$('#submit').prop('disabled', false);
		} else {
			$('#submit').prop('disabled', true);
		}
	});

	function isCompanySelected(selected) {
		if (selected == 0) {
			formContainer.fadeOut(250);
		} else {
			formContainer.fadeIn(250);
		}
	}


}());



</script>
@stop