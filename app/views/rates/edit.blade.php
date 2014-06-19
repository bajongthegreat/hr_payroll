@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Update Rates  <a  href="{{ action('RatesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		{{Form::open(['action' => ['RatesController@update', $parent->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form'])}}
		
				
		<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title"><h4>Rates Information</h4></h3>
				  </div>
				  <div class="panel-body">

				  	<!--  Medical Establishment creation form -->
				  	@include('partials.rates.form-edit')
				 
				 </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->

		@if (Input::has('ref'))
			{{ Form::hidden('ref', Input::get('ref')) }}
		@endif
		<div class="ratesContainer"></div>
		<!-- Form Buttons -->
		<div class="container" id="buttons">
				<div class="form-group">
				 <div class="form-group pull-left">
			     	{{ Form::submit('Submit', array('class' => 'btn btn-primary ', 'id'=> 'RatesSubmit')) }}
			      	 {{ Form::reset('Clear', array('class' => 'btn btn-default', 'id' => 'clear')) }} 
			      	 <div id="submitload"></div>
			      </div>
			    
				</div>
				
				
			</div>

	<div class="errors"></div>			
		<!-- Displays all errors found -->
		@include('partials.errors')

		{{Form::close()}}
	</div>
@stop

@section('scripts')
<script type="text/javascript">
(function(){
$('#RatesSubmit').on('click', function(e) {


		var container = [];
		var error = [];

		// Grab All rates panel
		var _ratesElements = $('.rates_panel');

		var rate;
		var overtime;
		var np_10_3;
		var np_3_6;
		var type;

		var counter = 0;


		// Loop through each panel and get the required data
		$.each(_ratesElements, function(key,panel) {
			id = $(this).find('input[name="id"]').val();
			rate = $(this).find('input[name="rate"]').val();
			type = $(this).find('input[name="type"]').val();
			overtime = $(this).find('input[name="overtime"]').val();
			np_10_3 = $(this).find('input[name="night_premium_10_3"]').val();
			np_6_3 = $(this).find('input[name="night_premium_3_6"]').val();
			
			// Check if the required inputs is not empty
			if (rate == 0 || rate == '' && overtime == 0 || overtime == '' && np_10_3 == '' || np_10_3 == 0 && np_6_3 == 0 || np_6_3 == '' ) {
				$(this).addClass('panel-danger');
				return true;
			} else {
				$(this).removeClass('panel-danger').addClass('panel-default');
			}

			// Wrap all gathered data into an Object
			container[key] = { 'type': type,
								'rate': rate,
			                   'overtime_rate': overtime,
			                   'night_premium_10_3': np_10_3,
			                   'night_premium_3_6' : np_6_3,
			                   'id': id };
					});	



		// If detected any form with a .has-error class, scroll to it, so that the users  know where the error is located
		if ($('.has-error').length > 0) {

			$('html, body').animate({
		        scrollTop: $('.has-error').first().offset().top -150
		    }, 500);

		    $('.has-error').first().focus();

		    return false;
		} else {

			
			// Check if our container has any content
			if (container.length == 0) {

				$('.rates_panel').first().removeClass('panel-default').addClass('panel-danger');

				$('html, body').animate({
			        scrollTop: $('.rates_panel').first().offset().top -60
			    }, 500);
			}
			
			// If our container has a content
			// Find the container of our JSON object
			// Construct a new JSON string
			// Put the JSON string into a hidden element that is found inside our JSON container DIV
			if (container.length > 0) {
					$('.ratesContainer').find('input').remove();
					var rates = JSON.stringify(container);
					$('.ratesContainer').append('<input type="hidden" name="_rates" value=\'' + rates + '\'>');
						
			} else {
					return false;
			}	
				
		}
	});	
})();
	
</script>
@stop