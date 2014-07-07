<style type="text/css">
	.row {
		margin-top: 5px;
	}
</style>

<div class="panel panel-info">
		  <div class="panel-heading"><a  href="{{ action('EmployeesController@show', $employee->employee_work_id) }}" class="pull-right btn btn-default " ><span class="glyphicon glyphicon-edit"></span >  View Profile</a><h4>Personal Information 
</h4></div>
		  <div class="panel-body">

		  	<div class="row">

				<div class="form-group">
							
					{{ Form::label('employee_work_id', 'Work ID ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('employee_work_id', Input::old('employee_work_id'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>
			</div>

		    <div class="row">

				<div class="form-group">
							
					{{ Form::label('firstname', 'First Name ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>
			</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('middlename', 'Middle Name ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('middlename', Input::old('middlename'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('lastname', 'Last Name ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>
		</div>

		<!-- New Addition -->
		<div class="row">

				<div class="form-group">
							
					{{ Form::label('name_extension', 'Name Extension ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::select('name_extension', ['None' => 'None', 'Sr' => 'Sr','Jr' => 'Jr'	, 'III' => 'III', 'IV' => 'IV','V' => 'V', 'VI' => 'VI'],Input::old('name_extension'), array('class' => 'form-control') ) }}
					</div>

				</div>
		</div>

		<hr>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('birthdate', 'Birth date ', array('class' => 'col-sm-4 text-right')) }}

					<div class='input-group date col-sm-4' id='birthdate' data-date-format="YYYY-MM-DD">

					
					  	<?php // Temporary fix for Bootstrap 3.0 datetime picker 
					  		$birthdate =  ($employee->birthdate == '0000-00-00' || $employee->birthdate == '' ) ? "" : $employee->birthdate; 
					  	?>

				 	{{ Form::text('birthdate', $birthdate , array('class' => 'form-control date', 'data-date-format' => "YYYY-MM-DD", 'required') ) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('birthplace', 'Birthplace', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::textarea('birthplace', Input::old('birthplace'), array('class' => 'form-control') ) }}
					</div>

				</div>
		</div>


		<hr>
		<div class="row">

				<div class="form-group">
							
					{{ Form::label('marital_status', 'Marital Status ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::select('marital_status', $marital_status, Input::old('marital_status'), array('class' => 'form-control', 'required') ) }}
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('gender', 'Gender', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<?php
							if (Input::old('gender') != "") {
								$gender = Input::old('gender');
							} else {
								
								if (isset($employee->gender) && $employee->gender != "") {
									$gender = ucfirst(strtolower($employee->gender));
								} else {
									$gender = "";
								}


							}
							
						 ?>
							{{ Form::select('gender', ['0' => 'Please select gender','Male' => 'Male', 'Female' => 'Female'], $gender , array('class' => 'form-control', 'required') ) }}
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('address', 'Address', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::textarea('address', Input::old('address'), array('class' => 'form-control') ) }}
					</div>

				</div>
		</div>

		


		  </div>
		</div>

		<div class="panel panel-info	">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>In case of emergency contact</h4></h3>
		  </div>
		  <div class="panel-body">

		  	<div class="row">

				
				<div class="form-group">
							
					{{ Form::label('in_case_of_emergency_name', 'Name', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('in_case_of_emergency_name', Input::old('in_case_of_emergency_name'), array('class' => 'form-control', 'placeholder' => 'Whose to contact') ) }}
					</div>

				</div>



		</div>

		<div class="row">

				
				<div class="form-group">
							
					{{ Form::label('in_case_of_emergency_contact', 'Contact Number', array('class' => 'col-sm-4 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::text('in_case_of_emergency_contact', Input::old('in_case_of_emergency_contact'), array('class' => 'form-control', 'placeholder' => 'Enter phone number') ) }}
					</div>

				</div>
		</div>

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->


		<div class="panel panel-info	">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Parents Information</h4></h3>
		  </div>
		  <div class="panel-body">

		  	<div class="row">

				<div class="form-group">
							
					{{ Form::label('mothers_name', 'Mother\'s Name', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('mothers_name', Input::old('mothers_name'), array('class' => 'form-control', 'placeholder' => 'Enter mother\'s fullname') ) }}
					</div>

				</div>


		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('fathers_name', 'Father\'s Name', array('class' => 'col-sm-4 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::text('fathers_name', Input::old('fathers_name'), array('class' => 'form-control', 'placeholder' => 'Enter father\'s fullname ') ) }}
					</div>

				</div>

				
		</div>

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->

		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Identifications</h4></h3>
		  </div>
		  <div class="panel-body">
		    <div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'SSS ID', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('sss_id', Input::old('sss_id'), array('class' => 'form-control','placeholder' => '12-1234567-0' ) ) }}
							</div>

							

						</div>
				</div>


				<div class="row">

						<div class="form-group">
									
							{{ Form::label('philhealth_id', 'Philhealth ID', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('philhealth_id', Input::old('philhealth_id'), array('class' => 'form-control', 'placeholder' => '12-123456789-0') ) }}
							</div>


						</div>
				</div>

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('pagibig_id', 'Pagibig ID', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('pagibig_id', Input::old('pagibig_id'), array('class' => 'form-control', 'placeholder' => '0000-0000-0000') ) }}
							</div>


						</div>
				</div>

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('tin_number', 'TIN ID', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('tin_number', Input::old('tin_number'), array('class' => 'form-control', 'placeholder' => '000-000-000-000') ) }}
							</div>

						</div>
				</div>
			</div>
		 


		</div>

		<!-- Panel 3 -->

		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Work Information</h4></h3>
		  </div>
		  <div class="panel-body">

		  	<div class="row">

						<div class="form-group">
									
							{{ Form::label('company_id', 'Company:', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::select('company_id', $companies, Input::old('company_id') , array('class' => 'form-control', 'id' => 'company_id', 'required') ) }}
							</div>

							

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('department_id', 'Department:', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::select('department_id', [], Input::old('department_id') , array('class' => 'form-control', 'id' => 'department_id', 'required') ) }}
							</div>

							

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('position_id', 'Work Assignment:', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::select('position_id', [] , Input::old('position_id') , array('class' => 'form-control', 'disabled', 'id' => 'position_id', 'required') ) }}
							</div>

							

						</div>
				</div> <!-- End of Row -->

				<hr>	<!-- Seperator -->

				 <div class="row">

						<div class="form-group">
									
							{{ Form::label('salary', 'Salary: ', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<div class="input-group">
								  <span class="input-group-addon">PHP</span>
								  {{ Form::text('salary', Input::old('salary'), array('class' => 'form-control', 'required') ) }}
								  <span class="input-group-addon"></span>
								</div>
								
							</div>

							

						</div>
				</div> <!-- End of Row -->

			<hr>	<!-- Seperator -->

		    <div class="row">

						<div class="form-group">
									
							{{ Form::label('annual_pe', 'Annual PE', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::checkbox('annual_pe',  1)}}
							</div>

							

						</div>
				</div> <!-- End of Row -->

			<div class="row">

						<div class="form-group">
									
							{{ Form::label('ppe_issuance', 'P.P.E Issuance', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::checkbox('ppe_issuance',  1)}}
							</div>

							

						</div>
				</div> <!-- End of Row -->
				
				<div class="row">

						<div class="form-group">
									
							{{ Form::label('with_r1a', 'With R-1A', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::checkbox('with_r1a',  1)}}
							</div>

							

						</div>
				</div> <!-- End of Row -->

				<hr>	<!-- Seperator -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('membership_status', 'Membership Status', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::select('membership_status', $membership_status, Input::old('membership_status') , array('class' => 'form-control') ) }}
								</div>

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('employment_status', 'Employment Status', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								{{ Form::select('employment_status', $employment_status, Input::old('employment_status') , array('class' => 'form-control') ) }}   </div>

					
						</div>
				</div> <!-- End of Row -->

				<div class="row">

				<div class="form-group">
							
					{{ Form::label('date_hired', 'Date Hired', array('class' => 'col-sm-4 text-right')) }}

					  <div class='input-group date col-sm-4' id='date_hired' data-date-format="YYYY-MM-DD">
					  
					  	<?php // Temporary fix for Bootstrap 3.0 datetime picker 
					  		$date_hired =  ($employee->date_hired == '0000-00-00' || $employee->date_hired == '' ) ? "" : $employee->date_hired; 
					  	?>
				 	
				 	{{ Form::text('date_hired', $date_hired , array('class' => 'form-control date', 'data-date-format' => "YYYY-MM-DD") ) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                	</div>

				</div>
		</div>


				<div class="form-group" style="margin-top:15px;">
			     <div class="col-sm-2">{{ Form::submit('Update Member', array('class' => 'btn btn-primary ')) }}</div>
			      <div class="col-sm-2" style="margin-left: 15px;"> {{ Form::reset('Clear', array('class' => 'btn btn-default')) }} </div>
				</div>


			
			</div> <!-- End of Panel -->



