@extends('layout.master')


@section('content')

{{ var_dump(Session::all()) }}

<div class="content-center">

<div class="page-header">
<h1>Add Role  <a  href="{{ action('RolesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container">

	{{ Form::open(['action' => 'RolesController@store', 'class' => 'form-horizontal', 'role' => 'form']) }}

	<div class="row">
			
			


				<div class="form-group">
						
				{{ Form::label('name', 'Role: ', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'id' => 'name') ) }}
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
				
				</div>

					<div class="form-group">
						
				{{ Form::label('name', 'Action Permitted: ', array('class' => 'col-sm-2')) }}

					<div class="col-sm-4">
						<div class="btn-group" data-toggle="buttons">

							 <label class="btn btn-default checkboxButton">
						        <input type="checkbox" name="permitted_actions"  class="chkbox" data-value="view">
						    View </label>

						    <label class="btn btn-default checkboxButton">
						        <input type="checkbox" name="permitted_actions" class="chkbox"   data-value="create">
						    Create </label>

						    <label class="btn btn-default checkboxButton">
						        <input type="checkbox" name="permitted_actions" class="chkbox"  data-value="edit">
						    Edit </label>

						    <label class="btn btn-default checkboxButton">
						        <input type="checkbox" name="permitted_actions" class="chkbox"  data-value="delete">
						    Delete </label>
						</div>
					</div>

						
				</div>

				<input type="hidden" name="rolesData" id="formHiddenData" value='{{ Input::old('rolesData') }}'>


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

</div>
@include('partials.errors')
</div>



@stop


@section('scripts')
	<script type="text/javascript">


	var accumulatedURIPermission = {};

		$('.checkboxButton').on('click', function() {
				var currentValue = $(this).html();
				var chkVal = $(this).find('.chkbox').val();

				if ($(this).find('span').length >= 1) {
					$(this).children("span").remove();
				} else {
					$(this).html(currentValue + '  <span class="glyphicon glyphicon-ok"></span>');
				}
					
			})

		
		// Remove JSON object when a close button in alert is clicked
		$(document).on('click', '.remove-uri' ,function() {
			var removeURI = $(this).parent().find('span').data('uri')
			delete accumulatedURIPermission[removeURI];
		});

		$('#_roles_add_uri').on('click', function(e) {

			var allowedActions = [];
			var allowedURI = $('#uri').val();
			var collection = {};

			if ( accumulatedURIPermission.hasOwnProperty(allowedURI) || allowedURI == '' ) {
				$('#uri').closest('div[class^="form-group"]').addClass('has-warning').focus();
				return false;
			} else {
				$('#uri').closest('div[class^="form-group"]').removeClass('has-warning');
			}


			$('.chkbox:checked').each(function(key,val) {
				allowedActions.push($(this).data('value'));
			});

			
			accumulatedURIPermission[allowedURI] = allowedActions;

			// Alert content
			text = '<span data-uri="' + allowedURI +'"> <strong>' + allowedURI + '</strong></span>' + '  -  ' + allowedActions.join(',');
			
			// Alert container
			var container= '<div class="alert alert-warning alert-dismissable">' +  '<button type="button" class="close remove-uri" data-dismiss="alert" aria-hidden="true">&times;</button>' + text +'</div>';

			// Append the alert into div
			$('.addedURIContainer').append('<div class="col-sm-7">' + container +'</div>');



			$('#formHiddenData').val(JSON.stringify(accumulatedURIPermission));
		});

		

			
	</script>
@stop