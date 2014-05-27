<div class="panel panel-default ">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          Medical Examination Profile
        </a></h4></h3>
		  </div>

		  <?php 
		  		$employee_id = $employee->id;
		  		$medical_exams = $medicals->getExaminationDataWithJoins($employee_id);

			  ?>
		  
			  <div class="panel panel-default smooth-panel-edges">
			  <div class="panel-body">
			    
			    <table class="table table-striped">
				  	<thead>
				  		<th>Date</th>
				  		<th>Medical Establishment</th>
				  		<th>Medical Findings</th>
				  		<th>Recommendation</th>
				  		<th>Remarks</th>
				  	</thead>

				  	<tbody>
				  		@foreach($medical_exams as $exams)

				  			<tr data-employee_id="{{ $employee_id }}" data-medical_id="{{ $exams->id }}">
				  				<td data-conversion_type="text" data-conversion_name="date_conducted">{{$exams->date_conducted }}</td>
				  				<td data-conversion_type="select" data-conversion_param="?get=medical_establishments" data-conversion_name="medical_establishment_id" >{{ $exams->establishment }}</td>
				  				<td data-conversion_type="select" data-conversion_param="?get=medical_findings" data-conversion_name="medical_findings_id">{{ ($exams->medical_findings == NULL)  ? '<span class="label label-default">None</span>' : $exams->medical_findings}}</td>
				  				<td data-conversion_type="select" data-conversion_param="?get=recommendations" data-conversion_name="recommendations">{{ $exams->recommendations }}</td>
				  				<td data-conversion_type="text" data-conversion_name="remarks"> {{ ($exams->remarks != "") ? $exams->remarks : "N/A" }} </td>
				  				<td data-conversion_type="submit"><a href="#" class="edit_medical"><span class="glyphicon glyphicon-pencil"></span></a> </td>
				  			</tr>
				  		@endforeach
				 
				  		
				  	</tbody>

				  </table>
			  </div>
			</div>
		  

		  @if (count($medical_exams) == 0)
		  
		  	<div class="alert alert-warning text-center smooth-panel-edges">No medical examination records found.</div>
		  
		  @endif

		  <div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		    <a href="{{ action('EmployeesMedicalExaminationsController@create') }}?employee_id={{ $employee_id }}&work_id={{$employee->employee_work_id}}" class="btn btn-primary pull-left">Add record</a>
		    <a href="{{ action('EmployeesMedicalExaminationsController@index') }}" class="btn btn-default pull-right">Go to Medical Examinations</a>
		  </div>
		</div>
				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->


@section('sub_scripts')
<script>
	(function(){
		$('.edit_medical').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();



			var data_element = "";
			$.each($(this).parents('tr').find('td'), function(key,value) {
				
				data_param = $(this).data('conversion_param');
				data_element = $(this).data('conversion_type');
				element_name = $(this).data('conversion_name');

				element_value = $(this).html().trim();

				
				html = "";


				if (data_element == 'submit') {
					html = '<a href="#" class="btn btn-primary submit_medical"> <span class="glyphicon glyphicon-floppy-save"></span></a>'	;
				}

				if (data_element == 'text') {
					text_value = ($(this).html().trim() != 'N/A') ? $(this).html().trim() : "";
					html = '<input type="text" name="' + element_name +'" value="' + text_value +'" class="form-control">';
				} else if (data_element == 'select') {
					html = '<select name="' +element_name +'" class="form-control">';

					$.ajax({
						async: false,
						type: 'GET',
						url: _globalObj._baseURL + '/syncdata' + data_param,
						success: function(data) {

							console.log(data);
							if (data != undefined) {

								if (element_name == 'medical_findings_id') {
									data['none'] = 'None';
								}

								$.each(data, function(key,value) {

									if (element_name == 'recommendations') {
										if (element_value == value) {
											html+= '<option value="' + value +'" selected>' + value +'</option>';	
										} else {
											html+= '<option value="' + value +'">' + value +'</option>';
										}
										
									} else {

										if (element_value == value ) {
											html+= '<option value="' + key +'" selected>' + value +'</option>';	
										} else {
											html+= '<option value="' + key +'">' + value +'</option>';
										}
											
									}
													
								});	


								console.log(element_name)
							}

							
							
						}
					});
					html += '</select>';
				}


				$(this).html(html);
								


			})
		});

		$(document).on('click', '.submit_medical' ,function() {
		
			var tr = $(this).parents('tr');
		
			var tableData = {};	

			tableData['id'] = tr.data('medical_id');
		
			$.each(tr.find('td'), function(key,value) {
				
				element_name = $(this).data('conversion_name');

				if (element_name != undefined) {
					tableData[element_name] = $(this).children().val();
				}
				
			});

			$.ajax({
				type: 'PUT',
				data: { table_data: tableData, 
				            _token: _globalObj._token,
				            _refer: 'employee_profile' },
				url: _globalObj._baseURL + '/employees/medical_examinations',
				success: function(data) {
					if (data.status == 'success') {
						location.reload();
					}	
				}
			});


		});

	})()
</script>
@stop