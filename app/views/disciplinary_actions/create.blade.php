@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Add Employee Violation record  <a  href="{{ action('DisciplinaryActionsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
		@include('partials.employee_search_panel')

	<div class="container">
		
		{{Form::open(['action' => 'DisciplinaryActionsController@store', 'class' => 'form-horizontal', 'role' => 'form'])}}
		
				
		<div class="panel panel-default" id="dpc_information">
				  <div class="panel-heading">
				    <h3 class="panel-title"><h4>Violation Information</h4></h3>
				  </div>
				  <div class="panel-body">
				 
				  	<!--  Medical Establishment creation form -->
				  	@include('partials.disciplinary_actions.form')
				 	<input type="hidden" name="employee_work_id" class="hiddenWorkID" value="{{ Input::get('workid') }}">
				 	<input type="hidden" name="employee_id" class="hiddenID">
				 </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
		@if (Input::has('ref'))
		{{ Form::hidden('ref', Input::get('ref'))}}
		@endif

		@if (Session::has('message'))
		<div class="alert alert-info" id="alert"> {{ Session::get('message') }} </div>
		@endif
		<!-- Form Buttons -->
		<div class="container" id="buttons">
				<div class="form-group">
				 <div class="form-group pull-left">
			     	{{ Form::submit('Submit', array('class' => 'btn btn-primary ', 'id'=> 'processTableData')) }}
			      	 	<a href="?reset=true" class="btn btn-default" id="clear">Clear</a> 
			      	 <div id="submitload"></div>
			      </div>
			    
				</div>
				
				
			</div>


		<!-- Displays all errors found -->
		@include('partials.errors')

		{{Form::close()}}
	</div>
@stop

@section('scripts')
<script>
	           

		// Settings for Employee search
		
           	var __employee="";
           	var __panelsToToggle = ['#dpc_information', '#employee_information', '#buttons'];
           	var __fieldsToEmpty = [];
           	var __buttonsToHide = [];
           	var __dbFieldsToUse = [];
           	var is_create = true;


           	var __rowsToDisplay = 10;
           	var resultContainer = $('.resultContainer');
           	var hiddenID = $('.hiddenID');

           	
</script>
@stop

@section('later_scripts')
<script type="text/javascript" src="{{ asset('assets/js/hr_disciplinary_actions.js') }}"></script>

@stop