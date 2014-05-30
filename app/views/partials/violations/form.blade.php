

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




				<div class="form-group">
							
					{{ Form::label('penalty', 'Penalty', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('penalty', Input::old('penalty'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>





