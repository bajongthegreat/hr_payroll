@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Daily Time Record - Add Record  <a  href="{{ action('DTRController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		<?php $type = (Input::get('add_type') == 'bulk') ? "bulk" : "single"; ?>

		{{Form::open(['action' => 'DTRController@store', 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off'])}}
		
		@include('dtr.partials.bulk')


		@include('partials.errors')

		{{Form::close()}}
	</div>
@stop
