@extends('layout.master')

@section('content')
	

<div class="container">


  <h2 class="page-header"> Required Documents list</h2>


  <div class="search-container col-md-4 pull-right">

  <input class="form-control " name="src" placeholder="Search stage process..." id="search" ng-model="query">

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('RequirementsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Requirement</a>
  <a  href="{{ action('RequirementsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>

  <!-- Usage as a class -->
<div class="clearfix">&nbsp;</div>

<table class="table table-striped">
	<thead>
		<th>Requirement</th>
		<th>Document type</th>
		<th>Stage Process</th>
	</thead>

	<tbody>
		

		
		@foreach($requirements as $requirement)
		
			<tr>
				<td width="25%">{{$requirement->document}}</td>
				<td width="25%">{{$requirement->document_type}}</td>
				<td width="25%">{{$requirement->stage_process_id}}</td>

				<td align="center" width="2%"> <a href="{{ route('requirements.edit', $requirement->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center" width="5%">{{ Form::open(['action' => array('RequirementsController@destroy', $requirement->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>
		@endforeach
	</tbody>

</table>

@if (count($requirements) == 0)
<div class="container">
	<div  align="center" class="alert alert-warning"> No Requirements found.</div>
</div>
@endif

</div>