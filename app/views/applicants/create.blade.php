@extends('layout.master')



@section('content')


<div class="content-center">
<div class="page-header">
<h1>Register Applicant  <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>
{{ Form::open(array('action' => 'ApplicantsController@store', 'class'=> 'form-horizontal', 'role' => 'form')) }}

@include('applicants.partial.applicant_form')

	<div class="container">

	<div class="container">
		<div class="form-group">
		 <div class="form-group pull-left">
		 	

	     	{{ Form::submit('Register Applicant', array('class' => 'btn btn-primary ', 'id'=> '_applicants_submit')) }}
	      	 {{ Form::reset('Clear', array('class' => 'btn btn-default', 'id' => '_applicants_clear')) }} 
	      	 <div id="_applicants_submitload"></div>
	      </div>
	    
		</div>
		
		{{ Form::close() }}
	</div>
		@include('partials.errors')
	</div>  <!-- Container -->

</div>
@stop

@section('scripts')

<script type="text/javascript">

var _applicants_oldDepartment = '{{ (Input::old("department_id") != NULL) ? Input::old("department_id")  : 0}}',
                    _applicants_oldPosition = '{{ (Input::old("position_id") != NULL) ? Input::old("position_id")  : 0}}',
                    _applicants_oldRequirements = {{json_encode(Input::old("requirement_id"))}},
                    _applicants_oldStageProcess = '{{ (Input::old("stage_process_id") != NULL) ? Input::old("stage_process_id")  : 0}}';

</script>

@stop
