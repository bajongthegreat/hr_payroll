@extends('layout.master')


@section('content')


<div class="page-header"> <h2>Philhealth Contribution table</h2></div>

	<table class="table table-border">

		<thead>
			<th>ID</th>
			<th>Salary Start</th>
			<th>Salary End</th>
			<th>Employee Share</th>
			<th>Employer Share</th>
		</thead>

		<tbody>

			@foreach($philh as $ph)

			<?php if ($ph->id == 28) {
					$ph->salary_range_end = $ph->salary_range_start+1 . ' and up.';
				} 
			?>
			<tr>
				<td> {{ $ph->id }} </td>
				<td> {{ $ph->salary_range_start }}</td>
				<td> {{ $ph->salary_range_end }}</td>
				<td> {{ $ph->employee_share }}</td>
				<td> {{ $ph->employer_share}} </td>
			</tr>
			@endforeach

		</tbody>

	</table>

@stop