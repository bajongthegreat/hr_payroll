


<?php 

$types = ['regular' => 'Regular Work',
		  'regular_holiday' => 'Regular Holiday',
          'special_holiday' => 'Special Holiday',
          'restday' => 'Rest Day',
          'restday_with_special_holiday' => 'Rest Day with Special Holiday',
          'restday_with_regular_holiday' => 'Rest Day with Regular Holiday'
          ];


?>

				@foreach($types as $key => $type)

						

				<div class="panel panel-default rates_panel" >

					<div class="panel-heading">
						<div class="panel-title text-center"> {{$type}} </div>
					</div>

					<div class="panel-body">
						
						{{ Form::hidden('type', $key)}}
						
				<div class="form-group">
							
					{{ Form::label('rate', 'Rate', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'rate', Input::old('rate'), array('class' => 'form-control', 'required', 'min' => 0) ) }} 
					</div>

				</div>


				<div class="form-group">
							
					{{ Form::label('overtime', 'Overtime Rate', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'overtime', Input::old('overtime'), array('class' => 'form-control', 'required') ) }} 
					</div>

				</div>



				<div class="form-group">
							
					{{ Form::label('night_premium_10_3', 'Night Premium 10 PM - 3 AM', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'night_premium_10_3', Input::old('night_premium_3_6'), array('class' => 'form-control', 'required') ) }} 
					</div>

				</div>


				<div class="form-group">
							
					{{ Form::label('night_premium_3_6', 'Night Premium 3 AM - 6 AM', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'night_premium_3_6', Input::old('night_premium_3_6'), array('class' => 'form-control', 'required') ) }} 
					</div>

				</div>

						
					</div>

				</div>

				@endforeach




@section('sub_scripts')
	<script type="text/javascript">
		$('._punishment_type').on('change', function() {
			
			switch($(this).val()) {
				case 'suspended':
					$(this).parent().parent().next().find('input[name="days_suspended"]').prop("disabled", false);
				break;

				default:
					$(this).parent().parent().next().find('input[name="days_suspended"]').prop("disabled", true);
			}
		});

		$('.panel-title .close').on('click', function() {
			
		});

	</script>
@stop
