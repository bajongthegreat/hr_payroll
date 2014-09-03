@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Daily Time Record - Edit Record  <a  href="{{ action('DTRController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		


		@if (Input::has('type') && Input::get('type') == 'bulk')
			{{Form::open(['action' => ['DTRController@edit', $dtr->id], 'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off'])}}
			
			@include('dtr.partials.bulk-edit')

		@else
			{{Form::model($dtr, ['action' => ['DTRController@update', $dtr->id], 'method' => 'PUT',  'class' => 'form-horizontal', 'role' => 'form', 'autocomplete' => 'off'])}}
		
			@include('dtr.partials.single')
		@endif


		@include('partials.errors')

		{{Form::close()}}



	</div>
@stop
