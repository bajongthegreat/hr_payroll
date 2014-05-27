@extends('layout.master')
@section('content')
	
		<h2 class="page-header"> List of Diseases</h2>


			
			  <div class="search-container col-md-4 pull-right">
			
			  <input class="form-control " name="src" placeholder="Search disease..." id="search" ng-model="query">
			
			  </div>
			
			  <div class="header-buttons pull-left">
			  <a href="{{ action('DiseasesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Disease</a>
			   <a  href="{{ action('DiseasesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
			
			  </div>
			


		<table class="table table-striped">
			<thead>
				<th>Disease Name</th>
			</thead>

			<tbody>
				@foreach($diseases as $disease)
					<tr>
						<td>{{ $disease->name }}</td>

						<td><td><a href="{{ action('DiseasesController@edit', $disease->id) }}"><span class="label label-default">Edit</span></a> <a href="#" data-id="{{ $disease->id }}" data-url="{{ action('DiseasesController@destroy', $disease->id)  }}" class="label label-default btn-sm _deleteItem"><span class="glyphicon glyphicon-remove"></span> Delete</a></td>
	</td>
					</tr>
				@endforeach
			</tbody>
		</table>			

@stop


