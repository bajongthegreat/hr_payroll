@extends('layout.master')



@section('content')
<div class="content-center">

<div class="page-header">
<h1>Application for Leave <a  href="{{ action('LeavesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


<!-- Employee Search Panel -->
@include('partials.employee_search_panel')

<!-- Error container -->
@include('partials.errors')


{{ Form::open(array('action' => 'LeavesController@store', 'class'=> 'form-horizontal', 'role' => 'form', 'id' => 'storeForm')) }}

	<div id="leave_information" class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Leave Information</h4></h3>
		  </div>
		  <div class="panel-body">

		 


		  	<div class="form-group">

		  		{{ Form::hidden('employee_id', NULL, ['id' => 'employee_id'])}}
		  		{{ Form::hidden('work_id', NULL, ['id' => 'work_id'])}}

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

	<div id="result"></div>
	
	<!-- Buttons -->
	@include('partials.form_buttons')

{{ Form::close() }}


</div> <!-- Content Center End -->
@stop


@section('scripts')

<script type="text/javascript">

            $(function () {

            	$('#start_date, #end_date, #file_date').datetimepicker({
                    pickTime: false
                });

                $("#start_date").on("dp.change",function (e) {
	               $('#end_date').data("DateTimePicker").setMinDate(e.date);
	            });
	            $("#end_date").on("dp.change",function (e) {
	               $('#start_date').data("DateTimePicker").setMaxDate(e.date);
	            });


	            // ----------- AJAX transaction below -------------------

            	$('#employee_information, #leave_information').hide();


            	// Check if employee hash is present
            	// Then perform an ajax search
            	if (hrApp.hasHash()) {
            		ajaxSearchEmployee(hrApp.getHash('employee'), '#leave_information, #employee_information, #buttons', 'employee_loader');
					$('#employee_work_id').val(hrApp.getHash('employee'));
            	}
            	
    

				// Perform an AJAX search after an "Enter" key is fired
           		$('#employee_work_id').keyup(function(e) {
           			e.preventDefault();

           			var id = $(this).val();

           			// Enter key
           			if (e.which == 13) {
           				$('#work_id').val(id);
           				window.location = '#employee=' + id;
           				ajaxSearchEmployee(id, '#leave_information, #employee_information, #buttons', 'employee_loader');
           			}

           		});
            	
               
                  


	            function ajaxSearchEmployee(id, pannels, loader) {
	            	console.log('function up');
	            	
	            	$.ajax({
           					type: 'GET',
							url: employeeLink,
							data: { src: id, output: 'json', limit: '1', stype: 'absolute'},
							beforeSend: function() {
								$(this).addClass('has-warning');
								$('#employee_loader').html("<img src='" + mainLink + "img/loading.gif' class=\"loading\"> 	");

							},
							success: function(data) {


								// Remove Loading Image
								$('#' + loader).empty();

								if (data.length == 1) {

									var employeeName = hrApp.personName(data[0], "lastname_first"),
									     date_hired = moment(data[0].date_hired).format("dddd, MMMM Do YYYY");

									// Show all specified panels
									togglePanels(pannels, 'show');
									

									$('#employee_name').html("" + employeeName);
									$('#date_hired').html(date_hired);
									$('#employee_id').val(data[0].id);


									
								} else {
									
									// Remove all values to fields
									emptyFields();

									// Hide all specified panels
									togglePanels(pannels, 'hide');

									$('#' + loader).html('<span class="label label-warning">No data found</span>');
									

								}
								
								
							}
           				});
	            } // End of AJAX


	            // Toggles all Bootstrap Panels
	            function togglePanels(elements, type) {
	            	if (type == 'show') {
	            		console.log('showin')
	            		$(elements).fadeIn(250);
	            	}
	            	else 
	            	{
	            		$(elements).fadeOut(250);
	            	}
	            }

	            // Resets all values in fields
	            function emptyFields() {
	            	$('#employee_name').empty();
					$('#date_hired').empty();
					$('#employee_id').val('');
	            }






	           


            });





            moment().fromNow();
        </script>

@stop