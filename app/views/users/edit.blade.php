@extends('layout.master')

@section('content')

<div class="content-center">

<h3 class="page-header">
	Update {{ $user->username}}'s Information 
</h3>

	{{ Form::model($user, ['method' => 'patch', 'route' => ['users.update', $user->id], 'class' => 'form-horizontal', 'role'=> 'form' ]) }}

	<div class="form-group">
		{{ Form::label('id', 'ID', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::text('id', NULL, array('class' => 'form-control', 'disabled')) }}
		 </div>
	</div>

	<div class="form-group">
		{{ Form::label('username', 'Username', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::text('username', NULL, array('class' => 'form-control', 'disabled')) }}
		 </div>
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::text('email', NULL, array('class' => 'form-control')) }}
		 </div>
	</div>
	


	<!-- Usage as a class -->
<div class="clearfix">&nbsp;</div>

	<div class="form-group">
		{{ Form::label('password', 'New Password', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'New Password')) }}
		 </div>
	</div>

	<div class="form-group">
		{{ Form::label('password_confirmation', 'Confirm Password', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::password('password_confirmation',  array('class' => 'form-control', 'placeholder' => 'Re-type your new password.')) }}
		 </div>
	</div>


		<!-- Usage as a class -->
<div class="clearfix">&nbsp;</div>

		<div class="form-group">
		{{ Form::label('status', 'Change Status', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::select('status', array('Active' => "Active", 'Disabled' => 'Disabled', 'Suspended'=> 'Suspended') ,  NULL, array('class' => 'form-control', 'placeholder' => 'Re-type your new password.')) }}
		 </div>
	</div>

	<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-default">Reset</button>
    </div>
  </div>

  @include('partials.errors')

</form>

</div>
@stop