
<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Medical Examination Information</h4></h3>
		  </div>
		  <div class="panel-body">
		
	
		<div class="form-group">
							
					{{ Form::label('medical_establishment', 'Medical Establishment', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						{{ Form::select('medical_establishment', $medical_establishments ,Input::old('medical_establishment'), array('class' => 'form-control', 'required') ) }}
					</div>
					<div class="col-sm-1" ><a href=" {{ action('MedicalEstablishmentsController@create') }}?ref={{ base64_encode(URL::current() . '?add_type=bulk' ) }}" class="btn btn-info"> <span class="glyphicon glyphicon-share"></span> Add </a></div>
					<div class="col-sm-1" style="padding-top: 5px;">Add rows</div>
					<div class="col-sm-1" style="margin-right: 10px; ">{{ Form::text('rowcount', NULL, ['class' => 'rowCount form-control', 'style' => 'width: 100px']) }}</div>
					<div class="col-sm-1">   <a class="addRow btn btn-primary">Go</a> </div> 
				</div>


		<div class="form-group">
							
					{{ Form::label('date_conducted', 'Date Conducted', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						<div class='input-group date ' id='birthdate' data-date-format="YYYY-MM-DD">
							{{ Form::text('date_conducted', Input::old('date_conducted'), array('class' => 'form-control date', 'required', 'data-date-format' => 'YYYY-MM-DD', 'required', 'id' => 'date_conducted') ) }}
				 	
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                

					</div>

				</div>
			</div>
	

<hr>
  <table id="medical_examination_information_table" class="table table-hover">
	<thead>
		<th width="15%">ID Number 	</th>
		<th>Medical Findings</th>
		<th>Recommendation</th>
		<th>Remarks</th>
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
		 	
		 	<a href="#" class="btn btn-primary" id="processTableData">Submit</a>
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
var redirect = false;
</script>
<script type="text/javascript" src="{{ asset('jquery/hr_disciplinary_actions.js') }}"></script>

<script>

	(function() {

		$('#processTableData').on('click', function(e) {

			if (!confirm('Are you sure you want to save this data into the database?')) {
			 	return false;
			}

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
					'url': _globalObj._baseURL + '/employees/medical_examinations',
					'data' : { examination_data: JSON.stringify(tableData), 
						       medical_establishment: $('#medical_establishment').val(), 
						       date_conducted: $('#date_conducted').val(),
						       _token: _globalObj._token },
					success: function(data) {
							output = data;
							
							if (output != undefined) {

								$('input').prop('disabled', true);
								$('select').prop('disabled', true);


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
 									 $('form').prop('disabled', true);		
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
 			var diseases_raw = [];
            var diseases = [];
            var recommendations_raw = [];
            var recommendations = [];


            //  Not yet working
 			$.ajax({
						async: false,
						type: 'GET',
						url: _globalObj._baseURL + '/syncdata' + '?get=medical_findings',
						success: function(data) {
							diseases_raw = data;
							
						}
					});

 			$.ajax({
						async: false,
						type: 'GET',
						url: _globalObj._baseURL + '/syncdata' + '?get=recommendations',
						success: function(data) {
							recommendations_raw = data;
							
						}
					});

 			for (key in diseases_raw) {
			    if (arrayHasOwnIndex(diseases_raw, key)) {
			        diseases[key] = diseases_raw[key];
			    }
			}

			for (key in recommendations_raw) {
			    if (arrayHasOwnIndex(recommendations_raw, key)) {
			        recommendations[key] = recommendations_raw[key];
			    }
			}

			diseases.push('None');

            var elementName = ['employee_work_id', 'medical_findings', 'recommendation', 'remarks'];

            for (var j=0; j<= rowsToAdd-1; j++) {
	            
	            for (var i = 0; i <= elementName.length-1; ++i) {
		            	
		            	var cell = row.insertCell(i);

		            	if (elementName[i] == 'medical_findings') {
			            		var element = document.createElement('select');
			            
		            		for (var o = 0; o <= diseases.length - 1; o++)     {                
				                
		            			if (diseases[o] != undefined) {

			            			opt = document.createElement("option");
					                opt.value = o;

		            				if (diseases[o] == 'None') {
		            					opt.value = 'None';	
		            				}

					                opt.text=diseases[o];
					                element.appendChild(opt);	

		            				if (diseases[o] == 'None') {
		            					opt.selected = true;	
		            				}
		            			}
				                
				            }


		            	} else if (elementName[i] == 'recommendation') {

		            		var element = document.createElement('select');

		            		for (var o = 0; o <= recommendations.length - 1; o++)     {                
				               
		            			if (recommendations[o] != undefined) {
		            				opt = document.createElement("option");
					                opt.value = recommendations[o];
					                opt.text=recommendations[o];
					                element.appendChild(opt);	
		            			}
				                
				            }
		            	} else {
		            		var element = document.createElement('input');
		            		element.type = "text";

		            		if (elementName[i] == 'employee_work_id'){
		            			element.className = element.className + 'searcheable';
		            		}
			            	
		            	}
		            	element.name = elementName[i];
		            	element.dataset.name= elementName[i];
			            element.classList.add('form-control');
			            cell.appendChild(element);
		            	
			           
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
		


		
		// $(document).on('click', '.resultItem a', function(e) {
			
		// 	var id = $(this).parent().data('employee_id'),
		// 		name = $(this).parent().data('employee_name'),
		// 	    input = $(this).parent().parent().siblings('input.searcheable');
		// 	$('.resultName').remove();            
            
		// 	input.val(id);
  //           input.next().remove();
  //           input.after('<span class="input-group-addon"><span class="label label-info">' + name +'</span></span>');

		// 	$('.resultContainer').remove();
		// 	e.preventDefault();
		// });

		// $(document).on('blur', '.searcheable', function() {
		// 	$('.resultContainer').remove();
		// });
		
	})()
</script>
@stop
