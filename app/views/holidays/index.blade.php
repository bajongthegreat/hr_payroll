@extends('layout.master')


@section('content')

<h2 class="page-header"> Holiday list</h2>


  <div class="search-container col-md-4 pull-right">

   {{ Form::open(['method' => 'GET', 'action' => 'HolidaysController@index'])}}
  <input class="form-control " name="src" placeholder="Search holiday..." id="search" ng-model="query">

  {{Form::close() }}
  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('HolidaysController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add Holiday</a>
   <a  href="{{ action('HolidaysController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>


  </div>
	
<?php 
use Carbon\Carbon;
$year= (Input::has('year')) ? Input::get('year') : Carbon::now()->year; ?>
  	<!--  Filter by year -->
	<div class="header-buttons 	"><span  class="col-md-2"> {{ Form::select('year', [ '2013' => '2013',
		  																			 '2014' => '2014',
		  																			 '2015' => '2015',
		  																			 '2016' => '2016',
		  																			 '2017' => '2017',
		  																			 '2018' => '2018'], $year , ['class' => 'form-control', 'id' => 'year']) }}</div>

<table class="table table-hover">
	<thead>
		<th width="15%">Name</th>
		<th width="15%">Type</th>
		<th width="15%">Date</th>
		<th></th>
		<th>Remarks</th>
	</thead>


	<tbody>
		@foreach($holidays as $holiday)
		<?php $holiday_date = new DateTime($holiday->holiday_date); ?>
			<tr >

				<td> {{ $holiday->name }}</td>
				<td>{{ ucfirst($holiday->type) }}</td>
				<td> {{ '<span data-toggle="tooltip" data-placement="top" title="' . $holiday->holiday_date . '" class="holiday_date">' . $holiday_date->format('F d') . '</span>' }}</td>
				<td>{{ '<span class="label label-info">' . $holiday_date->format('D') .'</span>' }}</td>
				<td>{{ $holiday->remarks }}</td>
			
				
			<td align="center"> <a href="{{ route('holidays.edit', $holiday->id) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
				<td align="center"><a href="#" data-id="{{ $holiday->id }}" data-url="{{ action('HolidaysController@destroy', $holiday->id)  }}" class="btn btn-default btn-sm _deleteItem"><span class="glyphicon glyphicon-remove"></span> Delete</a></td>
			
			</tr>

		@endforeach
	</tbody>
</table>

<?php $collection = $holidays; ?>
		@include('partials.pagination_links')

@stop

@section('scripts')
<script type="text/javascript">
	(function(){
			$('#year').on('change', function() {
				window.location = '?year=' + $(this).val();
			});

			$('.holiday_date').tooltip();
	})();
</script>
@stop