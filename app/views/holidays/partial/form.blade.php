<div class="row">
	
			<div class="form-group">
						
				{{ Form::label('name', 'Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::text('name', Input::old('name'), array('class' => 'form-control ' )) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('holiday_date', 'Date: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::text('holiday_date', Input::old('holiday_date'), array('class' => 'form-control date', 'data-date-format' => "YYYY-MM-DD") ) }}
				</div>
				
			</div>

	

			<div class="form-group">
						
				{{ Form::label('type', 'Type: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::select('type', ['regular' => 'Regular', 'special' => 'Special'] ,Input::old('type'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('remarks', 'Remarks: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::textarea('remarks',Input::old('remarks'), array('class' => 'form-control') ) }}
				</div>
				
			</div>



			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary ')) }}</div>
	      </div>
				
		

	</div>

	</div>