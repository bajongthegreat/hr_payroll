@extends('layout.master')


@section('content')

<div class="content-center">

<div class="page-header">
<h1> Import Excel</h1>
</div>


	
<div class="container">

	{{ Form::open(['action' => 'HolidaysController@store', 'class' => 'form-horizontal', 'role' => 'form']) }}
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

						<div  class="alert alert-success  text-center"> <span class="upload-success"></span> </div></div>
				</div>


			<div class="form-group">
				<div class="col-sm-7">

						<div  class="alert alert-warning"> <span class="upload-info"></span> </div>
				</div>
			</div>

			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Import', array('class' => 'btn btn-primary ')) }}</div>
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
	allowedTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'application/csv']
});


$("#uploadedFileLoc").change(function() {

	var table = $('#importFor').val();

	$('.upload-info').append('<div> <strong>[5]</strong>	Assigned table name. </div>');
	console.log(table);
	
			var i = 0;
			
	var processTime = setInterval(function(){
									++i;

									$('.timer').html('<strong>Process time</strong>:  ' + i + 's');

								},1000);
	$.ajax({
		url:  _globalObj._baseURL + '/import/start',
		type: 'POST',
		data: { 'file': $(this).val(), 'importFor': table },
		beforeSend: function() {

			$('.upload-info').append('<div><strong>[5]</strong> Importing process started. </div>');
			$('.upload-info').append('<div class="loader text-center"><br><strong> <img src="' + _globalObj.loaderImage + '" height="24"> Please wait...</strong>  </div>');
			$('.upload-info').append('<br><div class="timer"></div>');

		},
		success: function(data) {
			// console.log(data);

			window.clearInterval(processTime);

			$('.loader').html('').hide();
			$('.upload-info').append('<div><br> <strong> Import complete.</strong> </div>');
			
			$('.upload-info').append('<br><div><strong>File: </strong> '  + data.file + '</div>')

			$('.upload-info').append(data.memory_log);
			$('.upload-info').append('<br><div><strong>Total affected rows: </strong> '  + data.rows_affected + '</div>')

			$('.errorContainer').hide();
		},
		error: function(data) {
			
			var response = data.responseText;

			if (response.error.type == 'PHPExcel_Reader_Exception') {
				$('.upload-error').html('File not found or not readable.');
				$('.errorContainer').show();
			} else {
				$('.upload-error').html(response.error.message);
				$('.errorContainer').show();
			}

			// console.log(data);

		}
	});
});
</script>
@stop