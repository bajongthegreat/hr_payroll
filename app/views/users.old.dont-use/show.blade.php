@extends('layout.master')



@section('content')

<h3 class="page-header">User account details</h3>

	<!-- Usage as a class -->
<div class="clearfix">&nbsp; </div>

<table class="table table-bordered">


		<tr>
			<td width="20%"><strong>User ID</strong> </td>
			<td>{{ $user->id}} </td>
		</tr>


		<tr>
			<td ><strong>Username</strong> </td>
			<td>{{ $user->username}} </td>
		</tr>


		<tr>
			<td ><strong>Email</strong> </td>
			<td> {{ $user->email }} </td>

	</tr>

	

</table>

<!-- Usage as a class -->
<div class="clearfix">&nbsp;</div>

<table class="table table-bordered">
	


	<tbody>
<tr>
			<td width="20%" ><strong>Date Created</strong> </td>
			<td> {{ $user->created_at }} </td>

	</tr>

	<tr>
			<td ><strong>Last Updated</strong> </td>
			<td> {{ $user->updated_at }} </td>

	</tr>

	
	</tbody>
</table>


<table class="table table-bordered">
	
<tr>
			<td width="20%" ><strong>Status</strong> </td>
			<td> {{ $user->status }} </td>

	</tr>

	

</table>


<div class="pull-right">
		 <a  href="{{ action('UsersController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-list"></span> Go to users list</a>
	</div>

	<div class="form-group">
 
      <a  href="{{ action('UsersController@edit', $user->id) }}" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span>  Edit this user</a>
    	
  </div>
	

@stop