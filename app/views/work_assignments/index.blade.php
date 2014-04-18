@extends('layout.master')


@section('content')

<h2 class="page-header"> Work Assignments</h2>

  <div class="header-buttons pull-left">
  <a href="{{ action('PositionsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Position</a>
   <a  href="{{ action('PositionsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>


<div class="search-container col-md-4 pull-right">

<input class="form-control " name="src" placeholder="Search Position...">
</div>


<table class="table table-hover">
	<thead>
		<th>ID</th>
		<th>Assignment</th>
	<!-- 	<th>Department</th>
		<th>Position</th> -->
		<th>Company</th>
		<th>Date Created</th>
	</thead>


	<tbody>

		
		@foreach($work_assignments as $work_assignment)

		
			<tr >

				<td> {{ $work_assignment->id }}</td>
				<td> {{ $work_assignment->assignment }}</td>
				<td> {{ $work_assignment->company_id }}</td>
				
				
				<td> {{ $work_assignment->created_at }}</td>

				
			</tr>

		@endforeach
	</tbody>
</table>


@stop