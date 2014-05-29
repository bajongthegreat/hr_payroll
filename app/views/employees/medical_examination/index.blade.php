@extends('layout.master')

@section('content')

<style type="text/css">

</style>
<h2 class="page-header"> Medical Examinations</h2>


<div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		  
		  	<div class="parent">
  <div class="child">
  		<a href="{{ action('MedicalEstablishmentsController@index') }}" class="btn btn-default"> <span class="glyphicon glyphicon-th	"></span> Manage Medical Establishments</a>
</div>

<div class="child">
  		<a href="{{ action('DiseasesController@index') }}" class="btn btn-default"> <span class="glyphicon glyphicon-dashboard"></span> Manage Known Diseases</a>
</div>
	
		</div>


		  </div>
</div>
		  	


  <div class="search-container col-md-4 pull-right">
   {{ Form::open(['action' => 'EmployeesMedicalExaminationsController@index', 'method' => 'GET']) }}
  <input class="form-control " name="src" placeholder="Search for medical records." id="search" ng-model="query" value="{{Input::get('src')}}">
 {{ Form::close() }}

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('EmployeesMedicalExaminationsController@create', 'add_type=bulk')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add Multiple records</a>
   <a  href="{{ action('EmployeesMedicalExaminationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>

  <table class="table table-hover">
	<thead>
		<th>Name</th>
		<th> Date conducted</th>
		<th> Medical Establishment </th>
		<th>Medical Findings</th>
		<th>Recommendation</th>
		<th>Remarks</th>
		<th></th>

	</thead>
	<tbody>

		@foreach($physical_examinations as $pe)
		
			<tr data-employee_id="{{ $pe->employee_work_id }}">
				<td> {{ $pe->lastname . ', ' .$pe->firstname . ' ' . ucfirst($pe->middlename[0]) . '.'}}</td>
				<td> {{ $pe->date_conducted }} </td>
				<td> {{ $pe->establishment }} </td>
				<td> {{ ($pe->medical_findings  == NULL) ? 'None' : $pe->medical_findings 	 }}</td>
				<td> {{ $pe->recommendations }} </td>
				<td> {{ ($pe->remarks != "") ? $pe->remarks : "N/A"}}</td>
			</tr>
		@endforeach

	</tbody>
</table>
	
		<?php $collection = $physical_examinations; ?>
		@include('partials.pagination_links')


@stop