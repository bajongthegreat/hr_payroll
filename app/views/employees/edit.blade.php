@extends('layout.master')




@section('content')



<div class="page-header">
<h1>Update Member Information  <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
 
</div>


	
<div class="container">

{{ Form::model($employee, array('method' => 'patch', 'action' => ['EmployeesController@update', $employee->employee_work_id], 'class'=> 'form-horizontal', 'role' => 'form')) }}

@include('employees.partial.employee_form')





		<div class="form-group">
	     <div class="col-sm-2">{{ Form::submit('Update Member', array('class' => 'btn btn-primary ')) }}</div>
	      <div class="col-sm-2"> {{ Form::reset('Clear', array('class' => 'btn btn-default')) }} </div>
		</div>
		
		{{ Form::close() }}
	</div>

	@include('partials.errors')

</div>

@stop


@section('scripts')

<script type="text/javascript">

            $(function () {
            	
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

            	
            });


	
        </script>
@stop