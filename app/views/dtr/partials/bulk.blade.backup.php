
<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Medical Examination Information</h4></h3>
		  </div>
		  <div class="panel-body">
		
	
		<div class="form-group ">
							
					{{ Form::label('breaktime', 'Break time', array('class' => 'col-sm-2')) }}
					<?php  $breaktime=  (Input::old('breaktime') != '' ) ? Input::old('breaktime') : '11:00'; ?>
					<div class="col-sm-2">
						{{ Form::select('breaktime' , $time , $breaktime , array('class' => 'form-control') ) }}
					</div>
				
					<div class="col-sm-1" style="padding-top: 5px;">Add rows</div>
					<div class="col-sm-1" style="margin-right: 10px; ">{{ Form::text('rowcount', NULL, ['class' => 'rowCount form-control', 'style' => 'width: 100px']) }}</div>
					<div class="col-sm-1">   <a class="addRow btn btn-primary">Go</a> </div> 
				</div>


		<div class="form-group ">
							
					{{ Form::label('work_date', 'Date', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						<div class='input-group date ' id='birthdate' data-date-format="YYYY-MM-DD">
							{{ Form::text('date_conducted', Input::old('date_conducted'), array('class' => 'form-control date', 'required', 'data-date-format' => 'YYYY-MM-DD', 'required', 'id' => 'date_conducted') ) }}
				 	
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                

					</div>

				</div>
			</div>
	

<hr>
		  <table id="medical_examination_information_table" class="table">
			<thead>
				<th width="35%">ID Number 	</th>
				<th width="15%" class="text-center"><strong>Time IN  </strong><span class="label label-info">AM</span></th>
				<th width="15%" class="text-center"><strong>Time OUT  </strong><span class="label label-info">AM</span></th>
				<th width="15%" class="text-center"><strong>Time IN  </strong><span class="label label-warning">PM</span></th>
				<th width="15%" class="text-center"><strong>Time OUT  </strong><span class="label label-warning">PM</span></th>
				<th class="text-center">Total Hours</th>
				<th class="text-center"> Remarks</th>
				<th></th>
			</thead>
			<tbody id="medical_examination_information_table_body">
				
			</tbody>
		</table>
	

<div class="panel panel-default hide" id="examination_creation_result">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Data submission status</h4></h3>
		  </div>
		  <div class="panel-body">
		  		<table class="table table-striped">
		  			<thead>
		  				<th>Jobs done</th>
		  			<th>Success jobs</th>
		  			<th>Failed jobs</th>
		  			<th>Duplications</th>
		  			<th>Not included</th>
		  			</thead>

		  			<tbody>
		  				<td class="jobs_done"></td>
		  				<td class="success_jobs"></td>
		  				<td class="failed_jobs"></td>
		  				<td class="duplications"></td>
		  				<td class="not_included"></td>
		  			</tbody>
		  		</table>


		  </div>
</div>



<div class="panel panel-default hide" id="examination_creation_result_data">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Encoded data</h4></h3>
		  </div>
		  <div class="panel-body">
		  		<table class="table table-striped">
		  			<thead>
		  			<th>Employee ID</th>
		  			<th>Medical Establishment</th>
		  			<th>Medical Findings</th>
		  			<th>Recommendation</th>
		  			<th>Remarks</th>
		  			</thead>

		  			<tbody >
		  				
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
	
var __panelsToToggle  = [];
var __rowsToDisplay  = 10;
var resultContainer = $('.resultContainer');

</script>
<script type="text/javascript" src="{{ asset('jquery/hr_disciplinary_actions.js') }}"></script>

<script>

	(function() {

		$('#processTableData').on('click', function(e) {

			e.preventDefault();
			var date_conducted = $('#date_conducted');

			if ( date_conducted.val() == '' ) {
				date_conducted.closest('div[class^="form-group"]').addClass('has-error').focus();		
				return false;
			} else {
				date_conducted.closest('div[class^="form-group"]').removeClass('has-error');
			}

			var table = document.getElementById("medical_examination_information_table_body");
			var cellData = {};
			var tableData = {};	
			var field = value = "";	


			// Loop through each table rows
			for(var i =0; i < table.rows.length -1; i++) {

				cellData = {};
				// Loop through each table cells
				for (var j=0; j < table.rows[i].cells.length; j++) {

					// Get the attribute
					field = table.rows[i].cells[j].children[0].dataset.name;
					
					// Get value
					value = table.rows[i].cells[j].children[0].value;


					// Assign into an array for later use
					cellData[field] = value;

				}

				// Check if employee ID is assigned
				if (cellData['employee_work_id'] != undefined) {

					// Check if employee id has value
					if (cellData['employee_work_id'] != "") tableData[i] = cellData;	
				}
				
				

				
				// console.log(tableData);
		}


			// Send the processed data into our database
			$.ajax({
					'type': 'POST',
					'url': _globalObj._baseURL + '/payroll/dtr',
					'data' : { examination_data: JSON.stringify(tableData), 
						       medical_establishment: $('#medical_establishment').val(), 
						       date_conducted: $('#date_conducted').val(),
						       _token: _globalObj._token },
					success: function(data) {
							output = JSON.parse(data);
							
							if (output != undefined) {

								// Only display charts when there's a job done
								if (output.all_jobs.length == 0) return false;
								$('#buttons').hide();

 								var success_jobs = output.success_jobs;
 								var failed_jobs = output.failed_jobs;
 								var duplications = output.duplications
 								var not_included = output.not_included;

								$('#medical_examination_information_table').hide();
								var resultTable = $('#examination_creation_result');
								var encodedDataTable = $('#examination_creation_result_data');
								var resultTableData = $('#examination_creation_result_data tbody');
								var skipped_items = ['created_at','updated_at'];

								encodedDataTable.removeClass('hide');
								resultTable.removeClass('hide');
								$('.jobs_done').html(output.all_jobs.length);
								$('.success_jobs').html(output.success_jobs.length);
								$('.failed_jobs').html(output.failed_jobs.length);
								$('.duplications').html(output.duplications.length);
								$('.not_included').html(output.not_included.length);

								var td_class = "",
								    row = "";

								 var index = -1;

								// Display processed data
								$.each(output.data, function(i, value) {		
 							            
 							           var row = row + '<tr>';

 									   $.each(value, function(k, v) {
 									   		if (k == 'created_at' || k == 'updated_at') return false;
 									   		 td_class = '';

 									   		 if (k == 'employee_id') {
 									   		 	// console.log(success_jobs.__indexOf(v));
 									   		 	console.log(output);
 									   		 	console.log(__in_array(v, output.success_jobs));
 									   		 	if (__in_array(v, output.success_jobs)) {
 									   		 		td_class = 'class="success"';
 									   		 		 index = output.success_jobs.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.success_jobs[index];
 									   		 		 }

 									   		 	} else if (__in_array(v, output.failed_jobs)) {
 									   		 		td_class = 'class="danger"';

 									   		 		index = output.failed_jobs.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.failed_jobs[index];
 									   		 		 }

 									   		 	} else if (__in_array(v, output.duplications)) {
 									   		 		td_class = 'class="warning"';

 									   		 		index = output.duplications.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.duplications[index];
 									   		 		 }

 									   		 	} else if (__in_array(v, output.not_included)) {
 									   		 		td_class = 'class="info"';

 									   		 		index = output.not_included.indexOf(v);

 									   		 		 if (index > -1) {
 									   		 		 	delete output.not_included[index];
 									   		 		 }
 									   		 	}
 									   		 }

											row = row + '<td ' + td_class +'data-key="' + k +'">' + v + '</td>'; 									   		
 									   });          					

 									  row = row + '</tr>';	

 									 resultTableData.append(row);			
								});

							}

					}
				});

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

		function addRow(tableID, rowsToAdd) {

			// Work on JSON Objects
		  
		  var table = document.getElementById(tableID);
 		
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);


            var elementName = ['employee_work_id', 'time_in_am', 'time_out_am','time_in_pm', 'time_out_pm', 'total', 'remarks'];

            for (var j=0; j<= rowsToAdd-1; j++) {
	            
	            for (var i = 0; i <= elementName.length-1; ++i) {
		            				
		            	var cell = row.insertCell(i);
		            			 row.dataset.id= j;
		            		
		            		var element = document.createElement('input');
		          	  		element.type = "text";

		            		if (elementName[i] == 'employee_work_id'){
		            			element.className = element.className + 'searcheable';
		            		}
			            	
		            	
		            	element.name = elementName[i];
		            	element.dataset.name= elementName[i];

			            	element.classList.add('form-control');

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
			addRow('medical_examination_information_table_body', rows);
	
		});

		addRow('medical_examination_information_table_body',5);
		

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
			$('.resultName').remove();            
            
			input.val(id);
            input.next().remove();
            input.after('<span class="input-group-addon"><span class="label label-info">' + name +'</span></span>');


			// input.after('<span class="resultName">' + name +'</span>');
			$('.resultContainer').remove();
			console.log($(this).parents('*'));
			e.preventDefault();
		});

		// $(document).on('blur', '.searcheable', function() {
		// 	$('.resultContainer').remove();
		// });

		$('#time_in_am, #time_out_am, #time_in_pm, #time_out_pm').datetimepicker({
			pickTime:true,
			pickDate: false,
			use24hours: true
		});

		$(document).on('blur', 'input[name="time_in_pm"], input[name="time_out_pm"],input[name="time_in_am"], input[name="time_out_am"] ', function(e) {
			if ($(this).val() == "") $(this).val('00:00');
		});


		$(document).on('blur', 'input[name="time_out_pm"]', function(e) {

				// console.log($(this).parent().parent().parent().data('id'));
				var time_in_am = '00:00',
				    time_out_am = '00:00',
				    time_in_pm = '00:00',
				    time_out_pm = '00:00';
				 var parent = $(this).parent().parent().parent();   
				
				// Get AM Time IN and out
				time_in_am = __parseTime(parent.find('input[name="time_in_am"]').val());
				time_out_am = __parseTime(parent.find('input[name="time_out_am"]').val());

				// GET AM Time OUT
				time_in_pm = __parseTime(parent.find('input[name="time_in_pm"]').val());
				time_out_pm = __parseTime(parent.find('input[name="time_out_pm"]').val());


				var am_in = new Date(2000, 0, 1, time_in_am.hh , time_in_am.mm); // 9:00 AM,
				var am_out = new Date(2000, 0, 1, time_out_am.hh , time_out_am.mm);


				var pm_in = new Date(2000, 0, 1, time_in_pm.hh , time_in_pm.mm); // 9:00 AM,
				var pm_out = new Date(2000, 0, 1, time_out_pm.hh , time_out_pm.mm);




				var am_time = __getHour(am_out - am_in);
				var pm_time = __getHour(pm_out - pm_in);

				var total = pm_time + am_time;

				parent.find('input[name="total"]').val(total);		
			
			
		});
		
		
	})()
</script>
@stop
