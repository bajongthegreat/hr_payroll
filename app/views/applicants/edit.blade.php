@extends('layout.master')




@section('content')



<div class="page-header">
<h1>Update Applicant's Information  <a  href="{{ action('ApplicantsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
 
</div>


	
<div class="container">

{{ Form::model($applicant, array('method' => 'patch', 'action' => ['ApplicantsController@update', $applicant->id], 'class'=> 'form-horizontal', 'role' => 'form')) }}


@include('applicants.partial.applicant_form')





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

            	
            	var _applicants_oldDepartment = '{{ (isset($applicant->position->department_id)) ? $applicant->position->department_id  : 0}}',
            	    _applicants_oldPosition = '{{ (isset($applicant->position->id)) ? $applicant->position->id  : 0}}',
                    _applicants_oldStageProcess = '{{ (Input::old("stage_process_id") != NULL) ? Input::old("stage_process_id")  : 0}}',
                     _applicants_oldRequirements = {{json_encode(Input::old("requirement_id"))}};



</script>
@stop