@extends('layout.master')


@section('content')

<!-- Note: -->
	<!-- Can be filtered by month -->
	<h2 class="page-header">Payroll History</h2>
	

	
	  <div class="search-container col-md-4 pull-right">
		{{ Form::open(['method' => 'GET'])}}	
	  <input class="form-control " name="src" placeholder="Search rate..." id="search" ng-model="query">
		{{ Form::close() }}
	  </div>
	
	  <div class="header-buttons pull-left">
	  <a href="{{ action('PayrollController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new  Record</a>
	   <a  href="{{ action('PayrollController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
			
	  </div>


	<?php 
		$payroll_link = action('PayrollController@index');
	?>
	 
	  <table class="table table-hover">
	  	<thead>
	  		<th width="15%">Date generated</th>
	  		<th width="45%">Pay period</th>
	  		<th>Employees included</th>
	  	</thead>
		
		<tbody>

			@foreach($payroll as $key => $value)
				<tr>
					<td>{{ $value->date }}</td>
					<td>{{ $value->pay_period_start }} To {{ $value->pay_period_end }}</td>
					<td>{{ $value->count }}</td>

					<?php 
						$__start = str_replace('-', '_', $value->pay_period_start);
						$__end = str_replace('-', '_', $value->pay_period_end);

						$filename = 'payroll_for_' . $__start . '_to_' . $__end . '.json';
					?>
					<td> <a class="label label-info" href='{{ $payroll_link }}/detailed_view?file="{{ asset("json/") . "/" . $filename }}"&start={{ $value->pay_period_start }}&end={{ $value->pay_period_end }} '>View</a> </td>
				</tr>
			@endforeach
			


		</tbody>
	  </table>
	
@stop


