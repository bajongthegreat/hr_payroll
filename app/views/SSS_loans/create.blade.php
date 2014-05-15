@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Add SSS Loan record  <a  href="{{ action('SSS_loansController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>



<!-- Employee Search Panel -->
@include('partials.employee_search_panel')

<!-- Error container -->
@include('partials.errors')




	{{ Form::open(['action' => 'SSS_loansController@store', 'class' => 'form-horizontal', 'role' => 'form']) }}

	
	<div id="loan_information" class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Leave Information</h4></h3>
		  </div>
		  <div class="panel-body">

		
				{{ Form::hidden('employee_id', NULL, ['id' => 'employee_id'])}}
		  		{{ Form::hidden('work_id', NULL, ['id' => 'work_id'])}}

			<div class="form-group">
						
				{{ Form::label('sss_id', 'SSS ID: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::text('sss_id', Input::old('sss_id'), array('class' => 'form-control', 'required') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('date_issued', 'Date Issued: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('date_issued', Input::old('date_issued'), array('class' => 'form-control', 'data-format' => "YYYY-MM-DD") ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('loan_amount', 'Loan Amount: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('loan_amount', Input::old('loan_amount'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('salary_deduction_start', 'Start of Salary Deduction: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('salary_deduction_start', Input::old('salary_deduction_start'), array('class' => 'form-control', 'data-format' => "YYYY-MM-DD") ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('monthly_amortization', 'Monthly Amortization: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('monthly_amortization', Input::old('monthly_amortization'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('duration_in_months', 'Duration in Months: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('duration_in_months', Input::old('duration_in_months'), array('class' => 'form-control') ) }}
				</div>
				
			</div>





			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary ')) }}</div>
	      </div>
				
		</div>

	 </div> <!-- Panel Body -->



	</div> <!-- End of Panel -->


	{{ Form::close() }}





@stop

@section('scripts')

<script type="text/javascript">

            $(function () {

            	$('#salary_deduction_start, #date_issued').datetimepicker({
                    pickTime: false
                });

                $("#start_date").on("dp.change",function (e) {
	               $('#end_date').data("DateTimePicker").setMinDate(e.date);
	            });
	            $("#end_date").on("dp.change",function (e) {
	               $('#start_date').data("DateTimePicker").setMaxDate(e.date);
	            });


	            // ----------- AJAX transaction below -------------------
	            var panels = '#loan_information, #employee_information, #buttons';
				
				// Hide all specified panels
				togglePanels(panels, 'hide');


            	// Check if employee hash is present
            	// Then perform an ajax search
            	if (hrApp.hasHash()) {
            		ajaxSearchEmployee(hrApp.getHash('employee'), panels, 'employee_loader');
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
           				ajaxSearchEmployee(id, panels, 'employee_loader');
           			}

           		});
            	
               
                  


	            function ajaxSearchEmployee(id, pannels, loader) {

	            	$('#work_id').val(id);

	            	console.log('function up');
	            	
	            	$.ajax({
           					type: 'GET',
							url: employeeLink,
							data: { searchTerm: id, output: 'json', limit: '1', stype: 'absolute'},
							beforeSend: function() {
								$(this).addClass('has-warning');
								$('#' + loader).html("<img src='" + mainLink + "img/loading.gif' class=\"loading\"> 	");

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

									$('#errors').hide()

									$('#' + loader).html('<span class="label label-warning">No data found</span>');
									

								}
								
								
							}
           				});
	            } // End of ajaxSearchEmployee


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

        </script>

@stop