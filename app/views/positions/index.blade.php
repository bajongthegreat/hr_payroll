@extends('layout.master')


@section('content')

<h2 class="page-header"> Position list</h2>

<div class="search-container col-md-4 pull-right">
  

   {{ Form::open(['method' => 'GET', 'action' => 'PositionsController@index'])}}
  <input class="form-control " name="src" placeholder="Search position..." id="search" ng-model="query" value="{{ Input::get('src') }}">
   {{ Form::close() }}
  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('PositionsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Position</a>
   <a  href="{{ action('PositionsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>


<table class="table table-hover">
	<thead>
		<th width="15%">ID</th>
		<th width="15%">Name</th>
		<th width="15%">Company</th>
		<th width="15%"> Department</th>
		<th width="50%"> Rate</th>
		<th></th>
	</thead>


	<tbody>

		
		@foreach($positions as $position)

		
			<tr >

				<td> {{ $position->id }}</td>
				<td> {{ $position->name }}</td>

				<td> {{ $position->company_name }}</td>
				
				<td>
					@if (isset($position->department->name))
						{{ ucfirst($position->department->name) }}
					@elseif (isset($position->department))
						{{ ucfirst($position->department) }}
					@endif
				</td>
				<td> {{ $position->rate* 8 . ' (' . $position->rate . ')' }}</td>

				<td align="center"> <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center">{{ Form::open(['action' => array('PositionsController@destroy', $position->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>

		@endforeach
	</tbody>
</table>


		<?php $collection = $positions; ?>
		@include('partials.pagination_links')


@stop