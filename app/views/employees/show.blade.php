@extends('layout.master')

@section('content')


			<?php $v = Input::get('v'); 

			$default_avatar = asset('img/default-avatar.png');

			?>

<div class="container-fluid">


	<div class="portrait-holder col-md-4">
		
		<div class="row text-center">
				
				<div>

				<a href="{{ isset($employee->image) && $employee->image != ""  ? asset($employee->image): $default_avatar }}" {{ isset($employee->image) ? 'data-lightbox="Profile Picture"' : '' }}>
				<img src="{{ isset($employee->image) && $employee->image != "" ? asset($employee->image): $default_avatar }}"  
				width="234" height="234" alt="..." class="img-thumbnail employee-img" style="height: 234px; width: 274px;"
					id="picture_holder"></a>

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


				<?php

					if ((isset($employee->lastname) && $employee->lastname !="") && (isset($employee->firstname) && $employee->firstname != "") && (isset($employee->middlename) && $employee->middlename != "") ) {
						$fullname = ucfirst($employee->lastname) . ', '  .  ucfirst($employee->firstname) . ' ' . $employee->name_extension . ' ' . ucfirst($employee->middlename[0]) . '.' ;
					} elseif ( (isset($employee->lastname) && $employee->lastname !="") && (isset($employee->firstname) && $employee->firstname != "") ) {
						$fullname = ucfirst($employee->lastname) . ', '  .  ucfirst($employee->firstname)  . ' ' . $employee->name_extension;

					} elseif ( (isset($employee->lastname) && $employee->lastname !="") ) {
						$fullname = '<span class="label label-warning">' . ucfirst($employee->lastname) . ' ' . $employee->name_extension . '</span>' ;
					} else {
						$fullname = "[Incomplete]";
					}
				?>

				<div class="profile-label"> <b>Name: </b> {{ $fullname  }}</div>
				<div class="profile-label"> <b>ID: </b> <?php echo (isset($employee->employee_work_id)) ? $employee->employee_work_id : 'Not specified'; ?></div>
				<hr>
				<div class="profile-label"> <b style="margin-right: 25px">Company </b> <?php echo (isset($company)) ? $company : 'Not specified'; ?></div>
				<div class="profile-label"> <b style="margin-right: 8px">Department </b> <a href="#" class="inline-edit" style="border-bottom: 2px dashed" data-toggle="modal" data-target="#edit_position"><?php echo (isset($employee->department_name)) ? $employee->department_name : 'Not specified'; ?> </a></div>
				<div class="profile-label"> <b style="margin-right: 30px">Position </b> <a href="#" class="inline-edit" style="border-bottom: 2px dashed" data-toggle="modal" data-target="#edit_position">{{ (isset($employee->position->name) ) ? $employee->position->name : '<span class="label label-default">Not specified</span>'}}  </a></div>
				<hr>

				<div class="profile-label"><b style="margin-right: 30px">Work History</b> <a class="btn btn-default ajax-modal" data-title="Work History" href="#">Manage</a> </div>

				<hr>
				<div class="profile-label"><span style="margin-right:15px;"> <b>DPC standing </b></span> <span class="label label-success">Good standing</span></div>
				<?php 
				$date = new DateTime();
				$date = $date->format('Y-m-d');
				
				$on_leave = DB::table('leaves')->where('employee_id', '=', $employee->id)->orWhere('start_date', '=', DB::raw('CURDATE()') )
																						 ->orWhere('end_date', '=', DB::raw('CURDATE()') )
				                                                                         ->where('status', '=', 'Approved')->get();
				
					if (count($on_leave) > 0) {
						echo '<div class="profile-label"> <span style="margin-right: 65px"><b>Status </b></span> <span class="label label-primary">On Leave</span </div>';	
					}

				?>


				<?php 


				?>
				<div style="margin-bottom: 15px;"></div>
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

$('._popover').popover({ html: true});

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

		 // Change Position
		 $('#change_position').on('click', function() {
		 	
		 	$(this).prop('disabled', true);
		 	employee_id = $('#employee_id').val();
		 	position_id = $('#position_id').val();

		 	$.ajax({
		 		type: 'POST',
		 		url: _globalObj._baseURL + '/employees/change_position',
		 		data: { employee_id: employee_id,
		 		        position_id: position_id,
		 		        _token: _globalObj._token },
		 		 success: function(data) {
		 		 	if (data == 1) {
		 		 		window.location.reload();
		 		 	}
		 		 }
		 	}).done(function() {
		 		$(this).prop('disabled', false);
		 		
		 	});

		 });


</script>
@stop