

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




				<div class="panel panel-default">

					<div class="panel-heading">
						<div class="panel-title"> Penalties</div>
					</div>

					<div class="panel-body">
						

						<div class="form-group">
							
							{{ Form::label('first_offense', '1st Offense', array('class' => 'col-sm-2 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('first_offense', Input::old('first_offense'), array('class' => 'form-control', 'required') ) }}
							</div>

						</div>

						<div class="form-group">
							
							{{ Form::label('second_offense', '2nd Offense', array('class' => 'col-sm-2 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('second_offense', Input::old('second_offense'), array('class' => 'form-control') ) }}
							</div>

						</div>

						<div class="form-group">
							
							{{ Form::label('third_offense', '3rd Offense', array('class' => 'col-sm-2 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('third_offense', Input::old('third_offense'), array('class' => 'form-control') ) }}
							</div>

						</div>

						<div class="form-group">
							
							{{ Form::label('fourth_offense', '4th Offense', array('class' => 'col-sm-2 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('fourth_offense', Input::old('fourth_offense'), array('class' => 'form-control') ) }}
							</div>

						</div>

						<div class="form-group">
							
							{{ Form::label('fifth_offense', '5th Offense', array('class' => 'col-sm-2 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('fifth_offense', Input::old('fifth_offense'), array('class' => 'form-control') ) }}
							</div>

						</div>

					</div>

				</div>





