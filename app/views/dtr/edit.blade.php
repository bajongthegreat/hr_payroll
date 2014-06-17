@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Daily Time Record - Add Record  <a  href="{{ action('DTRController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		<?php $type = (Input::get('add_type') == 'bulk') ? "bulk" : "single"; ?>

		{{Form::open(['action' => ['DTRController@edit', $dtr->id], 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off'])}}
		


		@if (Input::has('type') && Input::get('type') == 'bulk')
			
			@include('dtr.partials.bulk-edit')

		@else
			<script>
				var __dataToUse = [];
			</script>
		@endif


		@include('partials.errors')

		{{Form::close()}}



	</div>
@stop
