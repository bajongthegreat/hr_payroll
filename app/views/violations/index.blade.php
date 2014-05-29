@extends('layout.master')
@section('content')
	
		<h2 class="page-header"> Violations list</h2>
		
		
		  <div class="search-container col-md-4 pull-right">
			{{ Form::open(['action' => 'ViolationsController@index', 'method' => 'GET']) }}		
		  <input class="form-control " name="src" placeholder="Search violation..." id="search" ng-model="query" value="{{ Input::get('src') }}">
			{{ Form::close() }}
		  </div>
		
		  <div class="header-buttons pull-left">
		  <a href="{{ action('ViolationsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Violation</a>
		   <a  href="{{ action('ViolationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
		
		  </div>

		  <table class="table table-striped">
		  	<thead>
		  		<th class="text-center">Violation Code</th>
		  		<th class="text-center" width="40%">Violation Description</th>
		  		<th class="text-center">Penalty</th>
		  	</thead>

		  	<tbody>
		  		@foreach($violations as $violation)
		  			<tr>
		  				<td class="text-center">  {{$violation->code}} </td>
		  				<td> {{$violation->description}} </td>
		  				<td class="text-center"> {{$violation->penalty}} </td>
		  				<td> <a href=" {{ action('ViolationsController@edit', $violation->id) }}" class="btn btn-default"> <span class="glyphicon glyphicon-edit"></span> Edit</a> </td>
		  			</tr>
		  		@endforeach
		  	</tbody>
		  </table>
		<?php $collection = $violations; ?>
		@include('partials.pagination_links')
@stop

