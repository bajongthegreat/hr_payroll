

<div class="panel panel-default">
		  <div class="panel-heading"><a  href="{{ action('EmployeesController@edit', $employee->employee_work_id) }}" class="pull-right btn btn-default " ><span class="glyphicon glyphicon-edit"></span >  Edit</a><h4>Personal Information 
</h4></div>
		  <div class="panel-body">
		    <div class="row">

				<div class="form-group">
							
					{{ Form::label('firstname', 'First Name ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->firstname }}</p>
					</div>

				</div>
			</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('middlename', 'Middle Name ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->middlename }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('lastname', 'Last Name ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->lastname }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('birthdate', 'Birth date ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->birthdate }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('marital_status', 'Marital Status ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->marital_status }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('gender', 'Gender', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->gender }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('address', 'Address', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->address }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('date_hired', 'Date Hired', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->date_hired }}</p>
					</div>

				</div>
		</div>


		  </div>
		</div>

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Identifications</h4></h3>
		  </div>
		  <div class="panel-body">
		    <div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'SSS ID', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static">{{ $employee->sss_id }}   </div>

							<div class="col-sm-4">
								<span class="label label-info"><span class="glyphicon glyphicon-search"></span> More Info</span></p>
							</div>

						</div>
				</div>


				<div class="row">

						<div class="form-group">
									
							{{ Form::label('philhealth_id', 'Philhealth ID', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static">{{ $employee->philhealth_id }}</p>
							</div>

							<div class="col-md-4">
								<span class="label label-info"><span class="glyphicon glyphicon-search"></span> More Info</span></p>
							</div>

						</div>
				</div>

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('pagibig_id', 'Pagibig ID', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static">{{ $employee->pagibig_id }}</p>
							</div>

							<div class="col-xs-4">
								<span class="label label-info"><span class="glyphicon glyphicon-search"></span> More Info</span></p>
							</div>

						</div>
				</div>

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('tin_number', 'TIN ID', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static">{{ $employee->tin_number }}</p>
							</div>

						</div>
				</div>
			</div>
		 


		</div>

		<!-- Panel 3 -->

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Work Information</h4></h3>
		  </div>
		  <div class="panel-body">

		  	<div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'Work Assignment', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static">  {{ (isset($employee->position->name) ) ? $employee->position->name : '<span class="label label-default">Not specified</span>'}}  </div>

							

						</div>
				</div> <!-- End of Row -->

		    <div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'Annual PE', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ ($employee->annual_pe == 1) ? '<span class="label label-success">OK</span>' : '<span class="label label-default">None</span>' }}  </div>

							

						</div>
				</div> <!-- End of Row -->

			<div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'P.P.E Issuance', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ ($employee->ppe_issuance == 1) ? '<span class="label label-success">OK</span>' : '<span class="label label-default">None</span>' }}   </div>

							

						</div>
				</div> <!-- End of Row -->
				
				<div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'With R-1A', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ ($employee->with_r1a == 1) ?  '<span class="label label-success">Reported</span>' : '<span class="label label-default">None</span>' }}   </div>

							

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('membership_status', 'Membership Status', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> <?php echo !isset($membership_status[$employee->membership_status]) ? '<span> <i>Not specified</i> </span>' : $membership_status[$employee->membership_status];  ?> </div>

							

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('employment_status', 'Employment Status', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ $employment_status[$employee->employment_status]}}   </div>

							

						</div>
				</div> <!-- End of Row -->
				

			
			</div>

