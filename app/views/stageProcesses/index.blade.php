@extends('layout.master')

@section('content')
	

<div class="container">


  <h2 class="page-header"> Stage Process list</h2>


  <div class="search-container col-md-4 pull-right">

  	{{ Form::open(['method' => 'GET', 'action' => 'StageProcessesController@index'])}}
	  <input class="form-control " name="src" placeholder="Search stage process..." id="search" ng-model="query" value="{{ Input::get('src') }}">
	 {{ Form::close() }}
  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('StageProcessesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Create new Stage Process</a>
  <a  href="{{ action('StageProcessesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>

  <!-- Usage as a class -->
<div class="clearfix">&nbsp;</div>

<table class="table table-striped">
	<thead>
		<th>Stage Process</th>
		<th>Parent</th>
	</thead>

	<tbody>
		

		
		@foreach($cstage_processes as $stageprocess)
			<?php $parent = $spObj->find($stageprocess->parent_id)->pluck('stage_process'); ?>
			<tr>
				<td width="25%">{{$stageprocess->stage_process}}</td>
				<td width="25%">{{ $parent or 'No parent' }}</td>

				<td align="center" width="2%"> <a href="{{ route('stageprocesses.edit', $stageprocess->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center" width="5%">{{ Form::open(['action' => array('StageProcessesController@destroy', $stageprocess->id), 'method' => 'DELETE']) }} <button  type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</button></form></td>
			
			</tr>
		@endforeach
	</tbody>

</table>

@if (count($cstage_processes) == 0)
<div class="container">
	<div  align="center" class="alert alert-warning"> No Stage Process found.</div>
</div>
@endif


		<?php $collection = $cstage_processes; ?>
		@include('partials.pagination_links')

</div>