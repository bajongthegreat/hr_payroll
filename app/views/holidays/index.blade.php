@extends('layout.master')


@section('content')

<h2 class="page-header"> Holiday list</h2>


  <div class="search-container col-md-4 pull-right">

  <input class="form-control " name="src" placeholder="Search holiday..." id="search" ng-model="query">


  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('HolidaysController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add Holiday</a>
   <a  href="{{ action('HolidaysController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>


  </div>
	

  	<!--  Filter by year -->
	<div class="header-buttons 	"><span  class="col-md-2"> <select class="form-control"><option>2014</option> </select> </span></div>

<table class="table table-hover">
	<thead>
		<th>Name</th>
		<th>Type</th>
		<th>Date</th>
		<th>Remarks</th>
	</thead>


	<tbody>
		@foreach($holidays as $holiday)
			<tr >

				<td> {{ $holiday->name }}</td>
				<td>{{ ucfirst($holiday->type) }}</td>
				<td> {{ ucfirst($holiday->holiday_date) }}</td>
				<td>{{ $holiday->remarks }}</td>
			
				
			<td align="center"> <a href="{{ route('holidays.edit', $holiday->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center">{{ Form::open(['action' => array('HolidaysController@destroy', $holiday->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>

		@endforeach
	</tbody>
</table>

@stop