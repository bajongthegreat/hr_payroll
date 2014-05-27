@extends('layout.master')
@section('content')
	
	
	<h2 class="page-header"> Medical Establishments list</h2>
	

	
	  <div class="search-container col-md-4 pull-right">
	
	  <input class="form-control " name="src" placeholder="Search medical establishments..." id="search" ng-model="query">
	
	  </div>
	
	  <div class="header-buttons pull-left">
	  <a href="{{ action('MedicalEstablishmentsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Medical Establishment</a>
	   <a  href="{{ action('MedicalEstablishmentsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
	
	  </div>

	  <table class="table table-striped">

	  	<thead>
	  		<th>ID</th>
	  		<th>Name</th>
	  		<th>Telephone</th>
	  		<th>Email</th>
	  	</thead>

	  	<tbody>
	  		@foreach($medical_establishments as $medical_establishment)

	  		<tr>
	  			<td> {{ $medical_establishment->id }} </td>
	  			<td>{{ $medical_establishment->name }}</td>
	  			<td> {{ ($medical_establishment->telephone_number == '') ? 'N/A' : $medical_establishment->telephone_number }} </td>
	  			<td> {{ ($medical_establishment->email == '') ? 'N/A' : $medical_establishment->email }} </td>
	  			<td><a href="{{ action('MedicalEstablishmentsController@edit', $medical_establishment->id) }}"><span class="label label-default">Edit</span></a> <a href="#" data-id="{{ $medical_establishment->id }}" data-url="{{ action('MedicalEstablishmentsController@destroy', $medical_establishment->id)  }}" class="label label-default btn-sm _deleteItem"><span class="glyphicon glyphicon-remove"></span> Delete</a></td>
	
	  		</tr>

	  		@endforeach
	  	</tbody>

	  </table>
		

		<!-- Displays all errors found -->
		@include('partials.errors')
@stop


