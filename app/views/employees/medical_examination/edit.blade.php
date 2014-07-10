@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Edit Medical Examination record  <a  href="{{ action('EmployeesMedicalExaminationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	<script type="text/javascript">
		__dataToUse = <?php echo $json; ?>
	</script>
	<div class="container">
		
		<?php $type = (Input::get('type') == 'bulk') ? "bulk" : "single"; ?>

		
			@if ($type != 'bulk')
				{{Form::model($pe, ['action' => ['EmployeesMedicalExaminationsController@update', $pe->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off'])}}
			
				@include('employees.medical_examination.partials.single_edit');				
			@else
				{{Form::model($pe, ['action' => 'EmployeesMedicalExaminationsController@update', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off'])}}
				@include('employees.medical_examination.partials.bulk_edit');
			
			@endif

				{{Form::close()}}

		@include('partials.errors')

		
	</div>
@stop
