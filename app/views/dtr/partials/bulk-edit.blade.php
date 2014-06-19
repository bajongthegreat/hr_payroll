
<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>DAILY TIME RECORD INFORMATION</h4></h3>
		  </div>
		  <div class="panel-body">
		
	
		<div class="form-group ">
							
					{{ Form::label('shift', 'Shift', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-2" style="display:none;">
						<?php 
							$shift = (Input::has('shift')) ? Input::get('shift') : Input::old('shift');
						?>
							{{ Form::select('shift',['ds' => 'Day shift', 'ns' => 'Night shift'] , $shift , array('class' => 'form-control', 'required', 'id' => 'shift') ) }}
					</div>

					<div class="col-sm-2" style="padding-top: 5px;">
							<p class="shift_label">{{ ($shift == 'ds') ? '<span class="label label-warning">Day shift</span>' : '<span class="label label-info">Night shift</span>'; }}</p>
						</div>
				

				</div>	

		<hr>

			<div class="form-group">
				<div class="col-xs-2 text-right" style="padding-top: 5px;">
						{{Form::label('department', 'Department', 'text-right')}}
					</div>


					<div class="col-sm-4">
			
							{{ Form::select('department',$departments , Input::old('department_id') , array('class' => 'form-control', 'required', 'id' => 'department_id') ) }}
					</div>
		</div>


		<div class="form-group">
				<div class="col-xs-2 text-right" style="padding-top: 5px;" >
						{{Form::label('work_assignment_id', 'Work Assignment', ['class' => 'text-right'])}}
					</div>


					<div class="col-sm-4">
			
							{{ Form::select('work_assignment_id', [] , Input::old('work_assignment_id'), array('class' => 'form-control', 'required', 'id' => 'position_id') ) }}
					</div>
		</div>

			<div class="form-group ">
							
					{{ Form::label('work_date', 'Date', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-2">
						<div class='input-group date' id='birthdate' data-date-format="YYYY-MM-DD">
							{{ Form::text('work_date', $dtr->work_date, array('class' => 'form-control date', 'required', 'data-date-format' => 'YYYY-MM-DD', 'id' => 'work_date') ) }}
				 	
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                

					</div>

				</div>
			</div>

		<a data-toggle="collapse" data-parent="#accordion" href="#defaults">
		<hr style="height: 10px;"> </a>

		<div id="defaults" class="panel-collapse collapse">


			<div class="form-group ">
						<div class="col-sm-2 text-right" style="padding-top: 5px;">
							<span class="label label-info" > Break Time</span>
						</div>
						<?php  $breaktime=  (Input::old('breaktime') != '' ) ? Input::old('breaktime') : '11:00'; ?>
						<div class="col-sm-2">
							{{ Form::select('breaktime' , $time , $breaktime , array('class' => 'form-control') ) }}
						</div>
					
					</div>


				<div class="form-group ">
								
						<div class="col-sm-2 text-right" style="padding-top: 5px;">
							<span class="label label-info"> <span class="_am">Time out AM</span> </span>
						</div>

						<div class="col-sm-2">
							{{ Form::select('def_timeout_am' , $time , $breaktime , array('class' => 'form-control', 'id'=> 'def_timeout_am') ) }}
						</div>

						<div class="col-xs-2 text-right" style="padding-top: 5px;">
							<span class="label label-warning"  ><span class="_pm"> Time in PM</span></span>
						</div>

						<div class="col-xs-2">
							<?php  
								if (Input::has('shift') ) {
									$def_timein_pm = (Input::get('shift') == 'ns') ? '17:00' : '12:00';
								} else $def_timein_pm = '12:00';

								// $def_timein_pm=  (Input::old('def_timein_pm') != '' ) ? Input::old('breaktime') : '12:00';

							 ?>
							{{ Form::select('def_timein_pm' , $time , $def_timein_pm , array('class' => 'form-control', 'id' => 'def_timein_pm') ) }}
						</div>
				</div>
			
				<hr>
			</div>
			
				<div class="form-group ">
							
					{{ Form::label('show_full_dtr', 'Show full DTR', array('class' => 'col-xs-2 text-right')) }}

					<div class="col-xs-2">
							{{ Form::checkbox('show_full_dtr', Input::old('work_date') ) }}
					</div>

					<!-- Add more rows -->
								<div class="col-sm-2 text-right" style="padding-top: 5px;">Add rows</div>
					<div class="col-sm-1" style="margin-right: 10px; ">{{ Form::text('rowcount', NULL, ['class' => 'rowCount form-control', 'style' => 'width: 100px']) }}</div>
					<div class="col-sm-1">   <a class="addRow btn btn-primary">Go</a> </div> 
	
				</div>

				<hr>

		  <table id="medical_examination_information_table" class="table panel-smooth-edges">
			<thead>
				<th width="35%">ID Number 	</th>
				<th id="header_timein_am" width="15%" class="text-center"><strong>Time IN  </strong><span style="display:none;" class="timelabel label label-info"><span class="_amth">AM</span> </span></th>
				<th id="header_timeout_am" width="15%" class="text-center" style="display:none;"><strong>Time OUT  </strong><span style="display:none;" class="timelabel label label-info"><span class="_amth">AM</span> </span></th>
				<th id="header_timein_pm" width="15%" class="text-center" style="display:none;"><strong>Time IN  </strong><span style="display:none;" class="timelabel label label-warning"><span class="_pmth">PM</span></span></th>
				<th id="header_timeout_pm" width="15%" class="text-center"><strong>Time OUT  </strong><span class="timelabel label label-warning" style="display:none;"><span class="_pmth">PM</span></span></th>
				<th class="text-center">Total Hours</th>
				<th class="text-center"> Remarks</th>
				<th></th>
			</thead>
			<tbody id="dtr_information_table_body">
				
			</tbody>
		</table>

				
			</div>

		
			</div>
	

	

<div class="panel panel-default hide smooth-panel-edges" id="examination_creation_result">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Data submission status</h4></h3>
		  </div>
		  <div class="panel-body">
		  		<table class="table table-striped">
		  			<thead>
		  				<th>Jobs done</th>
		  			<th>Success jobs</th>
		  			<th>Newly Created</th>
		  			<th>Failed jobs</th>
		  			<th>Duplications</th>
		  			<th>Not included</th>
		  			</thead>

		  			<tbody>
		  				<td class="jobs_done"></td>
		  				<td class="success_jobs"></td>
		  				<th class="created"></th>
		  				<td class="failed_jobs"></td>
		  				<td class="duplications"></td>
		  				<td class="not_included"></td>
		  			</tbody>
		  		</table>


		  </div>
</div>



<div class="panel panel-default hide smooth-panel-edges" id="examination_creation_result_data">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Encoded data</h4></h3>
		  </div>
		  <div class="panel-body">
		  		<table class="table table-striped">
		  			<thead>
		  			<th>Employee ID</th>
		  			<th>Date</th>
		  			<th>Shift</th>
		  			<th>Time IN AM</th>
		  			<th>Time OUT AM</th>
		  			<th>Time IN PM</th>
		  			<th>Time OUT PM</th>
		  			<th>Remarks</th>
		  			</thead>

		  			<tbody>
		  				
		  			</tbody>
		  		</table>


		  </div>
</div>

</div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
</div>

<div class="container" id="buttons">
		<div class="form-group">
		 <div class="form-group pull-left">
		 	

	     	{{ Form::submit('Submit', array('class' => 'btn btn-primary ', 'id'=> 'processTableData')) }}
	      	 {{ Form::reset('Clear', array('class' => 'btn btn-default', 'id' => 'clear')) }} 
	      	 <div id="submitload"></div>
	      </div>
	    
		</div>
		
		{{ Form::close() }}
	</div>

@section('scripts')
<script>
var __oldShift = '{{ $dtr->shift}}'	
var __panelsToToggle  = [];
var __rowsToDisplay  = 10;
var resultContainer = $('.resultContainer');
var __dayShiftHoursAM = [],
    __dayShiftHoursPM = [];

var __dataToUse = {{ $dtr_json }};
var ids_prior_update = {{ json_encode($ids_prior_update) }}

var _dtrModule = new dtrModule();

</script>

<script type="text/javascript" src="{{ asset('jquery/hr_disciplinary_actions.js') }}"></script>

<script>

	(function() {

		var show_full_dtr = $('#show_full_dtr').prop('checked');
      	var oldDepartment = '{{ (isset($dtr->department_id)) ? $dtr->department_id  : 0}}',
    	    oldPosition = '{{ (isset($dtr->position_id)) ? $dtr->position_id  : 0}}',
    	    oldShift = '{{ $dtr->shift }}';

    	    var initializeObj = { oldDepartment: oldDepartment,
    	                          oldPosition: oldPosition,
    	                          oldShift: oldShift,
    	                          show_full_dtr: show_full_dtr };
  


		// Loads DTR defaults
		_dtrModule.initializer(initializeObj);

		// Load event handlers
		_dtrModule.handlers();
	
		// Todo: _dtrModule.getTableData
		// To calculate result
		setTimeout(function() {
			$('input').each(function() {
				if ($(this).val() != '') $(this).trigger('blur');
			});
		},2500);

		$('#processTableData').on('click', function(e) {

			e.preventDefault();

			if (!confirm('Are you sure you want to save this changes into the database?')) {
			 	return false;
			}

			var date_conducted = $('#work_date');

			// Check if date is filled
			if ( date_conducted.val() == '' ) {
				date_conducted.closest('div[class^="form-group"]').addClass('has-error').focus();		
				return false;
			} else {
				date_conducted.closest('div[class^="form-group"]').removeClass('has-error');
			}

	 		// Get table element
			var table = document.getElementById("dtr_information_table_body");
		
			// Get table's basic data
			tableData = _dtrModule.getTableData(table);

			var ajaxData =  {  dtr_data: JSON.stringify(tableData), 
						       shift: $('#shift').val(), 
						       date: $('#work_date').val(),
						       work_assignment_id: $('#position_id').val(),
						       _token: _globalObj._token,
						       ids_prior_update: ids_prior_update };


			// Send the processed data into our database
			$.ajax({
					'type': 'PUT',
					'url': _globalObj._baseURL + '/payroll/dtr/15',
					'data' : ajaxData ,
					success: function(data) {
							output = JSON.parse(data);
							
							if (output != undefined) {

								// Only display charts when there's a job done
								if (output.all_jobs.length == 0) return false;
								

 								var success_jobs = output.success_jobs;
 								var failed_jobs = output.failed_jobs;
 								var duplications = output.duplications
 								var not_included = output.not_included;

 								$('#buttons').hide();
								$('#medical_examination_information_table').hide();
								var resultTable = $('#examination_creation_result');
								var encodedDataTable = $('#examination_creation_result_data');
								var resultTableData = $('#examination_creation_result_data tbody');
								var skipped_items = ['created_at','updated_at', 'work_assignment_id'];

								encodedDataTable.removeClass('hide');
								resultTable.removeClass('hide');

								$('.jobs_done').html(output.all_jobs.length);
								$('.created').html(output.created.length);
								$('.success_jobs').html(output.success_jobs.length);
								$('.failed_jobs').html(output.failed_jobs.length);
								$('.duplications').html(output.duplications.length);
								$('.not_included').html(output.not_included.length);

								var td_class = "",
								    row = "";

								 var index = -1;

								// Display processed data
								$.each(output.data, function(i, value) {		
 							            
 							           var row = row + '<tr __>';

 									   $.each(value, function(k, v) {
 									   		
 									   		// Don't include this in our table
 									   		if (__in_array(k, skipped_items)) return true;
 									   		 
 									   		 td_class = '';


 									   		 if (k == 'employee_id') {
 									 
 									   		 	// == Success JOBS
 									   		 	if (__in_array(v, output.success_jobs)) {
 									   		 		td_class = 'class="success"';
 									   		 		 index = output.success_jobs.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.success_jobs[index];
 									   		 		 }
 									   		 	// == Failed jobs
 									   		 	} else if (__in_array(v, output.failed_jobs)) {
 									   		 		td_class = 'class="danger"';

 									   		 		index = output.failed_jobs.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.failed_jobs[index];
 									   		 		 }

 									   		 	// == Duplicates
 									   		 	} else if (__in_array(v, output.duplications)) {
 									   		 		td_class = 'class="warning"';

 									   		 		index = output.duplications.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.duplications[index];
 									   		 		 }
 									   		 	// == Not included
 									   		 	} else if (__in_array(v, output.not_included)) {
 									   		 		td_class = 'class="info"';

 									   		 		index = output.not_included.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.not_included[index];
 									   		 		 }
 									   		 	}
 									   		 }

 									   		 // replace the raw __ to the appropriate status class
 									   		row =  row.replace('__', td_class);

 									   		// Append <td> to our table row
											row = row + '<td ' + td_class +'data-key="' + k +'">' + v + '</td>'; 									   		
 									   });          					

 									  row = row + '</tr>';	

 									 resultTableData.append(row);

								}); // End of for each

							} // End of xmlhttpResponse check

					} // End of succes method

				}); // End of AJAX
		});
	
		function getJSON(data_param) {
			$.ajax({
						async: false,
						type: 'GET',
						url: _globalObj._baseURL + '/syncdata' + data_param,
						success: function(data) {
							jsonData = data;
						}
					});
		}

		function __toArray(myObj){ 
				var array = $.map(myObj, function(value, index) {
				    return [value];
				});

				return array;
		}

		function arrayHasOwnIndex(array, prop) {
		    return array.hasOwnProperty(prop) && /^0$|^[1-9]\d*$/.test(prop) && prop <= 4294967294; // 2^32 - 2
		}

		function addRow(tableID, rowsToAdd, defaultValues) {

			// Work on JSON Objects
		  
		  var table = document.getElementById(tableID);
 		
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);


            var elementName = ['employee_work_id', 'time_in_am', 'time_out_am','time_in_pm', 'time_out_pm', 'total', 'remarks'];

            for (var j=0; j<= rowsToAdd-1; j++) {
	            
	            for (var i = 0; i <= elementName.length-1; ++i) {
		            				
		            	var cell = row.insertCell(i);
		            		
							var _type = 'input';

							if (elementName[i] == 'total') {
								_type = 'span';
							}

		            		var element = document.createElement(_type);
		          	  		element.type = "text";

		            		if (elementName[i] == 'employee_work_id'){
		            			element.className = element.className + 'searcheable';
		            			
		            			
		            		}
			            	
		            	
		            	element.name = elementName[i];
		            	element.dataset.name= elementName[i];

		            	if (defaultValues != undefined && defaultValues.length > 0) {
		            	// element.value = getJSONdata(defaultValues[j], elementName[i]);
						row.dataset.id = getJSONdata(defaultValues[j], 'id');
		            	} else {
		            		row.dataset.id= j;
		            	}
		            	
		            		if (elementName[i] == 'total') {
		            			element.classList.add('_totalhours');
		            			element.classList.add('label');
		            			element.classList.add('label-info');
		            			cell.classList.add('text-center');

		            			// TODO:

		            		} else {
		            			element.classList.add('form-control');
		            			element.classList.add(elementName[i]);
		            			
		            		}
			            	
			            	if (elementName[i] == 'time_in_am' || elementName[i] == 'time_out_am' || elementName[i] == 'time_in_pm' ||  elementName[i] == 'time_out_pm') {
			            
		            			
			            		// Create div for timepicker
			            		var timepicker_container = document.createElement('div');

			            		timepicker_container.classList.add('input-group');
			            		timepicker_container.classList.add('date');


			            		timepicker_container.setAttribute('id', elementName[i]);
								timepicker_container.setAttribute('data-date-format', 'HH:mm');

								// Create a icon container
                    			var input_group_addon = document.createElement('span'),
                    			   input_group_addon_icon = document.createElement('span');

                    			   // ICON container class
                    			   input_group_addon.classList.add('input-group-addon');

                    			   // ICON classes
                    			   input_group_addon_icon.classList.add('glyphicon');
                    			   input_group_addon_icon.classList.add('glyphicon-time');

                    			   // Append ICON to ICON container
                    			   input_group_addon.appendChild(input_group_addon_icon);

	                    			    // Append the element to the div container
										timepicker_container.appendChild(element);

										// Append the ICON container to div container
										timepicker_container.appendChild(input_group_addon);

									cell.appendChild(timepicker_container);

									if (elementName[i] == 'time_out_am') {

										element.setAttribute('value', document.getElementById('def_timeout_am').value); 
										cell.style.display='none';
									} else if (elementName[i] == 'time_in_pm') {
										element.setAttribute('value', document.getElementById('def_timein_pm').value); 
										cell.style.display='none';
									} 



			            	} else {
			            		cell.appendChild(element);	

			            	}
			            	
		            	
			           
		            };
		            row = table.insertRow(rowCount+1);
		            // console.log(row);

            };

          
           // console.log(currentRowCount);
           $('.rowcount').html("" + rowCount);
		}


		$('.addRow').on('click', function(e) {
			e.preventDefault();

			var rows = $('.rowCount').val();

			// Call addRow() with the ID of a table
			addRow('dtr_information_table_body', rows, []);
	
		});

   function Object_keys(obj) {
            var keys = [], name;
            for (name in obj) {
                if (obj.hasOwnProperty(name)) {
                    keys.push(name);
                }
            }
            return keys;
        }

		if (__dataToUse.length > 0) {
			addRow('dtr_information_table_body',__dataToUse.length, []);
			console.log(__dataToUse[0])
			var oldDataLength = __dataToUse.length;
        	 var table = document.getElementById('dtr_information_table_body');
            var rowCount = table.rows.length;
            var row = table.rows;

            for(var i=0; i< oldDataLength; i++) {

            	// Only fill a table row with <td> element
            	if (row[i].cells.length > 0) {

            		// Loop through each cell
            		for(var j=0; j<row[i].cells.length; j++) {
							
            			// Set ID to row
            			row[i].dataset.id = __dataToUse[i]['id'];

            			// Grab input element
            			element = row[i].cells[j].getElementsByTagName('input');
            			
            			// Check if it is a valid input element
            			if (element[0] != undefined) {
            				elementName = element[0].getAttribute('name');
            				
            				// Set element value from Database
            				element[0].value = __dataToUse[i][elementName];
            			} 




            		}
            	}
            }


		}
		

		$(document).on('keyup', '.searcheable', function(){
			
			if ($(this).val().length > 1) {
				_searchEmployee($(this).val(), $(this));		
			} else {
				$('.resultContainer').remove();	
			}
		});


		$(document).on('click', '.resultItem a', function(e) {
			
			var id = $(this).parent().data('employee_id'),
				name = $(this).parent().data('employee_name'),
			    input = $(this).parent().parent().siblings('input.searcheable');
			
			var shift = $('#shift').val();
			
			$('.resultName').remove();            
            
			input.val(id);
            input.next().remove();
            input.after('<span class="input-group-addon"><span class="label label-info">' + name +'</span></span>');

            	input.parent().next().find('input').focus();
            

			$('.resultContainer').remove();
			e.preventDefault();
		});

		$(document).on('blur', 'input[name="time_out_pm"]', function() {
			var timeout = __parseTime($(this).val());
			// console.log('waa');
			// console.log(timeout);
		});

		$('#time_in_am, #time_out_am, #time_in_pm, #time_out_pm').datetimepicker({
			pickTime:true,
			pickDate: false,
			use24hours: true,
			minuteStepping:15
		});

		$(document).on('blur', 'input[name="time_in_pm"], input[name="time_out_pm"],input[name="time_in_am"], input[name="time_out_am"] ', function(e) {
			if ($(this).val() == "") $(this).val('00:00');
		});


		$(document).on('blur', 'input[name="time_out_pm"], input[name="time_out_am"], input[name="time_in_am"], input[name="time_in_pm"]', function(e) {

				// console.log($(this).parent().parent().parent().data('id'));
				var time_in_am = '00:00',
				    time_out_am = '00:00',
				    time_in_pm = '00:00',
				    time_out_pm = '00:00';

				 var self = $(this);
				 var parent = $(this).parent().parent().parent();   
				 var total = 0;
				 var shift = $('#shift').val();

				 // if (self.val().indexOf(':') == -1 && self.val() >= 24) {
				 // 	self.val('00:00');
				 // }
				
				if (self.attr('name') == 'time_out_am') {

					 // Timeout for Dayshift
					var chk_am_timeout= parent.find('input[name="time_out_am"]').val();		
					var splitted_timeout_am = chk_am_timeout.split(':');

					// Check if the time out is AM or PM
					if (splitted_timeout_am) {

							// Get the default date for time out in AM for dayshift
							var default_timeout_am = $('#def_timeout_am').val();							
							
							// Get the default date for time out in AM for dayshift
							var default_time_in_pm = $('#def_timein_pm').val();				

						if (splitted_timeout_am[0] > 11 && shift == 'ds' && (show_full_dtr == false)) {
							// If it is AM, do this:
							
							// Set the value inputed in this element to the timeout element
							parent.find('input[name="time_in_pm"]').val( default_time_in_pm );
							
							// Set the value inputed in this element to the timeout element
							parent.find('input[name="time_out_pm"]').val( self.val() );

							// Set the default timeout for AM to this element
							self.val(default_timeout_am);

							// Hide PM Timeout and show AM Timeout
							parent.find('input[name="time_out_am"]').parent().parent().hide();
							parent.find('input[name="time_out_pm"]').parent().parent().show();
							parent.find('input[name="time_in_pm"]').parent().parent().hide();
							


						}
					}


				} else if (self.attr('name') == 'time_out_pm'){

					var chk_pm_timeout=  parent.find('input[name="time_out_pm"]').val();
					var splitted_timeout_pm = chk_pm_timeout.split(':');

					console.log ('it is pm')
					// Check if the time out is AM or PM
					if (splitted_timeout_pm) {

						if (splitted_timeout_pm[0] <= 11 && splitted_timeout_pm[0] != 0 && shift == 'ds' && (show_full_dtr == false)) {
							// If it is AM, do this:
							
							// Reset PM values
							parent.find('input[name="time_in_pm"]').val('00:00');
							parent.find('input[name="time_out_pm"]').val('00:00');
							parent.find('input[name="time_out_am"]').val(chk_pm_timeout);

							// Hide PM Timeout and show am_in Timeout
							parent.find('input[name="time_out_pm"]').parent().parent().hide();
							parent.find('input[name="time_in_pm"]').parent().parent().hide();
							parent.find('input[name="time_out_am"]').parent().parent().show();

						}
					}

				} else if (self.attr('name') == 'time_in_am') {
					
					 // Timeout for Dayshift
					var chk_am_timein= parent.find('input[name="time_in_am"]').val();		
					var splitted_timein_am = chk_am_timein.split(':');

					// Add a change indicator
					if (self.val() != "00:00") {
						console.log('it is changed');

						self.data('is_changed', 'true');

						// console.log(self.data('is_changed'));
					}


					// Check if the time out is AM or PM
					if (splitted_timein_am) {
	

						if (splitted_timein_am[0] > 11 && shift == 'ds' && (show_full_dtr == false)) {
						
							// If it is AM, do this:
							
							// Set the value inputed in this element to the timeout element
							parent.find('input[name="time_in_pm"]').val( self.val() );

							// Set the value inputed in this element to the timeout element
							parent.find('input[name="time_out_am"]').val( '00:00' );
							parent.find('input[name="time_out_pm"]').val( '00:00' );
							
							// Set the value inputed in this element to the timeout element
							self.val('00:00');


							// Hide PM Timeout and show AM Timeout
							parent.find('input[name="time_in_am"]').parent().parent().hide();
							parent.find('input[name="time_out_am"]').parent().parent().hide();
							parent.find('input[name="time_in_pm"]').parent().parent().show();
							parent.find('input[name="time_out_pm"]').parent().parent().show();





						}
					}

				}  else if (self.attr('name') == 'time_in_pm') {
					
					 // Timeout for Dayshift
					var chk_pm_timein= parent.find('input[name="time_in_pm"]').val();		
					var splitted_timein_pm = chk_pm_timein.split(':');


					// Check if the time out is AM or PM
					if (splitted_timein_pm) {
			
						console.log('Hello');

						if (splitted_timein_pm[0] < 12 && shift == 'ds' && (show_full_dtr == false)) {
							// If it is AM, do this:
							
							// Set the value inputed in this element to the timeout element
							parent.find('input[name="time_in_am"]').val( self.val() );

							// Set the value inputed in this element to the timeout element
							parent.find('input[name="time_out_am"]').val( '00:00' );
							
							
							// Get the default date for time out in AM for dayshift
							var default_timeout_am = $('#def_timeout_am').val();							
							
							// Get the default date for time out in AM for dayshift
							var default_time_in_pm = $('#def_timein_pm').val();

							
							// Set the value inputed in this element to the timeout element
							self.val('00:00');
							parent.find('input[name="time_in_pm"]').val('00:00');
							parent.find('input[name="time_out_pm"]').val('00:00');	

							// Hide PM Timeout and show AM Timeout
							parent.find('input[name="time_in_pm"]').parent().parent().hide();
							parent.find('input[name="time_in_am"]').parent().parent().show();

							parent.find('input[name="time_out_pm"]').parent().parent().hide();
							parent.find('input[name="time_out_am"]').parent().parent().show();


						} else if (splitted_timein_pm[0] < 12 && shift == 'ns' && (show_full_dtr == false)) {



						}
					}
				}

				var raw_timein_am = parent.find('input[name="time_in_am"]').val();
				var raw_timeout_am = parent.find('input[name="time_out_am"]').val();
				var raw_timein_pm = parent.find('input[name="time_in_pm"]').val();
				var raw_timeout_pm = parent.find('input[name="time_out_pm"]').val();
				
					hrs_obj = calculateTotalHours(raw_timein_am, raw_timeout_am, raw_timein_pm, raw_timeout_pm,shift);

					total = hrs_obj.total;
			
							// total=8;
				if (total > 8) {
					overtime = total - 8;

					total = (total - overtime) + " <span >(" + overtime +" OT)</span>";

					if (shift == 'ns') {
						np = "<span> NP 10-3:" + hrs_obj.np_10_03 +"</span>"
					}
				}
				
				parent.find('._totalhours').html(total);		
			
			
		});

		
		
	})()
</script>
@stop
