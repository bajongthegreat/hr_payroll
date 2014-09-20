@extends('layout.master')



	


@section('content')

<h3 class="page-header">
Users List
</h3>

<div class="search-container col-md-4 pull-right">

  {{ Form::open(array('action' => array('UsersController@index'), 'method' => 'GET' )) }}
		{{ Form::text('src',Input::old('src'),  array('class' => 'form-control', 'placeholder' => 'Search a user...')) }}
	{{ Form::close() }}

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('UsersController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Create new User</a>
   <a  href="{{ action('UsersController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>



<!-- Usage as a class -->
<div class="clearfix">&nbsp;</div>

<table class="table table-striped">
	<thead>
		@if (Request::get('sb') == 'username' && Request::get('sort') != 'desc')
		<th><a href="{{ action('UsersController@index', array('sb' => 'id', 'sort' => 'desc') ) }}">User ID</a></th>
		@else
		<th><a href="{{ action('UsersController@index', array('sb' => 'id') ) }}">User ID</a></th>
		@endif

		@if (Request::get('sb') == 'username' && Request::get('sort') != 'desc')
		<th><a href="{{ action('UsersController@index', array('sb' => 'username', 'sort' => 'desc') ) }}">Username</a></th>
		@else
		<th><a href="{{ action('UsersController@index', array('sb' => 'username') ) }}">Username</a></th>
		@endif

		

		<th><a href="{{ action('UsersController@index', array('sb' => 'email') ) }}">Email</a></th>
		<th><a href="{{ action('UsersController@index', array('sb' => 'created_at') ) }}">Date created</a></th>
		<th><a href="{{ action('UsersController@index', array('sb' => 'status') ) }}">Status</a></th>
	
	</thead>

	<tbody>
		

		
		@foreach($users as $user)
			<tr>
				<td>{{$user->id}}</td>
				<td><a href="{{ action('UsersController@show', $user->id) }}">{{$user->username}}</a></td>
				<td>{{$user->email}}</td>
				<td>{{$user->created_at}}</td>
				<td>{{$user->status}}</td>

				<td align="center"> <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center">{{ Form::open(['action' => array('UsersController@destroy', $user->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>
		@endforeach
	</tbody>

</table>

@if (count($users) == 0)
<div class="container">
	<div  align="center" class="alert alert-warning"> No users found.</div>
</div>
@endif

<?php
 echo $users->appends(array('src' => Request::get('src'),
                                 'limit' => Request::get('limit'),
                                 'sort' => Request::get('sort'),
                                  'sort_by' => Request::get('sort_by')))->links();
                                   ?>

@stop

