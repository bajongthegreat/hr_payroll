@extends('layout.master')


@section('content')

<h2 class="page-header"> List of User roles</h2>

<div class="search-container col-md-4 pull-right">

  <input class="form-control " name="src" placeholder="Search an employee..." id="search" ng-model="query">

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('RolesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Role</a>
   <a  href="{{ action('RolesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>


<table class="table table-hover">
	<thead>
		<th width="15%">Role</th>
		<th></th>
	</thead>


	<tbody>

		
		@foreach($roles as $role)

		
			<tr >

				<td> {{ $role->name }}</td>
				<td align="center"> <a href="{{ action('RolesController@edit', $role->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center">{{ Form::open(['action' => array('RolesController@destroy', $role->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>

		@endforeach
	</tbody>
</table>


@stop