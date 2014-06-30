@extends('layout.master')

@section('content')

	<div class="page-header">
<h1>Process Payroll</h1>
</div>

	
<div class="container">


	<!-- Select Pay Period -->
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Payroll Period</h3>
	  </div>
	  <div class="panel-body">
	    
	    	<div class="container">
			       
			       <div class='col-md-5' style="margin-left: 50px;">
			            <div class="form-group">
			                <div class='input-group date' id='datetimepicker8' data-date-format="YYYY-MM-DD">
			                    <input type='text' id="start_date" class="form-control text-center" placeholder="Start of Payroll"/>
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
			        </div>
			        
			        <div class='col-md-5'>
			            <div class="form-group">
			                <div class='input-group date' id='datetimepicker9' data-date-format="YYYY-MM-DD">
			                    <input type='text' id="end_date" class="form-control text-center" placeholder="End of Payroll" />
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
			            </div>
			        </div>
			    	
			    	<div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center">
			                <a href="#select_company" class="btn btn-default">Next  <span class="glyphicon glyphicon-chevron-right	"></span></a>
			            </div>
			        </div>    
			    
			</div>
	    
	  </div>
	</div>


	<!-- Select Company -->
	<div class="panel panel-default" id="select_company">
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
			    	
			    	<div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center">
			                <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a>
			                <a href="#employees_to_include" class="btn btn-default">Next  <span class="glyphicon glyphicon-chevron-right	"></span></a>
			            </div>
			        </div>    
			    
			</div>

	  </div>
	</div>

	<!-- Employees Included -->
	<div class="panel panel-default" id="employees_to_include">
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
			    	
			    	<div class='col-md-10' style="margin-left: 75px;">
			            <div class="form-group text-center">
			                <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a>
			                <a href="#review_employees" class="btn btn-default" id="employees_include">Next  <span class="glyphicon glyphicon-chevron-right	"></span></a>
			            </div>
			        </div>

			    </div>
			    
			</div>
	    
	  </div>
	</div>

	<!-- Review Employees -->
	<div class="panel panel-default" id="review_employees">
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
			            <table class="table table-bordered">
			            	<thead>
			            		<th>Name <span class="badge"> <span class="employees_counter">0</span></span></th>
			            		<th>Days worked</th>
			            	</thead>

			            	<tbody id="employees_list">

			            	</tbody>	

			            </table>
			        </div>    
	
			    	
			    	<div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center">
			                <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a>
			                <a href="#process" id="process_payroll" class="btn btn-primary">Begin Process  </span></a>
			            </div>
			        </div>    
			    
			</div>

	  </div>
	</div>


	<!-- Processed Payroll Data -->
	<div class="panel panel-default" id="process">
	  <div class="panel-heading">
	    <h3 class="panel-title">Condensed View [Payroll]</h3>
	  </div>
	  <div class="panel-body">
	    
	    	<div class="container">
			     
			     <div class="col-md-11 text-center"> 
			      	<div class="page-header-def">
					  <h2><small>For Pay Period <span class="pay_period"></span></small></h2>
					</div>
			      </div> 

			        <div class='col-md-10' style="margin-left: 50px; margin-top: 25px;">
			            <table class="table table-bordered">
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
			        </div>    
	
			    	
			    	<div class='col-md-10' style="margin-left: 50px;">
			            <div class="form-group text-center">
			                <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span>  Prev  </a>
			                <a href="#" class="btn btn-primary">Begin Process  </span></a>
			            </div>
			        </div>    
			    
			</div>

	  </div>
	</div>


				<!-- Progress -->
	    	<div class="progress">
			  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%">
			    <span class="sr-only">1% Complete</span>
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
											$.each(employees, function(key, value) {

												if (__in_array(employees[key].employee_id, seen)) {
													if ($('.' + 'dp_' + employees[key].department_id + '_'+ employees[key].work_assignment_id).length <=1) {													

														_html = '<tr class="dp_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">';
														_html +='<td>' + employees[key].department_name +'</td>';
														_html +='<td>' + employees[key].position_name +'</td>';
														_html +='<td><span class="days_worked_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">' + 0 +'</span></td>';
														_html += '</tr>';


														$('.parent_' + employees[key].employee_id).find('tbody').append(_html);
													}

													days_worked = parseInt($('.parent_days_worked_' + employees[key].employee_id).html());
													$('.parent_days_worked_' + employees[key].employee_id).html(days_worked+1);
													
													days_worked_dp = $('.parent_' + employees[key].employee_id).find('.days_worked_' + employees[key].department_id + '_' + employees[key].work_assignment_id);
													days_worked_dp.html( parseInt(days_worked_dp.html())+1 );

													return true;
												}
												else {
													seen.push(employees[key].employee_id);

													_html = '<tr>';
													_html += '<td data-employee_id="' + employees[key].employee_id +'"> <span class="expand_dtr glyphicon glyphicon-plus-sign"></span>  ' + employees[key].lastname + ', ' + employees[key].firstname + ' ' +'</td>';
													_html +='<td>' + '<span class="parent_days_worked_'+ employees[key].employee_id +'">' + 1 + '</span>' +'</td>';
													_html += '</tr>';

													_html += '<tr class="parent_' + employees[key].employee_id +'"  style="display:none;">';
													_html += '<td colspan="4">' + '<div class="well">' + 
																		'<table class="table table-hover">' +
													                		'<thead>' +
													                			'<th>Department</th>' +
													                			'<th>Position </th>' +
													                			'<th>Days worked </th>' +
													                		'</thead>' +
													                		'<tbody>' + 
													                		'</tbody>' +
													                	'</table>' +'</div>' +'</td>';
													_html += '</tr>';
													
													$('#employees_list').append(_html);

													_html = '<tr class="dp_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">';
													_html +='<td>' + employees[key].department_name +'</td>';
													_html +='<td>' + employees[key].position_name +'</td>';

													_html +='<td><span class="days_worked_' + employees[key].department_id + '_'+ employees[key].work_assignment_id + '">' + 1 +'</span></td>';
													_html += '</tr>';

													$('.parent_' + employees[key].employee_id).find('tbody').append(_html);
													
												}
											    
											});

											console.log('displaying all dtr');
											console.log(seen);
										} else if (selection_type == 'department') {
											$('.filter_type').html('Selecting employees by department with DTR based on date range');
											console.log('displaying by department');
										}
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

						$('#process_payroll').on('click', function(e) {

							// Make an AJAX call
							$.ajax({
								type: 'GET',
								url: _globalObj._baseURL + '/payroll',
								data: { start_date: $('#start_date').val(),
							            end_date: $('#end_date').val(),
							            company_id: $('#company_id').val() },
							    success: function(data) {
							    	var row = "";
							    	
							    	$('#payroll_list').html('');

							    	$.each(data, function(employee_id, employee) {
							    		row = '<tr>';
							    		row += 	'<td>' + employee.employee_id + '</td>';
							    		row += 	'<td>' + employee.name + '</td>';
							    		row += 	'<td>' + employee.days_worked + '</td>';
							    		row += 	'<td>' + employee.grosspay + '</td>';							    		
							    		row += 	'<td>' + employee.deductions + '</td>';
							    		row += 	'<td>' + employee.netpay + '</td>';
							    		 
							    		$('#payroll_list').append(row);
							    	});
							    }
							});


							$(this).prop('disabled', false);
							e.preventDefault();

						});
			        });


			    </script>
@stop