@extends('layout.master')




@section('content')


<div class="page-header">
<h1>Update Member Information  <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
 
</div>


	
<div class="container">

{{ Form::model($employee, array('method' => 'patch', 'action' => ['EmployeesController@update', $employee->id], 'class'=> 'form-horizontal', 'role' => 'form')) }}

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
				 	{{ Form::text('birthdate', Input::old('lastname'), array('class' => 'form-control', 'data-format' => 'MM/DD/YYYY') ) }}
                  
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

			 <div class="form-group">

			 	{{ Form::label('date_hired', 'Date Hired:', array('class' => 'col-sm-2')) }}
                <div class='input-group date col-sm-4' id='date_hired'>
                    {{ Form::text('date_hired', Input::old('date_hired'), array('class' => 'form-control', 'data-format' => 'MM/DD/YYYY') ) }}
                    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>

            	<div class="form-group">
				{{ Form::label('position_id', 'Position:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('position_id', ['-1' => 'Please select position','1' => 'Manager', '2' => 'Accountant'], Input::old('gender') , array('class' => 'form-control') ) }}
				</div>
			</div>

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