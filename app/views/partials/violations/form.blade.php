

				<div class="form-group">
							
					{{ Form::label('code', 'Violation Code', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('code', Input::old('code'), array('class' => 'form-control', 'required') ) }} 
					</div>

				</div>



				<div class="form-group">
							
					{{ Form::label('description', 'Violation Description', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::textarea('description', Input::old('description'), array('class' => 'form-control', 'required', 'placeholder' => 'Describe the violation') ) }}
					</div>

				</div>

				@for($i=1; $i <=5; $i++ )
					@include('partials.violations_offenses.offenses')
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
