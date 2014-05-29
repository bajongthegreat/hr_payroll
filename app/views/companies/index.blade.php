@extends('layout.master')


@section('content')

<h2 class="page-header"> company list</h2>


  <div class="search-container col-md-4 pull-right">
   	 {{ Form::open(['method' => 'GET', 'action' => 'CompaniesController@index'])}}
		 <input class="form-control " name="src" placeholder="Search company..." id="search" ng-model="query" value="{{Input::get('src')}}">
	  {{ Form::close()}}
  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('CompaniesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new company</a>
   <a  href="{{ action('CompaniesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>


<table class="table table-hover">
	<thead>
		<th width="15%">ID</th>
		<th width="15%">Company</th>
		<th width="60%">Address</th>
		<th></th>
	</thead>


	<tbody>
		@foreach($companies as $company)
			<tr >

				<td> {{ $company->id }}</td>
				<td> {{ ucfirst($company->name) }}</td>
				<td> {{ ucfirst($company->address) }}</td>
				<td align="center"> <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center">{{ Form::open(['action' => array('CompaniesController@destroy', $company->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>

		@endforeach
	</tbody>
</table>


		<?php $collection = $companies; ?>
		@include('partials.pagination_links')

@stop