@extends('layout.master')

@section('content')


			<?php $v = Input::get('v'); ?>

<div class="container-fluid">


	<div class="portrait-holder col-md-4">
		
		<div class="row text-center">
				
				<div>


				<img src="{{ isset($employee->image) ? asset($employee->image): 'http://s3.amazonaws.com/37assets/svn/765-default-avatar.png' }}"  
				width="234" height="234" alt="..." class="img-thumbnail employee-img" style="height: 234px; width: 274px;"
				id="picture_holder">

				<!-- <canvas id="canvas" width="274" class="img-thumbnail" height="234" class="hidden"> -->


				</div>
				@if ($accessControl->hasAccess($uri, 'edit', $GLOBALS['_byPassRole']))
				<span ><a href="#"><span id="label-photo" class="label label-info">Click to change</span></a></span>
				<div style="margin-left: 50px; margin-top: 10px">
					{{ Form::open(['action' => 'EmployeesPhotoController@upload', 'enctype' => 'multipart/formdata']) }}
					<input type="file" name="profilepic" id="profile_pic_input" multiple="multiple" class="hidden">
					{{ Form::close() }}
			</div>
				@endif
			
		</div>

		<div class="row box">


				<div class="menu">

					<!-- Progress bar for Image upload -->
					@include('partials.progressbar')

				</div>


				<div class="profile-label"> <b>Name: </b> {{ ucfirst($employee->lastname) . ', '  .  ucfirst($employee->firstname) . ' ' . ucfirst($employee->middlename[0]) . '.' }}</div>
				<div class="profile-label"> <b>ID: </b> <?php echo (isset($employee->employee_work_id)) ? $employee->employee_work_id : 'Not specified'; ?></div>
				<div class="profile-label"> <b>Company: </b> <?php echo (isset($company)) ? $company : 'Not specified'; ?></div>
				<div class="list-group">

				   <!-- Shortcut for other route records -->
					@include('employees.partial.showlinks')  
				</div>

			</div>
			<div class="pull-left">
 <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default " style="margin-top: 15px"><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>

			</div>
				

		</div>

			

			<div class="text-center">
 		<!-- To align buttons -->
			</div>
		
 
	</div>

	<div class="separator"></div>
	@include('partials.modal')

	<div class="member-info-holder col-md-8", #holder>

			<!-- Profile content manager -->
			@include('employees.partial.profile_content_manager')

		</div>  <!-- End of Personal Information -->

		@include('partials.errors')

@stop

@section('scripts')

<script>

$('#label-photo').on('click', function() {
	$('#profile_pic_input').trigger('click');
})


