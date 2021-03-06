@extends('layout.master')


@section('content')

<h2 class="page-header"> Department list</h2>


  <div class="search-container col-md-4 pull-right">

   {{ Form::open(['method' => 'GET', 'action' => 'DepartmentsController@index'])}}
  <input class="form-control " name="src" placeholder="Search department..." id="search" ng-model="query" value="{{ Input::get('src') }}">
 	{{ Form::close() }}

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('DepartmentsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Department</a>
   <a  href="{{ action('DepartmentsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>


<table class="table table-hover">
	<thead>
		<th width="10%">ID</th>
		<th width="30%">Department</th>
		<th width="30%">Company</th>
		<th width="25%">Status</th>
		<th width="10%"></th>
	</thead>


	<tbody>
		@foreach($departments as $department)
			<tr >

				<td> {{ $department->id }}</td>
				<td> {{ ucfirst($department->name) }}</td>

				 <td> <?php  
				 
				 		if (isset($department->company)) {
				 			echo isset($department->company) ? ucfirst($department->company) : "None";
				 		} else {
				 			echo isset($department->company->name) ? ucfirst($department->company->name) : "None";	
				 		}
						
				 ?></td>
				<td> <span class="label label-<?php echo ($department->status == 'active') ? 'success' : 'warning' ?>"> {{ ucfirst($department->status) }}</span></td>
			<td align="center"> <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center">{{ Form::open(['action' => array('DepartmentsController@destroy', $department->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>

		@endforeach
	</tbody>
</table>


		<?php $collection = $departments; ?>
		@include('partials.pagination_links')
@stop