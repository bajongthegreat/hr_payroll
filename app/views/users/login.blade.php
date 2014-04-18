@extends('layout.login')

@section('content')

 {{ Form::open(array('action' => 'AuthController@login')) }}

        <h2 class="form-signin-heading">Please sign in</h2>
        
        <div class="form-group">
        <input name="user" type="text" class="form-control" placeholder="Email address"  value="{{Input::old('user') }}" autofocus>
        </div>

        <div class="form-group">
        <input name="password" type="password" class="form-control" placeholder="Password" >
        </div>

        <div class="form-group">
        <label class="checkbox">
          <input name="remember_me" type="checkbox" value="remember-me"> Remember me
        </label>

        </div>


        <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    	
    	</div>
      {{ Form::close() }}


@stop