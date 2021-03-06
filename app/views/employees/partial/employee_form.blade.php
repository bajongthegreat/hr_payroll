<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Personal Information</h4></h3>
		  </div>
		  <div class="panel-body">

	
<div class="container">






	<div class="row">

			<div class="form-group">
						
				{{ Form::label('id', 'Employee ID', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('employee_work_id', Input::old('employee_work_id'), array('class' => 'form-control', 'placeholder' => 'Leave to auto generate') ) }}
				</div>


			</div>

			<div class="form-group">

				 <div class="col-sm-7">
				 	<hr>	<!-- Seperator -->
				 </div>
			</div>



			<div class="form-group">
						
				{{ Form::label('firstname', 'First Name', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control', 'required') ) }}
				</div>

				<div class="col-sm-1"> <span class="required">* Required</span> </div>

			</div>

			<div class="form-group">
						
				{{ Form::label('middlename', 'Middle Name', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('middlename', Input::old('middlename'), array('class' => 'form-control', 'required') ) }}
				</div>

				<div class="col-sm-1"> <span class="required">* Required</span> </div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('lastname', 'Last Name', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control', 'required') ) }}
				</div>

				<div class="col-sm-1"> <span class="required">* Required</span> </div>
				
			</div>

				<div class="form-group">
							
					{{ Form::label('name_extension', 'Name Extension', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-2">
						{{ Form::select('name_extension', ['None' => NULL, 'Sr' => 'Sr','Jr' => 'Jr'	, 'III' => 'III', 'IV' => 'IV','V' => 'V', 'VI' => 'VI'],Input::old('name_extension'), array('class' => 'form-control') ) }}
					</div>

				</div>

				<div class="form-group">

				 <div class="col-sm-7">
				 	<hr>	<!-- Seperator -->
				 </div>
			</div>

					<div class="form-group">
				{{ Form::label('birthdate', 'Birthdate', array('class' => 'col-sm-2 text-right')) }}

				 <div class='input-group date col-sm-4' id='birth_date' data-date-format="YYYY-MM-DD">
				 	{{ Form::text('birthdate', Input::old('birthdate'), array('class' => 'form-control', 'data-date-format' => "YYYY-MM-DD", 'required') ) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>

                <div class="col-sm-1"> <span class="required">* Required</span> </div>

			</div>

			<div class="form-group">
						
				{{ Form::label('birthplace', 'Birth Place', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::textarea('birthplace', Input::old('birthplace'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">

				 <div class="col-sm-7">
				 	<hr>	<!-- Seperator -->
				 </div>
			</div>



			<div class="form-group">
				{{ Form::label('gender', 'Gender', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::select('gender', ['-1' => 'Please select gender','Male' => 'Male', 'Female' => 'Female'], Input::old('gender') , array('class' => 'form-control', 'required') ) }}
				</div>

				<div class="col-sm-1"> <span class="required">* Required</span> </div>
			</div>

			<div class="form-group">
				{{ Form::label('marital_status', 'Marital status', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::select('marital_status', $marital_status, Input::old('marital_status'), array('class' => 'form-control', 'required') ) }}
				</div>

				<div class="col-sm-1"> <span class="required">* Required</span> </div>
			</div>


		<div class="form-group">
				{{ Form::label('address', 'Address', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::textarea('address', Input::old('address'), array('class' => 'form-control') ) }}
				</div>
			</div>

			

			




	

	</div> <!-- Container -->
</div>  <!-- Panel Body -->


	</div> <!-- End of Panel -->


		
	

</div>

<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>In case of Emergency</h4></h3>
		  </div>
		  <div class="panel-body">

<div class="container">






	<div class="row">
		

				<div class="form-group">
							
					{{ Form::label('in_case_of_emergency_name', 'Name', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('in_case_of_emergency_name', Input::old('in_case_of_emergency_name'), array('class' => 'form-control') ) }}
					</div>

				</div>




				<div class="form-group">
							
					{{ Form::label('in_case_of_emergency_contact', 'Contact Number', array('class' => 'col-sm-2 text-right', 'required')) }}

					<div class="col-sm-4">
						{{ Form::text('in_case_of_emergency_contact', Input::old('in_case_of_emergency_contact'), array('class' => 'form-control') ) }}
					</div>

				</div>

</div></div>				
</div>  <!-- End of Body -->
		</div> <!-- End of Panel -->


<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Parents Information</h4></h3>
		  </div>
		  <div class="panel-body">

<div class="container">






	<div class="row">
		

				<div class="form-group">
							
					{{ Form::label('mothers_name', 'Mother\'s Name', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('mothers_name', Input::old('mothers_name'), array('class' => 'form-control') ) }}
					</div>

				</div>




				<div class="form-group">
							
					{{ Form::label('fathers_name', 'Father\'s Name', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::text('fathers_name', Input::old('fathers_name'), array('class' => 'form-control') ) }}
					</div>

				</div>

</div></div>				
</div>  <!-- End of Body -->
		</div> <!-- End of Panel -->

	<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Identifications</h4></h3>
		  </div>
		  <div class="panel-body">
<div class="container">
	<div class="row">


		  	<div class="form-group">


				{{ Form::label('sss_id', 'SSS Number', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('sss_id', Input::old('sss_id'), array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('philhealth_id', 'Philhealth Number', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('philhealth_id', Input::old('philhealth_id'), array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('pagibig_id', 'Pag-ibig Number', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('pagibig_id', Input::old('pagibig_id'), array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('tin_number', 'TIN Number', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::text('tin_number', Input::old('tin_number'), array('class' => 'form-control') ) }}
				</div>
			</div>

	</div>	
</div>
		  </div> <!-- Panel Body -->
	</div> <!-- End of Panel -->

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Work Information</h4></h3>
		  </div>
		  <div class="panel-body">

<div class="container">
	<div class="row">
		  	
			 <div class="form-group">
					{{ Form::label('company_id', 'Company', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::select('company_id', $companies, Input::old('company_id') , array('class' => 'form-control', 'id' => 'company_id') ) }}
					</div>

					<div class="col-sm-1"> <span class="required">* Required</span> </div>
			</div>


			 <div class="form-group" id="department_row">
					{{ Form::label('department_id', 'Department', array('class' => 'col-sm-2 text-right')) }}

					<div class="col-sm-4">
						{{ Form::select('department_id', [], Input::old('department_id') , array('class' => 'form-control', 'id' => 'department_id') ) }}
					</div>

					<div class="col-sm-1"> <span class="required">* Required</span> </div>
			</div>

            	<div class="form-group" id="position_row">
				{{ Form::label('position_id', 'Work Assignment', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::select('position_id', [] , Input::old('position_id') , array('class' => 'form-control', 'disabled', 'id' => 'position_id') ) }}
				</div>

				<div class="col-sm-1"> <span class="required">* Required</span> </div>
			</div>


			<div class="form-group">

				 <div class="col-sm-7">
				 	<hr>	<!-- Seperator -->
				 </div>
			</div>

			<div class="form-group">
				{{ Form::label('employment_status', 'Employment Status', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::select('employment_status', $employment_status, Input::old('employment_status') , array('class' => 'form-control') ) }}
				</div>
			</div>



			<div class="form-group">
				{{ Form::label('membership_status', 'Membership Status', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-4">
					{{ Form::select('membership_status', $membership_status, Input::old('membership_status') , array('class' => 'form-control') ) }}
				</div>
			</div>


			 <div class="form-group">

			 	{{ Form::label('date_hired', 'Date Hired:', array('class' => 'col-sm-2 text-right')) }}
                <div class='input-group date col-sm-4' id='date_hired' data-date-format="YYYY-MM-DD">

				 	{{ Form::text('date_hired', Input::old('date_hired'), array('class' => 'form-control date', 'data-date-format' => "YYYY-MM-DD") ) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>


            </div>

		  
	</div>	
</div>
		  </div> <!-- Panel Body -->
	</div> <!-- End of Panel -->