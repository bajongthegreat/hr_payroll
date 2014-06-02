

				<div class="form-group" id="__violation">
							
					{{ Form::label('violation', 'Violation Code', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::select('violation_id', $violations, Input::old('name'), array('class' => 'form-control', 'required', 'id' => 'violation_id') ) }}
					</div>
					<div class="col-sm-1">  <a href="{{ action('ViolationsController@create') }}?ref={{ base64_encode(URL::current() . '#employee=' . Input::get('employee_id') ) }}" class="btn btn-primary"> Add violation</a> </div>
				</div>



<div class="panel panel-default" id="violation_decription_container">

		  <div class="panel-body">	
		  	<strong>Description</strong>: <span class="violation_decription"> </span>
		  </div>


		  <div class="panel-body">	
		  	<strong>Penalty</strong>: <span class="penalty"> </span>
		  </div>

		</div>

				<div class="form-group">
							
					{{ Form::label('violation_date', 'Date of Violation', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('violation_date', Input::old('violation_date'), array('class' => 'form-control text-date', 'required', 'data-date-format' => 'YYYY-MM-DD') ) }}
					</div>

				</div>


				<div class="form-group">
							
					{{ Form::label('violation_effectivity_date', 'Effectivity Date', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('violation_effectivity_date', Input::old('violation_effectivity_date'), array('class' => 'form-control text-date'	, 'data-date-format' => 'YYYY-MM-DD' ) ) }}
					</div>

				</div>
				