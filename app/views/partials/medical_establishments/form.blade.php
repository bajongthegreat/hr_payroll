

				<div class="form-group">
							
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'required', 'placeholder' => 'Enter name of Establishment') ) }}
					</div>

				</div>


				<hr>

				<div class="form-group">
							
					{{ Form::label('address', 'Address', array('class' => 'col-sm-2 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::textarea('address', Input::old('address'), array('class' => 'form-control', 'required', 'placeholder' => 'Where the establishment is located?') ) }}
					</div>

				</div>


				<div class="form-group">
							
					{{ Form::label('telephone_number', 'Telephone #', array('class' => 'col-sm-2 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::text('telephone_number' ,Input::old('telephone_number'), array('class' => 'form-control' , 'placeholder' => 'This field is optional'	) ) }}
					</div>

				</div>

				<div class="form-group">
							
					{{ Form::label('email', 'Email Address', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('email' ,Input::old('email'), array('class' => 'form-control', 'placeholder' => 'This field is optional') ) }}
					</div>

				</div>
			
