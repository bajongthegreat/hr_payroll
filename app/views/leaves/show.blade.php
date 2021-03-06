@extends('layout.master')

<?php 
	$leave = $leave[0];
?>

@section('content')

<div class="page-header">
<h1>Leave Information <a  href="{{ action('LeavesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a> <span class="pull-right edit-button"> <a  href="{{ action('LeavesController@edit', $leave->id) }}#employee={{ $leave->employee->employee_work_id }}" class="btn btn-default "><span class="glyphicon glyphicon-edit"></span >  Edit Leave Information</a> </span>
</h1>


</div>


<div class="container">

	<div class="panel panel-default" id="employee_information">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Employee Information</h4></h3>
		  </div>
		  <div class="panel-body">

		  	<div class="row">
	<div class="col-sm-2"> <label>Name: </label></div>
	<div class="col-sm-4">  {{ $leave->employee->firstname . ' ' . $leave->employee->middlename . ' ' . $leave->employee->lastname  }}</div>
</div>

<div class="row">
	<div class="col-sm-2"> <label>Date Hired: </label></div>
	<div class="col-sm-4"> {{ $leave->employee->date_hired }}</div>
</div>

<div class="row">
		<div class="col-sm-2"> <label>Status: </label></div>
	<div class="col-sm-4"> {{ $helper->getStatus($leave->status, true) }}</div>

</div>


<div id="approvalInfo-container">
	{{ Form::open(['action' => 'LeavesController@approve']) }}
		{{ $helper->approveButton($leave->status, $leave->id, NULL)  }}
	{{ Form::close() }}


	
</div>

<div id="rejectInfo-container">
	{{ Form::open(['action' => 'LeavesController@reject']) }}
		{{ $helper->rejectButton($leave->status, $leave->id, NULL ) }}
	{{ Form::close() }}
</div>




		  </div> <!-- End of Panel Body -->
	</div>  <!-- End of Panel -->




<table class="table table-striped" style="margin-top: 25px;">

<thead>
	<th width="35%">Nature of Leave</th>
	<th width="20%">From</th>
	<th width="20%">To</th>
	<th width="40%">Number of Days</th>
</thead>

<tbody>
	<td>{{  $helper->getLeaveType($leave->type) }}</td>
	<td>{{	$leave->start_date	}}</td>
	<td>{{	$leave->end_date	}}</td>
	<td> {{ $helper->dateDiff($leave->start_date, $leave->end_date, 'days') }}</td>
</tbody>

</table>


<div class="reason">
	<div class="header">Reason</div>
	<div class="body"> {{  $leave->reason }}</div>
</div>

</div>


@stop