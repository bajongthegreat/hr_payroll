<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Personal Information</h4></h3>
		  </div>
		  <div class="panel-body">

	
<div class="container">






	<div class="row">

		


			<div class="form-group">
						
				{{ Form::label('firstname', 'First Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control') ) }}
				</div>

			</div>

			<div class="form-group">
						
				{{ Form::label('middlename', 'Middle Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('middlename', Input::old('middlename'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('lastname', 'Last Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">
							
					{{ Form::label('name_extension', 'Name Extension ', array('class' => 'col-sm-2')) }}

					<div class="col-sm-2">
						{{ Form::select('name_extension', ['None',  'Sr', 'Jr'	,'III', 'IV','V','VI'],Input::old('name_extension'), array('class' => 'form-control') ) }}
					</div>

				</div>

			

					<div class="form-group">
				{{ Form::label('birthdate', 'Birthdate: ', array('class' => 'col-sm-2')) }}

				 <div class='input-group date col-sm-2' id='birthdate'>
				 	{{ Form::text('birthdate', Input::old('birthdate'), array('class' => 'form-control date', 'data-format' => "YYYY-MM-DD") ) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>

			</div>


			<div class="form-group">
				{{ Form::label('gender', 'Gender:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::select('gender', ['-1' => 'Please select gender','Male' => 'Male', 'Female' => 'Female'], Input::old('gender') , array('class' => 'form-control', 'required') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('marital_status', 'Marital status:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::select('marital_status', $marital_status, Input::old('marital_status'), array('class' => 'form-control') ) }}
				</div>
			</div>


		<div class="form-group">
				{{ Form::label('address', 'Address:', array('class' => 'col-sm-2')) }}

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
		    <h3 class="panel-title"><h4>Identifications</h4></h3>
		  </div>
		  <div class="panel-body">
		  	<div class="form-group">
				{{ Form::label('sss_id', 'SSS Number:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::text('sss_id', Input::old('sss_id'), array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('philhealth_id', 'Philhealth Number:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::text('philhealth_id', Input::old('philhealth_id'), array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('pagibig_id', 'Pag-ibig Number:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					{{ Form::text('pagibig_id', Input::old('pagibig_id'), array('class' => 'form-control') ) }}
				</div>
			</div>
		  </div> <!-- Panel Body -->
	</div> <!-- End of Panel -->

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Work Information</h4></h3>
		  </div>
		  <div class="panel-body">

		  	
			 <div class="form-group">
					{{ Form::label('company_id', 'Company:', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						{{ Form::select('company_id', $companies, Input::old('company_id') , array('class' => 'form-control', 'id' => '_applicants_company_id') ) }}
					</div>
			</div>


			 <div class="form-group" id="_applicants_department_row">
					{{ Form::label('department_id', 'Department:', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						{{ Form::select('department_id', [], Input::old('department_id') , array('class' => 'form-control', 'id' => '_applicants_department_id') ) }}
					</div>
			</div>

            	<div class="form-group" id="_applicants_position_row">
				{{ Form::label('position_id', 'Work Assignment:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('position_id', [] , Input::old('position_id') , array('class' => 'form-control', 'disabled', 'id' => '_applicants_position_id') ) }}
				</div>
			</div>

			<div class="form-group hide">
				{{ Form::label('employment_status', 'Employment Status:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('employment_status', $employment_status, Input::old('employment_status') , array('class' => 'form-control') ) }}
				</div>
			</div>



			<div class="form-group hide">
				{{ Form::label('membership_status', 'Membership Status:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('membership_status', $membership_status, Input::old('membership_status') , array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('annual_pe', 'Annual PE:', array('class' => 'col-md-2')) }}

				<div class="col-md-1">
					<input type="checkbox" name="annual_pe" value="1">
				</div>

				{{ Form::label('ppe_issuance', 'P.P.E Issuace:', array('class' => 'col-md-2')) }}

				<div class="col-md-1">
					<input type="checkbox" name="ppe_issuance" value="1">
				</div>

				{{ Form::label('with_r1a', 'With R-1A:', array('class' => 'col-md-2')) }}

				<div class="col-md-1">
					<input type="checkbox" name="with_r1a" value="1">
				</div>
			</div>

			
		

			 <div class="form-group">

			 	{{ Form::label('application_date', 'Date of Application:', array('class' => 'col-sm-2')) }}
                <div class='input-group date col-sm-4' id='_applicants_date_hired'>
                	<?php $application_date = (strlen(Input::old('application_date')) == 0) ? date('Y-m-d') : Input::old('application_date'); ?>
				 	{{ Form::text('application_date',$application_date, array('class' => 'form-control date', 'data-format' => "YYYY-MM-DD") ) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>

		  
		

		  </div> <!-- Panel Body -->
	</div> <!-- End of Panel -->


	<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Document Requirements</h4></h3>
		  </div>
		  <div class="panel-body">
	
			<div class="row container">
				<div class="page-header"><strong>Interview</strong></div>
				<div id="_applicants_InterviewRequirementsContainer"></div>
			</div>

			<div class="row container">
				<div class="page-header"><strong>Orientation</strong></div>
				<div id="_applicants_OrientationRequirementsContainer"></div>
			</div>
			
			


			

			
			</div>
		  </div> <!-- Panel Body -->
	</div> <!-- End of Panel -->