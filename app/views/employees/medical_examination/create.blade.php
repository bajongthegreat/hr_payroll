@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Add Medical Examination record  <a  href="{{ action('EmployeesMedicalExaminationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		<?php $type = (Input::get('add_type') == 'bulk') ? "bulk" : "single"; ?>

		{{Form::open(['action' => 'EmployeesMedicalExaminationsController@store', 'class' => 'form-horizontal', 'role' => 'form'])}}
		
		@if ($type == 'single')
			@include('employees.medical_examination.partials.single_add');
		@else
			@include('employees.medical_examination.partials.bulk_add');
		@endif

		@include('partials.errors')

		{{Form::close()}}
	</div>
@stop
