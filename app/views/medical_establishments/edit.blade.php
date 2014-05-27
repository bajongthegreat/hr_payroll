@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Edit Medical Establishment  <a  href="{{ action('MedicalEstablishmentsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

	
	<div class="container">
		
		{{Form::model($medical_establishment,['action' => ['MedicalEstablishmentsController@update', $medical_establishment->id], 'method' => 'PATCH' ,'class' => 'form-horizontal', 'role' => 'form'])}}
		
				
		<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title"><h4>Medical Establishment Information</h4></h3>
				  </div>
				  <div class="panel-body">

				  	<!--  Medical Establishment creation form -->
				  	@include('partials.medical_establishments.form')
				 
				 </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->


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
