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
					{{ Form::select('importFor', ['employees' => 'Employees',
					                              'employees_grocery_po' => 'Grocery Purchase Orders',
					                              'employees_pharmacy_po' => 'Pharmacy PO',
					                              'employees_savings' => 'Employee Savings'] ,Input::old('importFor'), array('class' => 'form-control ', 'id' => 'importFor' )) }}
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
	if (!confirm('You are about to import an Excel data into our database. Warning, importation does not include verification of each field. Please check first if the data is in correct format then press OK, otherwise you can cancel this out and come back later.' + 
		         '<br><br> Table: ' + table)){
		
		return false;
	}
	$('.upload-info').append('<div> <strong>[5]</strong>	Assigned table name. </div>');
	console.log(table);
	
			var i = 0;
			
	var processTime = setInterval(function(){
									++i;

									$('.timer').html('<strong>Process time</strong>:  ' + i + 's');
									if (i == 30) {
										$('.upload-info').append('<br><div class="alert alert-info top-down-margin-5">Whoops! It seems like the file is a bit large. Please give us a moment to process it. :)</div>');
									}

									if (i == 90) {
										$('.upload-info').append('<br><div class="alert alert-info top-down-margin-5"> It looks like the server is having a hard time processing the data. Please hold a little longer.. </div>');
									}

									if (i == 120) {
										$('.upload-info').append('<br><div class="alert alert-info top-down-margin-5"> Patience is power. We are doing our best. We are getting there. Just do not forget to smile. :)</div>');
									}

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

			var status = "";
			
			$('.loader').html('').hide();
			$('.upload-info').append('<div><br> <strong> Import complete.</strong> </div>');
			
			$('.upload-info').append('<br><div><strong>File: </strong> '  + data.file + '</div>')

			$('.upload-info').append(data.memory_log);
			
			 status = (data.status) ? 'Success' : 'Failed';
			$('.upload-info').append('<br><div><strong>DB Insert status: </strong> '  + status + '</div>') 
			$('.upload-info').append('<br><div><strong>Total affected rows: </strong> '  + data.rows_affected + '</div>')

			$('.errorContainer').hide();
		},
		error: function(data) {
			
			var response = data.responseText;
			console.log(reponse);
			if (response.error.type == 'PHPExcel_Reader_Exception') {
				$('.upload-info').append('File not found or not readable.');
				// $('.errorContainer').show();
			} else {
				$('.upload-info').append(response.error.message);
				// $('.errorContainer').show();
			}

			// console.log(data);

		}
	});
});
</script>
@stop