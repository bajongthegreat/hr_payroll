@extends('layout.master')


@section('content')


<div class="content-center">
<div class="page-header">
<h1>Edit Role  <a  href="{{ action('RolesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container">

	{{ Form::model($role, ['action' => ['RolesController@update', $role->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'role' => 'form']) }}

	<div class="row">
			
			


				<div class="form-group">
						
				{{ Form::label('name', 'Role: ', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'id' => 'name','required') ) }}
					</div>

					
				
				</div>

				<div class="form-group">

				 <div class="col-sm-7">
				 	<hr>	<!-- Seperator -->
				 </div>
			</div> 

				<div class="form-group">
						
				{{ Form::label('name', 'Accessible URI: ', array('class' => 'col-sm-2')) }}

					<div class="col-sm-2">
						{{ Form::text(NULL,NULL, array('class' => 'form-control', 'id' => 'uri') ) }}
					</div>

					<div class="col-sm-3 center-text-vertical">
						<span class="label label-danger form-field-error" ></span>
					</div>
				
				</div>

					<div class="form-group">
						
				{{ Form::label('name', 'Action Permitted: ', array('class' => 'col-sm-2', 'id' => '__act_permission')) }}

					<div class="col-sm-4">
						<div class="btn-group" data-toggle="buttons">

							 <label class="btn btn-default _checkboxButton">
						        <input type="checkbox" name="permitted_actions"  class="chkbox" data-value="view">
						    View </label>

						    <label class="btn btn-default _checkboxButton">
						        <input type="checkbox" name="permitted_actions" class="chkbox"   data-value="create">
						    Create </label>

						    <label class="btn btn-default _checkboxButton">
						        <input type="checkbox" name="permitted_actions" class="chkbox"  data-value="edit">
						    Edit </label>

						    <label class="btn btn-default _checkboxButton">
						        <input type="checkbox" name="permitted_actions" class="chkbox"  data-value="delete">
						    Delete </label>

						    <hr><span class="label label-danger form-field-error bottom" ></span>
						</div>

						
					</div>
		
					</div>

						
				</div>

				<input type="hidden" name="rolesData" id="formHiddenData" value='{{ $permissions or Input::old('rolesData') }}'>
				<input type="hidden" name="deletedURI" id="__deletedURI" >

					<div class="form-group">
						
				{{ Form::label('Add', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     		<div>{{ Form::button('Add URI', array('class' => 'btn btn-primary', 'id' => '_roles_add_uri')) }}</div>
			</div>
	      </div>
	        <div class="form-group">

				 <div class="col-sm-7">
				 	<hr>	<!-- Seperator -->
				 </div>
			</div> 

			<div class="addedURIContainer"></div>

	      <div class="form-group">

				 <div class="col-sm-7">
				 	<hr>	<!-- Seperator -->
				 </div>
			</div> 

		<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     		<div>{{ Form::submit('Submit to add new Role', array('class' => 'btn btn-success')) }}</div>
			</div>
	      </div>

		
				
		

	</div>


	{{ Form::close() }}
@include('partials.errors')
</div>

</div>



@stop


@section('scripts')
	<script type="text/javascript">

	var oldURIdata = '{{ $permissions or Input::old('rolesData')}}'; 
	


			
	</script>
@stop


 @section('later_scripts')
<script src="{{ asset('jquery/hr_settings_role.js') }}"></script>
 @stop 
   