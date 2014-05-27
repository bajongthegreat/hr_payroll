

				<div class="form-group">
							
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'required', 'placeholder' => 'Enter name of Disease') ) }}
					</div>

				</div>


				