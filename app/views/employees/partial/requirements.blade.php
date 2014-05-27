@extends('layout.master')

	

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Requirements Checklist</h4></h3>
		  </div>
		  <div class="panel-body">
		  			<?php 

		$requirementHelper = new Acme\Helpers\RequirementHelper();

		echo $requirementHelper->displayRequirements($selected_stage_processess, $requirements, $employee_requirements);

		?>
			</div>
		 


		</div>

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Requirement Submission</h4></h3>
		  </div>
		  <div class="panel-body" id="requirement_submission">
		  
			<span class="large-loading"><img width="150px" src="{{asset('img/loading-large.gif')}}"></span>


	{{ Form::open(['action' => ['EmployeesRequirementsController@store', $id], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'requirementForm']) }}


	

			<div class="form-group">
						
				{{ Form::label('stage_process_id', 'Required for: ', array('class' => 'col-md-3')) }}

				<div class="col-md-6">
					{{ Form::select('stage_process_id', $stage_processess, Input::old('stage_process_id'), array('class' => 'form-control', 'id' => 'stage_process_id') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('requirement_id', 'Requirement: ', array('class' => 'col-md-3')) }}

				<div class="col-md-6">
					{{ Form::select('requirement_id', [] ,Input::old('requirement_id'), array('class' => 'form-control', 'id' => 'requirement_id') ) }}
				</div>
				
			</div>
			{{ Form::hidden('employee_id', ' ', array('class' => 'col-md-3', 'id' => 'employee_id')) }}
			{{ Form::hidden('employee_work_id', $id , array('class' => 'col-md-3', 'id' => 'employee_id')) }}


			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-md-3')) }}

				<div class="col-md-6">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary', 'id' => 'submit')) }}</div>
	      </div>
	
	     
	</div>

	<div class="container message">
		<p class="message_output">

		</p>
	</div>

	{{ Form::close() }}

	@include('partials.errors')


</div>

		  		
			</div> <!-- Panel body -->
		 


		</div>

@section('scripts')
<script>




	(function() {

		toggleInput(true);

		$(window).load(function() {
			$(".large-loading").fadeOut("slow");
			toggleInput(false);
		});

		$('#submit').on('click', function(e) {
			e.preventDefault();

			var form = $('#requirementForm'),
			    method = form.attr('method'),
			    action = form.attr('action'),
			    data = form.serialize(),
			    messageContainer = $('.message_output'), 
			    selectedID = selectedID = $('#requirement_id').val();

			 $.ajax({
			 	type: method,
			 	url: action,
			 	data: data,
			 	success: function(response){

			 		console.log(response);
			 		$('.message_output').empty();
			 		for(var index in response) { 
			 			 
			 			 if (index == 'errors') {
			 			 	alert_type = 'danger';
			 			 }
			 			 
			 			 if (index == 'success') {
			 			 	alert_type = 'success';

			 			 		 $('.requirement_indicator').each(function(key, val) {
					 			 	var requirement_indicator_id = $(this).data('requirement_id'),
					 			 	     requirement_indicator = $(this);

					 			 	if (selectedID == requirement_indicator_id) {
					 			 		requirement_indicator.find('.label').removeClass().addClass('label label-success');
					 			 		requirement_indicator.find('.glyphicon').removeClass().addClass('glyphicon glyphicon-ok');
					 			 	}
					 			 });

			 			 }
			 			


			 			 messageContainer.removeClass().addClass('message_output alert alert-' + alert_type);

					   if (response.hasOwnProperty(index)) {
					       var obj = response[index];

					       output = '<ul class="list-unstyled">';

					       if (typeof obj === 'object') {
					       		
					       	 for (var i = obj.length - 1; i >= 0; i--) {
						       	output += '<li>' + obj[i] + '</li>';
						       };
						      

						      
					       } else {
					       		output += '<li>' + obj + '</li>';
					       }

					      	 output += '</ul>';
					        messageContainer.append(output);
					   }
					}
			 	}
			 });
			

		});

		function toggleInput(status) {
			
			if (status) {
				$('#requirement_submission :input').attr('disabled', true);
			} else {
				$('#requirement_submission :input').attr('disabled', false);
			}
   
		}

		var employee_work_id = '{{$id}}';

		getEmployeeID(employee_work_id); 

		function getEmployeeID(work_id) {
			$.ajax({
				type: 'GET',
				url: employeeLink,
				data: { output: 'json', searchTerm: work_id},
				success: function(data) {
					// console.log(data[0]);
					$('#employee_id').val(data[0].id);
				}
			});
		}

		$('#stage_process_id').on('change', function() {
			var value = $(this).val(),
			    self = $(this);

			if (value != 0) {
				getRequirements(value);
			}
			
		});

		function getRequirements(stageID) {
			
			
			$.ajax({
				type: 'GET',
				url: mainLink + 'requirements/',
				data: { output: 'json', 'stage_process_id': stageID },
				success: function(data) {
						// console.log(data);
					var select_options = "";
					$.each(data, function(key,value)  {
			
						select_options += '<option value="' + key +'">' + value + "</option>";
					});

					$('#requirement_id').html(select_options);
					$('#submit').prop('disabled',  false);
				}
			});

		}

		function getPassedRequirements(employee_id) {
			$.ajax({
				type: 'GET',
				url: mainLink + 'requirements/' + employee_work_id + '/passed',
				data: { output: 'json', 'stage_process_id': stageID },
				success: function(data) {
					console.log(data);
				}
			});
		}

		
	})();
</script>
@stop


		