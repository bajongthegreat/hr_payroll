@extends('layout.master')


@section('content')
<div class="content-center">

<div class="page-header">
<h1>Add Requirement  <a  href="{{ action('RequirementsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container">

	{{ Form::open(['action' => 'RequirementsController@store', 'class' => 'form-horizontal', 'role' => 'form']) }}

	@include('requirements.form-partial');


	{{ Form::close() }}
	@include('partials.errors')
</div>


</div>
@stop

