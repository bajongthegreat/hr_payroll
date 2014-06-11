@extends('layout.master')



@section('content')


<div class="page-header">
<h1>Application Settings 
</h1>
</div>

	<div class="container">

		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">DTR</h3>
		  </div>
		  <div class="panel-body">
		    <div class="form-group">
						
				{{ Form::label('company_id', 'Company: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('company_id',  Input::old('company_id'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

		  </div>
		</div>

		@include('partials.errors')
	</div>  <!-- Container -->


@stop

@section('scripts')

<script type="text/javascript">

var _applicants_oldDepartment = '{{ (Input::old("department_id") != NULL) ? Input::old("department_id")  : 0}}',
                    _applicants_oldPosition = '{{ (Input::old("position_id") != NULL) ? Input::old("position_id")  : 0}}',
                    _applicants_oldRequirements = {{json_encode(Input::old("requirement_id"))}},
                    _applicants_oldStageProcess = '{{ (Input::old("stage_process_id") != NULL) ? Input::old("stage_process_id")  : 0}}';

</script>

@stop
