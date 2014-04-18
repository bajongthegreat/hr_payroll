@extends('layout.master')




@section('content')



<div class="page-header">
<h1>Update Member Information  <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
 
</div>


	
<div class="container">

{{ Form::model($employee, array('method' => 'patch', 'action' => ['EmployeesController@update', $employee->id], 'class'=> 'form-horizontal', 'role' => 'form')) }}

	<div class="row">

			<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Personal Information</h4></h3>
		  </div>
		  <div class="panel-body">

	
<div class="container">






	<div class="row">

			<div class="form-group">
						
				{{ Form::label('id', 'Employee ID: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('employee_work_id', Input::old('employee_work_id'), array('class' => 'form-control') ) }}
				</div>

			</div>


			<div class="form-group">
						
				{{ Form::label('firstname', 'First Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control') ) }}
				</div>

			</div>

			<div class="form-group">
						
				{{ Form::label('middlename', 'Middle Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('middlename', Input::old('middlename'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('lastname', 'Last Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			

					<div class="form-group">
				{{ Form::label('birthdate', 'Birthdate: ', array('class' => 'col-sm-2')) }}

				 <div class='input-group date col-sm-4' id='birthdate'>
                    <input name="birthdate" type='text' class="form-control" data-format="YYYY-DD-MM" value="<?php echo (isset($employee->birthdate)) ? $employee->birthdate : ""; ?>" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>

			</div>


			<div class="form-group">
				{{ Form::label('gender', 'Gender:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('gender', ['-1' => 'Please select gender','Male' => 'Male', 'Female' => 'Female'], Input::old('gender') , array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('marital_status', 'Marital status:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('marital_status', Input::old('marital_status'), array('class' => 'form-control') ) }}
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

				<div class="col-sm-4">
					{{ Form::text('sss_id', Input::old('sss_id'), array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('philhealth_id', 'Philhealth Number:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('philhealth_id', Input::old('philhealth_id'), array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('pagibig_id', 'Pag-ibig Number:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
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
						{{ Form::select('company_id', $companies, Input::old('company_id') , array('class' => 'form-control', 'id' => 'company_id') ) }}
					</div>
			</div>

            	<div class="form-group">
				{{ Form::label('position_id', 'Work Assignment:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('position_id', $positions, Input::old('position_id') , array('class' => 'form-control', 'disabled') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('employment_status', 'Employment Status:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('employment_status', $employment_status, Input::old('employment_status') , array('class' => 'form-control', 'disabled') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('annual_pe', 'Annual PE:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">

					{{ Form::checkbox('annual_pe') }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('ppe_issuance', 'P.P.E Issuace:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
						{{ Form::checkbox('ppe_issuance') }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('with_r1a', 'With R-1A:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::checkbox('with_r1a') }}
				</div>
			</div>

		

			 <div class="form-group">

			 	{{ Form::label('date_hired', 'Date Hired:', array('class' => 'col-sm-2')) }}
                <div class='input-group date col-sm-4' id='date_hired'>
                    <input name="date_hired" type='text' class="form-control" data-format="YYYY-DD-MM" value="{{ $employee->date_hired }}"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>

		  
		

		  </div> <!-- Panel Body -->
	</div> <!-- End of Panel -->




		<div class="form-group">
	     <div class="col-sm-2">{{ Form::submit('Update Member', array('class' => 'btn btn-primary ')) }}</div>
	      <div class="col-sm-2"> {{ Form::reset('Clear', array('class' => 'btn btn-default')) }} </div>
		</div>
		
		{{ Form::close() }}
	</div>

	@include('partials.errors')

</div>

@stop


@section('scripts')

<script type="text/javascript">
            $(function () {
                $('#date_hired, #birthdate').datetimepicker({
                    pickTime: false
                });


            });


            moment().fromNow();
        </script>

@stop