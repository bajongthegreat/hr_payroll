@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Add Violation  <a  href="{{ action('ViolationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		{{Form::open(['action' => 'ViolationsController@store', 'class' => 'form-horizontal', 'role' => 'form'])}}
		
				
		<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title"><h4>Violation Information</h4></h3>
				  </div>
				  <div class="panel-body">

				  	<!--  Medical Establishment creation form -->
				  	@include('partials.violations.form')
				 
				 </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->

		@if (Input::has('ref'))
			{{ Form::hidden('ref', Input::get('ref')) }}
		@endif

		<!-- Form Buttons -->
		<div class="container" id="buttons">
				<div class="form-group">
				 <div class="form-group pull-left">
			     	{{ Form::submit('Submit', array('class' => 'btn btn-primary ', 'id'=> 'processTableData')) }}
			      	 {{ Form::reset('Clear', array('class' => 'btn btn-default', 'id' => 'clear')) }} 
			      	 <div id="submitload"></div>
			      </div>
			    
				</div>
				
				
			</div>


		<!-- Displays all errors found -->
		@include('partials.errors')

		{{Form::close()}}
	</div>
@stop
