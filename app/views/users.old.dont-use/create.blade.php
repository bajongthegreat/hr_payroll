@extends('layout.master')




@section('content')

<h3 class="page-header">
Create user
</h3>

	{{ Form::open(array('action' => 'UsersController@store', 'class' => 'form-horizontal', 'role'=> 'form')) }}

	<div class="form-group">
		{{ Form::label('username', 'Username', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
		 </div>
	</div>

	<div class="form-group">
		{{ Form::label('email', 'Email', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
		 </div>
	</div>

	<div class="form-group">
		{{ Form::label('password', 'Password', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::password('password',  array('class' => 'form-control')) }}
		 </div>
	</div>

	<div class="form-group">
		{{ Form::label('password_confirmation', 'Confirm Password', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-10">
		{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
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
@stop