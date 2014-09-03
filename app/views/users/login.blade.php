@extends('layout.login')

@section('content')

<div class="well form-signin">
 {{ Form::open(array('action' => 'AuthController@login', 'role' => 'form')) }}

        <h2 class="form-signin-heading">Please sign in</h2>
        <hr>
        
        <div class="form-group">
        <input name="user" type="text" class="form-control" placeholder="Username or Email"  value="{{Input::old('user') }}" autofocus>
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

          @include ('partials.errors')

          <div class="center"> <span class="company-name">{{  Config::get('company.name.acro') != "" ? Config::get('company.name.acro') : ""}}</span> HR and Payroll System &copy2014 </div>
</div>
@stop