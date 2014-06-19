


<?php 

$types = ['regular' => 'Regular Work',
		  'regular_holiday' => 'Regular Holiday',
          'special_holiday' => 'Special Holiday',
          'restday' => 'Rest Day',
          'restday_with_special_holiday' => 'Rest Day with Special Holiday',
          'restday_with_regular_holiday' => 'Rest Day with Regular Holiday'
          ];


?>

			@for ($i = 0; $i < count($rates); $i++) 

				
					<?php 
						$__type = $rates[$i]['type'];
						$rate = $rates[$i]['rate'];
						$overtime = $rates[$i]['overtime_rate'];
						$night_premium_10_3 = $rates[$i]['night_premium_10_3'];
						$night_premium_3_6 = $rates[$i]['night_premium_3_6'];
					?>
				


				<div class="panel panel-default rates_panel" >

					<div class="panel-heading">
						<div class="panel-title text-center"> {{$types[$__type]}} </div>
					</div>

					<div class="panel-body">
						{{ Form::hidden('id', $rates[$i]['id']) }}
						{{ Form::hidden('type', $__type)}}
						
				<div class="form-group">
							
					{{ Form::label('rate', 'Rate', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'rate', $rate, array('class' => 'form-control', 'required', 'step' => 'any', 'min' => 0) ) }} 
					</div>

				</div>


				<div class="form-group">
							
					{{ Form::label('overtime', 'Overtime Rate', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'overtime', $overtime, array('class' => 'form-control', 'required', 'step' => 'any') ) }} 
					</div>

				</div>



				<div class="form-group">
							
					{{ Form::label('night_premium_10_3', 'Night Premium 10 PM - 3 AM', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'night_premium_10_3', $night_premium_10_3, array('class' => 'form-control', 'required', 'step' => 'any') ) }} 
					</div>

				</div>

				
				<div class="form-group">
							
					{{ Form::label('night_premium_3_6', 'Night Premium 3 AM - 6 AM', array('class' => 'col-sm-6 text-right')) }}

					<div class="col-sm-2">
						{{ Form::input('number', 'night_premium_3_6', $night_premium_3_6, array('class' => 'form-control', 'required', 'step' => 'any') ) }} 
					</div>

				</div>

						
					</div>

				</div>

			@endfor


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
