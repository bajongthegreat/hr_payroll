@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Add Violation  <a  href="{{ action('ViolationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		{{Form::model($violation, ['action' => ['ViolationsController@update', $violation->id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form'])}}
	
				
		<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title"><h4>Violation Information</h4></h3>
				  </div>
				  <div class="panel-body">

		<div class="offenses_container"></div>
				  	<!--  Medical Establishment creation form -->
				  	@include('partials.violations.form')
				 
				 </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->


		<!-- Form Buttons -->
		<div class="container" id="buttons">
				<div class="form-group">
				 <div class="form-group pull-left">
			     	{{ Form::submit('Submit', array('class' => 'btn btn-primary ', 'id'=> 'violationSubmit')) }}
			      	 {{ Form::reset('Clear', array('class' => 'btn btn-default', 'id' => 'clear')) }} 
			      	 <div id="submitload"></div>
			      </div>
			    
				</div>
				
				
			</div>


		<!-- Displays all errors found -->
		@include('partials.errors')

		{{Form::close()}}
	</div>
@stop


@section('scripts')
<script type="text/javascript">
(function(){
$('#violationSubmit').on('click', function(e) {

		var container = [];
		var offense_number = 0;
		var punishment_type = "";
		var days_suspended = 0;
		var offenses = $('.offense_panel');
		var error = [];


		var counter = 0;

		if ($('#code').val().length == 0) {

			$('#code').parent().addClass('has-error');

			error[counter+1] = { message: 'Code is empty', element: $('#code')};
		} else {			
			$('#code').parent().removeClass('has-error');

		}


		if ($('#description').val().length == 0) {
			
			$('#description').parent().addClass('has-error');

			error[counter+2] = { message: 'Description is empty', element: $('#description')};

		} else {
			$('#description').parent().removeClass('has-error');
		}

		$.each(offenses, function(key,panel) {

			e_days_suspended = $(this).find('.days_suspended');

			offense_number = $(this).find('._ofn').val();
			punishment_type = $(this).find('._punishment_type').val();
			days_suspended = e_days_suspended.val();
			
			if (punishment_type == 0) {
				return false;
			} else {

				// If suspended is selected, Check if days is specified. Otherwise, throw an error.
				if (punishment_type == 'suspended' && days_suspended.length == 0) {
					e_days_suspended.parent().addClass('has-error');
				} else {
					e_days_suspended.parent().removeClass('has-error');
					
				}
			}

		
			container[key] = {'offense_number': offense_number,
			                   'punishment_type': punishment_type,
			                   'days_of_suspension': days_suspended};
					});	
		
		if (container.length == 0) {

			$('.offense_panel').first().removeClass('panel-default').addClass('panel-danger');

			$('html, body').animate({
		        scrollTop: $('.offense_panel').first().offset().top -60
		    }, 500);


			// error[counter+3] = { message: 'Please make sure you entered a value on the first offense.', element: $('offense_panel').first() };	
		}
		
		if (container.length > 0) {
			$('.offenses_container').find('input').remove();
			var offenses = JSON.stringify(container);
			$('.offenses_container').append('<input type="hidden" name="offenses" value=\'' + offenses + '\'>');
				// console.log(offenses);
		} else {
			return false;
		}	


		if ($('.has-error').length > 0) {

			$('html, body').animate({
		        scrollTop: $('.has-error').first().offset().top -150
		    }, 500);

		    $('.has-error').first().focus();

		    return false;
		}

	});


})();
	
</script>
@stop