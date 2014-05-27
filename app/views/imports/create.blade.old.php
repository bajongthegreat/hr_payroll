@extends('layout.master')


@section('content')

<div class="content-center">

<div class="page-header">
<h1> Import Excel</h1>
</div>


	
<div class="container">

	{{ Form::open(['action' => 'ImportsController@create', 'class' => 'form-horizontal', 'role' => 'form']) }}
			<div class="row">
	
			<div class="form-group">
						
				{{ Form::label('file', 'File: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-3">
					{{ Form::file('file', Input::old('file'), array('class' => 'form-control ', 'id' => 'file' )) }}
				</div>
				
				
			</div>

			<div class="form-group">
						
				{{ Form::label('importFor', 'Import For: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-3">
					{{ Form::select('importFor', ['employees' => 'Employees'] ,Input::old('importFor'), array('class' => 'form-control ', 'id' => 'importFor' )) }}
				</div>
				
				
			</div>

		


			<div class="form-group">

				<div class="col-sm-2"> </div>

				<div class="col-sm-3"><!-- Progress bar for Image upload -->
					<div class="progress ">
					  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					    0
					  </div>
					</div></div>
			</div>

			<div class="form-group errorContainer">

				<div class="col-sm-2"> </div>

				<div class="col-sm-3 "><!-- Progress bar for Image upload -->
						<div  class="alert alert-danger  text-center"> <span class="upload-error"></span> </div></div>
			</div>

			<div class="form-group successContainer">

				<div class="col-sm-2"> </div>

				<div class="col-sm-3 "><!-- Progress bar for Image upload -->
						<div  class="alert alert-success  text-center"> <span class="success-message"></span> </div></div>
			</div>



			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Import', array('class' => 'btn btn-primary ', 'id' => 'import', 'disabled')) }}</div>
	      </div>

	      


	      <input type="hidden" id="uploadedFileLoc" class="upload-done">
				
		

	</div>

	
		</div>
	{{ Form::close() }}

	@include('partials.errors')




</div> <!-- Content Center End -->
@stop

@section('scripts')
<script>

$('.errorContainer').hide();

$('#file').jmFileUpload({
	url: _globalObj._baseURL + '/import/upload',
	customData: { _token:  _globalObj._token},
	imageContainer: '#picture_holder',
	allowedTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel']
});


$("#uploadedFileLoc").change(function() {
	$('.errorContainer').hide();
	$('.success-message').html('File is ready for import.');
	$('#import').removeAttr('disabled');
});

$('#import').on('click', function(e) {
	e.preventDefault();

	var table = $('#importFor').val();
	var file = $('#uploadedFileLoc').val();
	var importButton = $(this);

	importButton.val('Importing...');
	importButton.attr('disabled', true);
	$('.errorContainer').hide();

	console.log(table);
	$.ajax({
		url:  _globalObj._baseURL + '/import/start',
		type: 'POST',
		data: { 'file': file , 'importFor': table },
		beforeSend: function() {
			$(this).val('Importing...');
		},
		success: function(data) {
			importButton.removeAttr('disabled');
			importButton.val('Import');
			console.log(data);
			$('.errorContainer').hide();

		},
		error: function(data) {
			importButton.removeAttr('disabled');
			importButton.val('Import');
			var response = JSON.parse(data.responseText);

			if (response.error.type == 'PHPExcel_Reader_Exception') {
				$('.upload-error').html('File not found.');
				$('.errorContainer').show();
			} else {
				$('.upload-error').html(response.error.message);
				$('.errorContainer').show();
			}

			console.log(data);

		}
	});
});


</script>
@stop