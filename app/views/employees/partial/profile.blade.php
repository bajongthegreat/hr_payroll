
<div class="panel panel-default">
		  <div class="panel-heading">
		  	@if ($accessControl->hasAccess($uri, 'edit', $GLOBALS['_byPassRole']))
		  	<a  href="{{ action('EmployeesController@edit', $employee->employee_work_id) }}" class="pull-right btn btn-default " ><span class="glyphicon glyphicon-edit"></span >  Edit</a>
		  	@endif
		  	<h4><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Personal Information
        </a>
</h4></div>
		  <div  id="collapseOne" class="panel-body panel-collapse collapse in">
		    <div class="row">

				<div class="form-group">
							
					{{ Form::label('firstname', 'First Name ', array('class' => 'col-sm-4 text-right text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ucfirst($employee->firstname) }}</p>
					</div>

				</div>
			</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('middlename', 'Middle Name ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ucfirst($employee->middlename) }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('lastname', 'Last Name ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ucfirst($employee->lastname) }}</p>
					</div>

				</div>
		</div>


		<div class="row">

				<div class="form-group">
							
					{{ Form::label('name_extension', 'Name Extension ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ucfirst($employee->name_extension) }}</p>
					</div>

				</div>
		</div>

		<hr>
		<div class="row">

				<div class="form-group">
							
					{{ Form::label('birthdate', 'Birth date ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-6">
						<p class="form-control-static">
							<?php 

							if ($employee->birthdate == '0000-00-00' || $employee->birthdate == '') {
								echo '<span class="label label-default">Not specified</span>';
							} else {

								$date = new DateTime($employee->birthdate);

								$datetime1 = date_create($employee->birthdate);
							    $datetime2 = date_create(date('Y-m-d'));
							    
							    $interval = date_diff($datetime1, $datetime2);
							   
								echo $date->format('F d, Y') . ' (' . $interval->format('%y') .' years old) ';
							}
							?>
						</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('birthplace', 'Birth Place ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ($employee->birthplace) ? ucfirst( $employee->birthplace) : '<span class="label label-default">Not specified</span>' }}</p>
					</div>

				</div>
		</div>

		<hr>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('marital_status', 'Marital Status ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ($employee->marital_status != "" && $employee->marital_status) ? ucfirst($employee->marital_status) : '<span class="label label-default">Not specified</span>' }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('gender', 'Gender', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ($employee->gender && $employee->gender != "") ? ucfirst($employee->gender) : '<span class="label label-default">Not specified</span>' }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('address', 'Address', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ ($employee->address ) ? $employee->address  : '<span class="label label-default">Not specified</span>' }}</p>
					</div>

				</div>
		</div>

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('date_hired', 'Date Hired', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-7">
						<p class="form-control-static">
							<?php 

							if ($employee->date_hired && $employee->date_hired != "0000-00-00" && $employee->date_hired != "") {
								$date = new DateTime($employee->date_hired);

								$datetime1 = date_create($employee->date_hired);
							    $datetime2 = date_create(date('Y-m-d'));
							    
							    $interval = date_diff($datetime1, $datetime2);
									
							    if ( $interval->format('%y') == 0) {
							    	echo $date->format('F d,  Y') . ' ( ' . $interval->format('%m') .' month(s) and ' . $interval->format('%d') .' day(s)  in service)';
							    } else {
							    	
							    	if ($interval->format('%y') == 1) {
										$year_str = 'year';
									} else {
										$year_str = 'years';
									}	

									echo $date->format('F d,  Y') . ' (' . $interval->format('%y') .' ' . $year_str .' in service)';
							    } 

											    

																
							} else {
								echo '<span class="label label-default">Not specified</span>';
							}
							?>
						</p>
					</div>

				</div>
		</div>


		  </div>
		</div>

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#in_case_of_emergency">
          In case of emergency
        </a></h4></h3>
		  </div>
		  <div id="in_case_of_emergency" class="panel-body panel-collapse collapse in">

		  	<div class="row">

				<div class="form-group">
							
					{{ Form::label('in_case_of_emergency_name', 'Name', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->in_case_of_emergency_name or '<span class="label label-default">Not specified</span>' }}   </div>
					</div>

				</div>



		<div class="row">

				<div class="form-group">
							
					{{ Form::label('in_case_of_emergency_contact', 'Contact Number', array('class' => 'col-sm-4 text-right', 'required')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ $employee->in_case_of_emergency_contact or '<span class="label label-default">Not specified</span>'}}   </div>
					</div>

				</div>

				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->


		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          Family Information
        </a></h4></h3>
		  </div>
		  <div id="parentsinfo" class="panel-body panel-collapse collapse in">

		  	<div class="row">

				<div class="form-group">
							
					{{ Form::label('mothers_name', 'Mother\'s Name', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{ (strlen($employee->mothers_name) > 0) ?  $employee->mothers_name : '<span class="label label-default">Not specified</span>'}}   </div>
					</div>

				</div>



		<div class="row">

				<div class="form-group">
							
					{{ Form::label('fathers_name', 'Father\'s Name', array('class' => 'col-sm-4 text-right', 'required')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{  (strlen($employee->fathers_name) > 0) ?  $employee->fathers_name : '<span class="label label-default">Not specified</span>'}}   </div>
					</div>

				</div>

		@if (strtolower($employee->marital_status) != 'single')		
		<div class="row">

				<div class="form-group">
							
					{{ Form::label('spouse_name', 'Spouse Name', array('class' => 'col-sm-4 text-right', 'required')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{  (strlen($employee->spouse_name) > 0) ?  $employee->spouse_name : '<span class="label label-default">Not specified</span>'}}   </div>
					</div>

				</div>				
		@endif

		<div class="row">

				<div class="form-group">
							
					{{ Form::label('children_count', 'Number of Children', array('class' => 'col-sm-4 text-right', 'required')) }}

					<div class="col-sm-4">
						<p class="form-control-static">{{  (strlen($employee->children_count) > 0) ?  $employee->children_count : '<span class="label label-default">No child</span>'}}   </div>
					</div>

				</div>		
		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#identification">
          Identifications
        </a></h4></h3>
		  </div>
		  <div id="identification" class="panel-body panel-collapse collapse in">
		    <div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'SSS ID', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<p class="form-control-static">{{ $employee->sss_id }}   </div>

							<div class="col-sm-4">
								<span class="label label-info"><span class="glyphicon glyphicon-search"></span> More Info</span></p>
							</div>

						</div>
				</div>


				<div class="row">

						<div class="form-group">
									
							{{ Form::label('philhealth_id', 'Philhealth ID', array('class' => 'col-sm-4 text-right')) }}

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
									
							{{ Form::label('pagibig_id', 'Pagibig ID', array('class' => 'col-sm-4 text-right')) }}

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
									
							{{ Form::label('tin_number', 'TIN ID', array('class' => 'col-sm-4 text-right')) }}

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
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#workinfo">
          Work Information
        </a></h4></h3>
		  </div>
		  <div id="workinfo" class="panel-body panel-collapse collapse in">

		  	<div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'Work Assignment', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<p class="form-control-static">  {{ (isset($employee->position->name) ) ? $employee->position->name : '<span class="label label-default">Not specified</span>'}}  </div>

							

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'Salary', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<p class="form-control-static">  {{ (isset($employee->salary) ) ? 'PHP ' . number_format( $employee->salary, 2) : '<span class="label label-default">Not specified</span>'}}  </div>

							

						</div>
				</div> <!-- End of Row -->

				<hr>	<!-- Seperator -->

		    <div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'Annual PE', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ ($employee->annual_pe == 1) ? '<span class="label label-success">OK</span>' : '<span class="label label-default">None</span>' }}  </div>

							

						</div>
				</div> <!-- End of Row -->

			<div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'P.P.E Issuance', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
						
									<p class="form-control-static"> {{ ($employee->ppe_issuance == 1) ? '<span class="label label-success">OK</span>' : '<span class="label label-default">None</span>' }}  </div>

							

							</div>
				</div> <!-- End of Row -->
				
				<div class="row">

						<div class="form-group">
									
							{{ Form::label('sss_id', 'With R-1A', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ ($employee->with_r1a == 1) ?  '<span class="label label-success">Reported</span>' : '<span class="label label-default">None</span>' }}   </div>

							

						</div>
				</div> <!-- End of Row -->

				<hr>	<!-- Seperator -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('membership_status', 'Membership Status', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> <?php echo ($employee->membership_status == "associate") ? '<span class="label label-default">' . ucfirst($employee->membership_status) . '</span>' : '<span class="label label-success">' . ucfirst($employee->membership_status) . '</span>';  ?> </div>

							

						</div>
				</div> <!-- End of Row -->

				<div class="row">

						<div class="form-group">
									
							{{ Form::label('employment_status', 'Employment Status', array('class' => 'col-sm-4 text-right')) }}

							<div class="col-sm-4">
								<p class="form-control-static"> {{ ucfirst($employee->employment_status)}}   </div>

							

						</div>
				</div> <!-- End of Row -->
				

			
			</div>

