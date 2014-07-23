@extends('layout.master')

@section('content')
<style type="text/css">

.export-loader {
	font-size: 10px;
}
.track-progress {
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.track-progress li {
  list-style-type: none;
  display: inline-block;

  position: relative;
  margin: 0;
  padding: 0;

  text-align: center;
  line-height: 30px;
  height: 30px;

  background-color: #f0f0f0;
}
.track-progress[data-steps="3"] li { width: 23%; }
.track-progress[data-steps="4"] li { width: 25%; }
.track-progress[data-steps="5"] li { width: 20%; }
.track-progress[data-steps="6"] li { width: 15%; }

.track-progress li > span {
  display: block;

  color: #999;
  text-transform: uppercase;
}

.track-progress li.done > span {
  color: #666;
  background-color: #ccc;
}

.track-progress li[data-step="5"].done > span {
  color: #FFFFFF;
  background-color: #449d44;
}
/* Create arrows */
.track-progress li > span:after,
.track-progress li > span:before {
  content: "";
  display: block;
  width: 0px;
  height: 0px;

  position: absolute;
  top: 0;
  left: 0;

  border: solid transparent;
  border-left-color: #f0f0f0;
  border-width: 15px;
}

.track-progress li > span:after {
  top: -5px;
  z-index: 1;
  border-left-color: white;
  border-width: 20px;
}

.track-progress li > span:before {
  z-index: 2;
}

/* make the arrow colors match the state of the previous step and remove the arrow in the first element */
.track-progress li.done + li > span:before {
  border-left-color: #ccc;
}

.track-progress li:first-child > span:after,
.track-progress li:first-child > span:before {
  display: none;
}


.track-progress li:first-child i,
.track-progress li:last-child i {
  display: block;
  height: 0;
  width: 0;

  position: absolute;
  top: 0;
  left: 0;

  border: solid transparent;
  border-left-color: white;
  border-width: 15px;
}

.track-progress li:last-child i {
  left: auto;
  right: -15px;

  border-left-color: transparent;
  border-top-color: white;
  border-bottom-color: white;
}
</style>
	<div class="page-header">
<h1>Process Payroll</h1>
</div>

	
<div class="container">
  <ol class="track-progress" data-steps="5">
   <li class="step-header done"  data-step="1">
     <span> <span class="badge">1</span>  Select Pay Period</span>
     <i></i>
   </li><!--
--><li class="step-header" data-step="2">
     <span><span class="badge">2</span>  Select Company</span>
   </li><!--
--><li  class="step-header" data-step="3">
     <span><span class="badge">3</span>  Include Employees</span>
     <i></i>
   </li><li class="step-header" data-step="4" >
     <span><span class="badge">4</span>  Review Employees</span>
   </li><li class="step-header" data-step="5">
     <span><span class="badge">5</span>  Payroll</span>
   </li><!--
-->
 </ol>

<br>
	<!-- Select Pay Period -->
	<div class="panel panel-default" id="step1" >
	  <div class="panel-heading">
	    <h3 class="panel-title">Payroll Period</h3>
	  </div>
	  <div class="panel-body">
	    
	    	<div class="container">
			       
			       <div class='col-md-5' style="margin-left: 50px;">
			            <div class="form-group">
			                <div class='input-group date' id='datetimepicker8' data-date-format="YYYY-MM-DD">
			                    <input type='text' id="start_date" class="form-control text-center" placeholder="Start of Payroll" required/>
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
			        </div>
			        
			        <div class='col-md-5'>
			            <div class="form-group">
			                <div class='input-group date' id='datetimepicker9' data-date-format="YYYY-MM-DD">
			                    <input type='text' id="end_date" class="form-control text-center" placeholder="End of Payroll" required/>
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
			        </div>
			    	
			    	<div class="col-xs-11" id="step1_error" style="display:none;">
			    		<div class="alert alert-warning">
			        	<strong>Warning!</strong> <span class='step1_error_message'></span>
			        </div>

			    	</div>
			        
			    	<div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center" data-step="1">
			                <a href="#select_company" class="btn btn-default next">Next  <span class="glyphicon glyphicon-chevron-right	"></span></a>
			            </div>
			        </div>    
			    
			</div>
	    
	  </div>
	</div>


	<!-- Select Company -->
	<div class="panel panel-default" id="step2" data-step="2">
	  <div class="panel-heading">
	    <h3 class="panel-title">For Company</h3>
	  </div>
	  <div class="panel-body">
	    
	    	<div class="container">
			       

			        <div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center">
			                {{ Form::select('company_id', $companies, Input::get('company_id'),  ['class' => 'form-control text-center', 'id'=> 'company_id']) }}    
			            </div>
			        </div>    
					
					<input type="hidden" id="employees_container">
			    	
			    	<div class="col-xs-11" id="step2_error" style="display:none;">
			    		<div class="alert alert-warning">
			        	<strong>Warning!</strong> <span class='step2_error_message'></span>
			        	</div>
			    	</div>

			    	<div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center" data-step="2">
			                <a href="#" class="btn btn-default prev"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a>
			                <a href="#employees_to_include" class="btn btn-default next">Next  <span class="glyphicon glyphicon-chevron-right	"></span></a>
			            </div>
			        </div>    
			    
			</div>

	  </div>
	</div>

	<!-- Employees Included -->
	<div class="panel panel-default" id="step3" data-step="3">
	  <div class="panel-heading">
	    <h3 class="panel-title">Employees Included</h3>
	  </div>
	  <div class="panel-body">
	    
	    	<div class="container">
			       
			      <div class="col-md-11 text-center"> 
			      	<div class="page-header-def">
					  <h2><small>Please select whose to include in our Payroll Process</small></h2>
					</div>
			     	

					<div class="list-group employee_type_select">
					  <a href="#all_employees" data-type="all" class="list-group-item panel-title active">
					    <span class="badge"> <span class="all_employees_badge">0</span></span>
					    All employees
					  </a>
					  <a href="#by_department_container"  data-type="department" data-toggle="collapse" class="list-group-item panel-title">By Department</a>
					  <div id="by_department_container" style="margin-top: 15px"   class="wrappedChild panel-collapse collapse">
									  		
					  		<!-- Departments -->
					  		@foreach ($departments as $key => $department)
						  		<div  class="departments_panel" class="panel panel-default">
								  <div class="panel-heading">
								  	<input type="checkbox" class="pull-left">

								    <a href="#__{{str_replace(' ', '_', strtolower($department))}}" data-toggle="collapse">
								    	
								    	{{$department}}
								    	<span class="badge"> <span class="__{{str_replace(' ', '_', strtolower($department))}}_badge" id="__department_{{$key}}">0</span></span>
								    	 </a>
								  </div>
								 <div id="__{{str_replace(' ', '_', strtolower($department))}}" class="panel-collapse collapse">
								    
								  	<div class="panel-body">
								    </div>
								 </div>
								</div>
							@endforeach
							

							<!-- End of Departments -->
					  </div>

					</div>
			    	
			    	<div class="col-xs-11" id="step3_error" style="display:none;">
			    		<div class="alert alert-warning">
			        	<strong>Warning!</strong> <span class='step3_error_message'></span>
			        	</div>
			    	</div>

			    	<div class='col-md-10' style="margin-left: 75px;">
			            <div class="form-group text-center" data-step="3">
			                <a href="#" class="btn btn-default prev"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a>
			                <a href="#review_employees" class="btn btn-default next" id="employees_include">Next  <span class="glyphicon glyphicon-chevron-right	"></span></a>
			            </div>
			        </div>

			    </div>
			    
			</div>
	    
	  </div>
	</div>

	<!-- Review Employees -->
	<div class="panel panel-default" id="step4" data-step="4">
	  <div class="panel-heading">
	    <h3 class="panel-title">Review employees</h3>
	  </div>
	  <div class="panel-body">
	    
	    	<div class="container">
			     
			     <div class="col-md-11 text-center"> 
			      	<div class="page-header-def">
					  <h2><small class="filter_type"></small></h2>
					</div>
			      </div> 

			        <div class='col-md-10' style="margin-left: 50px; margin-top: 25px;">
			            <table class="table table-bordered re_table">
			            	<thead>
			            		<th>Name <span class="badge"> <span class="employees_counter">0</span></span></th>
			            		<th>Days worked</th>
			            	</thead>

			            	<tbody id="employees_list">

			            	</tbody>	

			            </table>
			        </div>    
	
			    	
			    	<div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center" data-step="4">
			                <a href="#" class="btn btn-default prev"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a>
			                <a href="#process" id="process_payroll" class="btn btn-primary next">Begin Process  </span></a>
			            </div>
			        </div>    
			    
			</div>

	  </div>
	</div>


	<!-- Processed Payroll Data -->
	<div class="panel panel-default" id="step5" data-step="5">
	  <div class="panel-heading">
	    <h3 class="panel-title">Condensed View [Payroll]</h3>
	  </div>
	  <div class="panel-body">
	    
	    	<div class="container">
			     
			     <div class="col-md-11 text-center"> 
			      	<div class="page-header-def">
			      		<span data-step="5">
			      		  <a href="#" class="btn btn-default prev pull-left"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a> 
			      		  </span>
			      		<!-- <span class="pull-right" style="font-size: 10px;"><a href="#step5" class="export-excel">Export Excel</a></span> -->
					  <h2><small>For Pay Period <span class="pay_period"></span></small></h2>
					</div>
					<br>
					<div class="list-group">
      <a href="#" target="_blank" class="list-group-item active detailed_view">
        <h4 class="list-group-item-heading">Expanded View</h4>
        <p class="list-group-item-text">View detailed payroll data.</p>
      </a>
      <a href="#" class="list-group-item export-excel">
        <h4 class="list-group-item-heading">Export <span class="export-loader"></span></h4>
        <p class="list-group-item-text">Creates a file version of this report generated by the system.</p>
      </a>
    </div>
			      </div> 





			        <div class='col-md-10' style="margin-left: 50px; margin-top: 25px;">
			            <table class="table table-bordered tablesorter">
			            	<thead>
			            		<th>ID</th>
			            		<th width="30%">Name</th>
			            		<th>Days worked</th>
			            		<th>Gross Pay</th>
			            		<th>Deductions</th>
			            		<th>Net Pay</th>
			            	</thead>

			            	<tbody id="payroll_list">

			            	</tbody>	

			            </table>

			            <div class="loader"></div>

			            <input type="hidden" name="payroll" class="payroll">

			        </div>       
			    
			</div>

	  </div>
	</div>




</div>

@stop

@section('scripts')

			    <script type="text/javascript">
			        $(function () {
			            $('#datetimepicker8').datetimepicker({ pickTime: false });
			            $('#datetimepicker9').datetimepicker({ pickTime: false });
			            $("#datetimepicker8").on("dp.change",function (e) {
			               $('#datetimepicker9').data("DateTimePicker").setMinDate(e.date);
			            });
			            $("#datetimepicker9").on("dp.change",function (e) {
			               $('#datetimepicker8').data("DateTimePicker").setMaxDate(e.date);
			            });

			            $('.list-group-item').on('click', function() {
			            	$('.list-group-item').removeClass('active');

			            	$(this).addClass('active');
			            });
			        	
			            function stepMessage(step, message, toggle) {
			            	if (toggle == 'show') {
			            		$('.step'+ step +'_error_message').html(message);
			            		$('#step' + step +'_error').show();

			            	} else {
			            		$('#step' + step +'_error').hide();
			            	}
			            };

			        	$('#company_id').on('change', function() {
			        		$.ajax({
			        			type: 'GET',
			        			url: _globalObj._baseURL + '/payroll/dtr',
			        			data: { 'company_id' : $(this).val(), 
			        			        'start_date': $('#start_date').val(),
			        			        'end_date': $('#end_date').val(),
			        			        'unique': true,
			        			        'count':true,
			        			        'jq_ax': true },
			        			 success: function(data) {
			        			 	$('.all_employees_badge').html(data.count + ' found');
			        			 	console.log(data);
			        			 	var seen = {};	
			        			 	var json_data = data.departments;
			        			 	
			        			 	$('#employees_container').val( JSON.stringify(data.raw_data) );
			        			 	
			        			 	// Add same value 
			        			 	json_data.forEach(function(value, i, arr) {
			        			 		if (seen[value] != undefined) {
			        			 			seen[value] = seen[value] + 1;
			        			 		} else {
			        			 			seen[value] = 1;
			        			 		}
			        			 	});


			        			 	$.each(seen, function(value, i, arr) {
			        			 		$('#__department_' + i).html(value)
			        			 	});	



			        			 }
			        		});
			        	});

						$('#employees_include').on('click', function(e) {

							var employees;
							var seen = [];

							if ($('#employees_container').val().length > 0 ) {
								employees = JSON.parse( $('#employees_container').val() );
								var list_group = $('.employee_type_select').find('.list-group-item');
								
								var days_worked;
								// Department/Position Days worked
								var days_worked_dp;

								if (list_group.hasClass('active') === true) {
										var selection_type = list_group.data('type');

										if (selection_type == 'all') {
											$('.filter_type').html('Selecting all employees with DTR based on date range');

											var _html = "";
											var hours = 0;
											$('#employees_list').html('');

											$.each(employees, function(key, value) {

												hours = calculateTotalHours(employees[key].time_in_am, employees[key].time_out_am, employees[key].time_in_pm, employees[key].time_out_pm, employees[key].shift);
												

												if (__in_array(employees[key].employee_id, seen)) {
													// if ($('.' + 'dp_' + employees[key].department_id + '_'+ employees[key].work_assignment_id).length <=1) {													

													// 	_html = '<tr class="dp_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">';
													// 	_html +='<td>' + employees[key].department_name +'</td>';
													// 	_html +='<td>' + employees[key].position_name +'</td>';
														
													// 	_html +='<td><span class="days_worked_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">' + 0 +'</span></td>';
													// 	_html +='<td>><span class="hours_worked_' + employees[key].department_id + '_' + employees[key].work_assignment_id + '">' + hours.total +'</span></td>';
											
													// 	_html += '</tr>';


													// 	$('.parent_' + employees[key].employee_id).find('tbody').append(_html);
													// }

													// days_worked = parseInt($('.parent_days_worked_' + employees[key].employee_id).html());
													// $('.parent_days_worked_' + employees[key].employee_id).html(days_worked+1);
													
													// days_worked_dp = $('.parent_' + employees[key].employee_id).find('.days_worked_' + employees[key].department_id + '_' + employees[key].work_assignment_id);
													// hours_worked_dp = $('.parent_' + employees[key].employee_id).find('.hours_worked_' + employees[key].department_id + '_' + employees[key].work_assignment_id);
													// days_worked_dp.html( parseInt(days_worked_dp.html())+1 );
													// hours_worked_dp.html( parseInt(hours_worked_dp.html()) + hours.total );
													return true;
												}
												else {
													seen.push(employees[key].employee_id);


													_html = '<tr>';
													_html += '<td data-employee_id="' + employees[key].employee_id +'"> <span class="expand_dtr glyphicon glyphicon-plus-sign"></span>  ' + employees[key].lastname + ', ' + employees[key].firstname + ' ' +'</td>';
													_html +='<td>' + '<span class="parent_days_worked_'+ employees[key].employee_id +'">' + 1 + '</span>' +'</td>';
													_html += '</tr>';

													// _html += '<tr class="parent_' + employees[key].employee_id +'"  style="display:none;">';
													// _html += '<td colspan="4">' + '<div class="well">' + 
													// 					'<table class="table table-hover">' +
													//                 			'<thead>' +
													//                 				'<th>Department</th>' +
													//                 				'<th>Position </th>' +
													//                 				'<th>Days worked </th>' +
													//                 			'</thead>' +
													//                 		'<tbody>' + 
													//                 		'</tbody>' +
													//                 	'</table>' +'</div>' +'</td>';
													// _html += '</tr>';
													
													$('#employees_list').append(_html);

													// _html = '<tr class="dp_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">';
													// _html +='<td>' + employees[key].department_name +'</td>';
													// _html +='<td>' + employees[key].position_name +'</td>';

													// _html +='<td><span class="days_worked_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">' + 1 +'</span></td>';
													// _html +='<td><span class="hours_worked_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">' + hours.total +'</span></td>';
													
													// _html += '</tr>';

													// $('.parent_' + employees[key].employee_id).find('tbody').append(_html);
													
												}
											    
											});

											console.log('displaying all dtr');
											console.log(seen);
										} else if (selection_type == 'department') {
											$('.filter_type').html('Selecting employees by department with DTR based on date range');
											console.log('displaying by department');
										}

										$('.re_table').dataTable();
								}
							}

							e.preventDefault();
							e.stopPropagation();
							
						});

						$(document).on('click', '.expand_dtr', function() {
								var employee_id = $(this).parent().data('employee_id');

								var child = $('.parent_' + employee_id);

								if (child.is(':visible') ) {
									child.fadeOut(50);
								} else {
									child.fadeIn();
								}
						});

						$('#step4').on('click', function(e) {

							// Make an AJAX call
							$.ajax({
								type: 'POST',
								url: _globalObj._baseURL + '/payroll/process',
								data: { start_date: $('#start_date').val(),
							            end_date: $('#end_date').val(),
							            company_id: $('#company_id').val(),
							            token: _globalObj._token },
							    beforeSend: function() {
							    	$('.loader').html('<div class="text-center"><img src="' + _globalObj.loaderImage + '"> <span style="font-size: 10px;">Please wait while the data is being fetched.</span></div>');
							    },
							    success: function(payroll) {
							    	var row = "";
							    	$('.loader').html('');
							    	$('#payroll_list').html('');


							    	$.each(payroll.data, function(employee_id, employee) {
							    		row = '<tr>';
							    		row += 	'<td>' + employee.employee_id + '</td>';
							    		row += 	'<td>' + employee.name + '</td>';
							    		row += 	'<td>' + employee.days_worked + '</td>';
							    		row += 	'<td>' + employee.grosspay + '</td>';							    		
							    		row += 	'<td>' + employee.deductions + '</td>';
							    		row += 	'<td>' + employee.netpay + '</td>';
							    		 
							    		$('#payroll_list').append(row);


							    	});

							    	$('.payroll').val( JSON.stringify(payroll.json) );
							    }
							}).done(function() {
								$('.tablesorter').dataTable();
								// $('.detailed_view').attr("href", _globalObj._baseURL + "/payroll/detailed_view" +  encodeURI("?" + "file=" + data + "&start=" + date_start + "&end=" + date_end) );
							});




							$(this).prop('disabled', false);
							e.preventDefault();

						});
						
						var max_form_count = 5;
				
							// Form wizard
							for(var i=1; i<=5; i++) {
								if (i== 1 ){ continue; }

								$("#step" + i).hide();
							}

							$('.next').on('click', function() {
								var current = $(this).parent().data('step');
								var nextPage = $(this).parent().data('step') + 1;

								// Validate forms

								// Step 1
								if (current == 1) {
									var start_date = $('#start_date');
									var end_date = $('#end_date');

									// Check if empty [Start date]
									if (start_date.val() == '' || start_date.val() == '0000-00-00') {
										// start_date.addCl
										start_date.parent().parent().addClass('has-error');
										stepMessage(1, 'Please enter the starting date!', 'show');
										return false;
									} else start_date.parent().parent().removeClass('has-error');
 	
 									// Check if empty [End date]
									if (end_date.val() == '' || end_date.val() == '0000-00-00') {
										// start_date.addCl
										end_date.parent().parent().addClass('has-error');
										stepMessage(1, 'Please enter the ending date!', 'show');
										return false;
									} else end_date.parent().parent().removeClass('has-error'); 


									// Check for validity of date
									if (! moment( start_date.val() , 'YYYY-MM-DD', true).isValid() ) {
										start_date.parent().parent().addClass('has-error');
										stepMessage(1, 'Invalid date format for starting date!', 'show');
										return false;
									}

									if (! moment( end_date.val() , 'YYYY-MM-DD', true).isValid() ) {
										end_date.parent().parent().addClass('has-error');
										stepMessage(1, 'Invalid date format for ending date!', 'show');
										return false;
									}

									// Check if End date is after start date
									if (!moment(end_date.val()).isAfter( start_date.val() )) {
										stepMessage(1, 'The starting period date must be before the ending period not after!', 'show');
										return false;
									}
									 stepMessage(1, '', 'hide');
 
								}
								// Step 2
								if (current == 2){
									var company_id_form = $('#company_id');
									
									if ($('#company_id').val() == 0) {
										company_id_form.parent().addClass('has-error');
										stepMessage(2, 'Please select company', 'show');
										return false;
										
									} else company_id_form.parent().removeClass('has-error');
									
									stepMessage(2, '', 'hide');
								}
								
								// Step 3
								if (current == 3) {
									var employee_count = parseInt($('.all_employees_badge').html());

									if (isNaN(employee_count) || employee_count == 0) {
										stepMessage(3, 'No data to process. Please go back to step 1 and select other dates.', 'show');
										return false;
									}
									stepMessage(3, '', 'hide');
								}

								if (nextPage <= max_form_count) {
									$('#step' + nextPage).show();
									$('#step' + current).hide();

									$.each($('.step-header'), function(key, value) {
											if ($(this).data('step') == nextPage) {
												$(this).addClass('done');
											}
									});

								}
							});

							$('.prev').on('click', function() {
								var current = $(this).parent().data('step');
								var prevPage = $(this).parent().data('step') - 1;

								if (prevPage > 0) {
									$('#step' + prevPage).show();
									$('#step' + current).hide();									
								}

								$.each($('.step-header'), function(key, value) {
											if ($(this).data('step') == current) {
												$(this).removeClass('done');
											}
									});

							});

							$('.export-excel').on('click', function(e) {
								var data =  $('.payroll').val();
								var date_start = $('#start_date').val();
								var date_end = $('#end_date').val();
								console.log('wa');

								var _this = $(this);

								$(this).find('.export-loader').html('(Generating spreadsheet...)');
								setTimeout(function() {
									$(_this).find('.export-loader').html('(If download pop-up does not appear, please retry clicking this item)');									
									window.location.href = _globalObj._baseURL + "/payroll/export" +  encodeURI("?" + "file=" + data + "&start=" + date_start + "&end=" + date_end + "&output=excel" );
								}, 2000);


								// setTimeout(function() {
								// 	$('.export-excel').find('.export-loader').html('Done...');
								// }, 2000);
								e.preventDefault();
							});


							$('.detailed_view').on('click', function(e) {
								var data =  $('.payroll').val();
								var date_start = $('#start_date').val();
								var date_end = $('#end_date').val();
								
								var _this = $(this);
								var link = _globalObj._baseURL + "/payroll/detailed_view" +  encodeURI("?" + "file=" + data + "&start=" + date_start + "&end=" + date_end );

								// window.location.href = _globalObj._baseURL + "/payroll/detailed_view" +  encodeURI("?" + "file=" + data + "&start=" + date_start + "&end=" + date_end );
								window.open(link, "_blank");

								e.preventDefault();
							});




			        });


			    </script>
@stop