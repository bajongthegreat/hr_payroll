

<div class="panel panel-default">
		  <div class="panel-heading"><a  href="{{ action('ApplicantsController@edit', $applicant->id) }}" class="pull-right btn btn-default " ><span class="glyphicon glyphicon-edit"></span >  Edit</a>
		  	<h4>Personal Information </h4></div>
		  <div class="panel-body">
		    <div class="row">

				<div class="form-group">
							
					{{ Form::label('firstname', 'First Name ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $applicant->firstname }}</p>
					</div>

				</div>
			</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('middlename', 'Middle Name ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $applicant->middlename }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('lastname', 'Last Name ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $applicant->lastname }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('birthdate', 'Birth date ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $applicant->birthdate }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('marital_status', 'Marital Status ', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ucfirst( $applicant->marital_status) }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('gender', 'Gender', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ucfirst($applicant->gender) }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('address', 'Address', array('class' => 'col-sm-4')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $applicant->address }}</p>
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
								<p class="form-control-static">{{ $applicant->sss_id }}   </div>

							<div class="col-sm-4">
								<span class="label label-info"><span class="glyphicon glyphicon-search"></span> More Info</span></p>
							</div>

						</div>
				</div>


				<div class="row">

						<div class="form-group">
									
							{{ Form::label('philhealth_id', 'Philhealth ID', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static">{{ $applicant->philhealth_id }}</p>
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
								<p class="form-control-static">{{ $applicant->pagibig_id }}</p>
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
								<p class="form-control-static">{{ $applicant->tin_number }}</p>
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
									
							{{ Form::label('sss_id', 'Applied for position:', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static">  {{ (isset($applicant->position->name) ) ? $applicant->position->name : '<span class="label label-default">Not specified</span>'}}  </div>

							

						</div>
				</div> <!-- End of Row -->

		   

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('membership_status', 'Membership Status', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> <?php echo ($applicant->membership_status == "") ? '<span> <i>Not specified</i> </span>' : ucfirst($applicant->membership_status);  ?> </div>

							

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('employment_status', 'Employment Status', array('class' => 'col-sm-4')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ ucfirst($applicant->employment_status)}}   </div>

							

						</div>
				</div> <!-- End of Row -->
				

			
			</div>

