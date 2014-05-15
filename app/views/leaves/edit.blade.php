@extends('layout.master')



@section('content')

<div class="content-center">
<div class="page-header">
<h1>Update Leave Information <a  href="{{ action('LeavesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Search Employee</h4></h3>
		  </div>
		  <div class="panel-body">

	
<div class="container">



	<div class="row">

			<div class="form-group">
						
				{{ Form::label('employee_work_id', 'Employee ID: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text(NULL, $leave->employee->employee_work_id, array('class' => 'form-control', 'id' => 'employee_work_id', 'disabled') ) }}
					
				</div>  <span id="id_load" class="col-md-2"></span>

			</div>



	

	</div> <!-- Container -->
</div>  <!-- Panel Body -->


	</div> <!-- End of Panel -->




	

</div>


<div class="panel panel-default" id="employee_information">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Employee Information</h4></h3>
		  </div>
		  <div class="panel-body">

	
<div class="container">



	<div class="row">

			<div class="form-group">
						
				{{ Form::label('name', 'Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-10">
					<p id="employee_name">{{ $leave->employee->lastname . ', ' . $leave->employee->firstname . ' ' . $leave->employee->middlename}}</p>
				</div> 

			</div>

			<div class="form-group">
						
				{{ Form::label('date_hired', 'Date Hired: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-8">
					<p id="date_hired">{{ $leave->employee->date_hired }}</p>
				</div>  

			</div>



	

	</div> <!-- Container -->
</div>  <!-- Panel Body -->


	</div> <!-- End of Panel -->




	

</div>


{{ Form::model($leave, array('action' => 'LeavesController@update', 'method' => 'PATCH',  'class'=> 'form-horizontal', 'role' => 'form')) }}

	<div id="leave_information" class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Leave Information</h4></h3>
		  </div>
		  <div class="panel-body">
		  	<div class="form-group">
		  		{{ Form::hidden('id', $leave->id)}}

				{{ Form::label('type', 'Leave type:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('type', ['1' => 'Vacation Leave', '2' => 'Personal Business', '3' => 'Leave with Pay'], NULL, array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('start_date', 'Start date:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('start_date', Input::old('start_date'), array('class' => 'form-control date', 'data-format' => "YYYY-MM-DD") ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('end_date', 'End date:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('end_date', Input::old('end_date'), array('class' => 'form-control date', 'data-format' => "YYYY-MM-DD") ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('reason', 'Reason:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::textarea('reason', Input::old('reason'), array('class' => 'form-control') ) }}
				</div>
			</div>

			{{ Form::hidden('status', 'Pending')}}


		  </div> <!-- Panel Body -->
	</div> <!-- End of Panel -->

	

	<div class="container" id="buttons">

	<div class="container">
		<div class="form-group">
		 <div class="form-group pull-left">
	     	{{ Form::submit('Update', array('class' => 'btn btn-primary ', 'id'=> 'submit')) }}
	      	 {{ Form::reset('Clear', array('class' => 'btn btn-default', 'id' => 'clear' )) }} 
	      </div>
	    
		</div>
		
		{{ Form::close() }}
	</div>
		@include('partials.errors')
	</div>  <!-- Container -->



</div> <!-- Content Center End -->
@stop


@section('scripts')

<script type="text/javascript">

            $(function () {

            	// Get the hash
            	 var hash = location.hash;

            	 // Split hash value into value pairs in a variable
				  hashValue = hash.split('=', 2);

				  // If it is a pair value, get ths
				  if (hashValue.length == 2) {
				  	ajaxSearchEmployee(hashValue[1]);
				  	$('#employee_work_id').val(hashValue[1]);
				  }

				   


           		$('#employee_work_id').keyup(function(e) {
           			e.preventDefault();

           			var id = $(this).val();

           			if (e.which == 13) {
           				window.location = '#employee=' + id;
           				ajaxSearchEmployee(id)
           			}

           		});
            	
                $('#start_date, #end_date, #file_date').datetimepicker({
                    pickTime: false
                });


                  $("#start_date").on("dp.change",function (e) {
	               $('#end_date').data("DateTimePicker").setMinDate(e.date);
	            });
	            $("#end_date").on("dp.change",function (e) {
	               $('#start_date').data("DateTimePicker").setMaxDate(e.date);
	            });


	            function ajaxSearchEmployee(id) {
	            	console.log('function up');
	            	$.ajax({
           					type: 'GET',
							url: employeeLink,
							data: { searchTerm: id, output: 'json', limit: '1', stype: 'absolute'},
							beforeSend: function() {
								$(this).addClass('has-warning');
								$('#id_load').html("<img src='" + mainLink + "img/loading.gif' class=\"loading\"> 	");

							},
							success: function(data) {

								// Remove Loading Image
								$('#id_load').html("");

								if (data.length == 1) {


									var employeeName = data[0].firstname + ' ' + data[0].middlename + ' ' + data[0].lastname;
									// Show leave form
									$('#leave_information, #employee_information, #buttons').removeClass('hidden');

									
									$('#employee_name').html("" + employeeName);
									$('#date_hired').html(data[0].date_hired);
									$('#employee_id').val(data[0].id);


									
								} else {
									
									$('#employee_name').html('');
									$('#date_hired').html('');
									$('#employee_id').val('');

									$('#leave_information, #employee_information, #buttons').addClass('hidden');
									$('#id_load').html("No data found.");
									

								}
								




								
							}
           				});
	            }

            });





            moment().fromNow();
        </script>

@stop