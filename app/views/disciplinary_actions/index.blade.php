@extends('layout.master')
@section('content')
	

	<!-- Note: -->
	<!-- Can be filtered by month -->

	<h2 class="page-header"> Disciplinary Actions Monitoring </h2>
	

	
	  <div class="search-container col-md-4 pull-right">
	
	  <input class="form-control " name="src" placeholder="Search employee..." id="search" ng-model="query">
	
	  </div>
	
	  <div class="header-buttons pull-left">
	  <a href="{{ action('DisciplinaryActionsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new  Record</a>
	   <a  href="{{ action('DisciplinaryActionsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
	
	  </div>

<?php
	function wordifyWithSuffix($number) {
		$suffix = "";
		switch ($number) {
			case 1:
				$suffix = 'first';
				break;

			case 2:
				$suffix = 'second';
			break;

			case 3:
				$suffix = 'third';
				break;

			case 4:
				$suffix = "fourth";
				break;
			case 5:
				$suffix = 'fifth';
				break;
		}

		return $suffix;
	}
?>
	  <table class="table table-striped">
	  		<thead>
	  			<th>Employee Name</th>

	  			<th>Company</th>
	  			<th>Department</th>
	  			<th>Position </th>
	  			<th>Date of Violation</th>
	  			<th>Effective Suspension date</th>
	  			<th>Violation Code</th>
	  			<th>Penalty</th>

	  		</thead>

	  		<tbody>
	  			@foreach ($employee_violators as $violator)
	  				<tr>
	  					<?php $number_violated = $disciplinaryactions->getOffensesCount($violator->employee_id, $violator->violation_id); ?>
	  					
	  					<td> {{ $violator->lastname }}, {{ $violator->firstname }} {{ ucfirst($violator->middlename[0]) . '.'}}</td>
	  					<td>{{ $violator->company }}</td>
	  					<td> {{ $violator->department }}</td>
	  					<td> {{ $violator->position }}</td>
	  					<td> {{ $violator->violation_date }}</td>
	  					<td> {{ (is_null($violator->violation_effectivity_date)) ? 'N/A' : $violator->violation_effectivity_date }}</td>
	  					<td> {{ $violator->violation_code }}</td>

	  					<td> {{ $violations->find($violator->violation_id, 'id')->pluck(wordifyWithSuffix($number_violated) . '_offense') }}</td>
	  					
	  					<td> <a href="{{ action('DisciplinaryActionsController@edit', $violator->id) }}#employee={{ $violator->employee_work_id }}" class="btn btn-default"> <span class="glyphicon glyphicon-edit" ></span> Edit</a></td>
	  				</tr>
	  			@endforeach
	  		</tbody>
	  </table>
	

@stop