$('#profile_pic_input').jmFileUpload({
	url: _globalObj._baseURL + '/employees/photo',
	customData: { _token:  _globalObj._token, employee_work_id: "{{$employee_work_id}}" },
	imageContainer: '#picture_holder'
});

 	var oldDepartment = '{{ (isset($employee->position->department_id)) ? $employee->position->department_id  : 0}}',
            	    oldPosition = '{{ (isset($employee->position->id)) ? $employee->position->id  : 0}}';


            	

            	var departmentsURL = '{{ action("DepartmentsController@departmentsByCompany") }}';
            	var positionsURL = '{{ action("PositionsController@positionsByDepartment") }}';
            	$('#department_row, #position_row').hide();

            	


            	$('#submit').on('click', function(e) {
            	
            		var submit = $(this), 
            		     clear = $('#clear'),
            		    submitLoad = $('#submitload');

            		 var url = "{{ asset('img/loading.gif') }}";

            		 // if ($('#department_id').find(":selected").val() == 0) {
            		 // 	$('#department_id').closest('.form-group').addClass('has-error');
            		 // 	e.preventDefault();
            		 // }

            		submit.fadeOut(200);
            		clear.fadeOut(200);

            		$('#submitload').html('Sending.. &nbsp; &nbsp;' + '<img src="' + url +'" class="loading">' );

            		
            		// Disable for 10 seconds
            		setTimeout(function() {
            			submit.fadeIn(200);
            			clear.fadeIn(200);

            			$('#submitload').html('');

            		}, 5000);
            	});
           
            	  $('#company_id').change(function() {


                	  var company_id = $(this).find(":selected").val();

                	  emptyOptions();

                	 

                	  if (company_id == 0) {
                	  	console.log('Please select a company');

                	  	// Enable selection of position
                	  	$('#position_id').prop('disabled',true);
                	  	$('#employment_status').prop('disabled',true);
                	  	
                	  	// Hide department row
                	  	$('#department_row').hide();
                	  	

                	  } else {
                	  	$('#department_row').show();
                	  	hrApp.getSelectOptions(departmentsURL, company_id, 'department_id', oldDepartment);

                	  	 if (oldDepartment > 0) {
                			
                	  	 	$('#department_id').trigger('change');
                	  	 	
                	 	 }
                	  
                	  	// Enable selection of position
                	  	$('#position_id').prop('disabled',false);
						$('#employment_status').prop('disabled',false);
					

                	  }
                });

                $('#date_hired, #birthdate').datetimepicker({
                    pickTime: false
                });


		 $('#department_id').change(function(e, old) {
		 	var department_id = $(this).find(":selected").val();

		 	

		 		
		 	$('#position_row').show();
             hrApp.getSelectOptions(positionsURL, department_id, 'position_id', oldPosition);
		 });

		 function emptyOptions() {
		 	$('#department_id, #position_id').empty();
		 	$('#department_row, #position_row').hide();

		 }
		 $('#company_id').triggerHandler('change');

	// (function() {
	// 	$('.progress').hide();

	// 	$('#profile_pic_input').on('change', function(e) {

	// 		var fileType = e.target.files[0].type;
	// 		var allowedTypes = ['image/jpeg','image/png'];

	// 		// Emulate PHP in_array function in Javascript
	// 		var in_array = function(type, allowedTypes) {
	// 			var found = false;

	// 			for (var i = allowedTypes.length - 1; i >= 0; i--) {
	// 				if (allowedTypes[i] == type) {
	// 					found = true;
	// 				}
	// 			};

	// 			return found;
	// 		}
			
	// 		// Terminate function if file type not allowed
	// 		if (in_array(fileType, allowedTypes) === false) {
	// 			return false;
	// 		}


	// 		// $('#picture_holder').addClass('hidden');
	// 		// $('#canvas').removeClass('hidden');


	// 		// // Get the canvas element
	// 		// var ctx = document.getElementById('canvas').getContext('2d');

	// 		// // Set as new image
	// 		// var img = new Image;

	// 		// // Fetch the URL of the selected file
	// 		// img.src = URL.createObjectURL(e.target.files[0]);

	// 		// // Load the image into canvas
	// 		// img.onload = function() {

	// 		// 	// Fill the image inside the canvas
	// 		// 	// documentation: http://www.w3schools.com/tags/canvas_drawimage.asp
	// 		//     ctx.drawImage(img, 0,0, img.height, img.width,0,0, 410,234);
	// 		// }

	// 		// Reset progress bar values
	// 		$('.progress-bar').css('width', 0+'%').html(0 + "%");

	// 		// Get all files in file input
	// 		var file = $(this).prop('files')[0];
	// 		var data = new FormData();


	// 			// Append file to Formdata
	// 			data.append('file',file);
	// 			data.append('_token', _globalObj._token);

	// 			console.log(data);


	// 		 var xhr = new XMLHttpRequest();
 //        	xhr.open('POST', _globalObj._baseURL + '/employees/photo');
 //       		 xhr.onload = function () {

 //            if (xhr.status === 200) {
 //                console.log('all done: ' + xhr.status);
 //            } else {
 //                console.log('Something went terribly wrong...');
 //            }
 //        };
 //        xhr.upload.onprogress = function (event) {
 //        	$('.progress').fadeIn(250);
 //            if (event.lengthComputable) {
 //                var complete = (event.loaded / event.total * 100 | 0);
 //                console.log(complete);
 //                $('.progress-bar').css('width', complete+'%').html(complete + "%");
 //            }
 //        };

 //        xhr.onload = function () {
 //        	 var arraybuffer = xhr.response;

 //        	 console.log(arraybuffer);
 //        };

 //        xhr.send(data);

	// 		// $.ajax({
	// 		//     url: _globalObj._baseURL + '/employees/photo',
	// 		//     type: "POST",
	// 		//     dataType: "json",
	// 		//     data: data,
	// 		//     processData: false,
	// 		//      cache: false,
 //   //     			   contentType: false,
	// 		//     complete: function() { console.log("Completed."); },
	// 		//     progress: function(evt) {
	// 		//         if (evt.lengthComputable) {
	// 		//             console.log("Loaded " + parseInt( (evt.loaded / evt.total * 100), 10) + "%");
	// 		//         }
	// 		//         else {
	// 		//             console.log("Length not computable." + evt.loaded);
	// 		//         }
	// 		//     }
			 
	// 		// });

	// 	});
	// })();

</script>
@stop