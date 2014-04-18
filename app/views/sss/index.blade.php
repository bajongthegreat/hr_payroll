@extends('layout.master')


@section('content')


<div class="page-header"> <h2>SSS Contribution table</h2></div>

	<table class="table table-border">

		<thead>
			<th>ID</th>
			<th>Salary Start</th>
			<th>Salary End</th>
			<th>Employee Share</th>
			<th>Employer Share</th>
		</thead>

		<tbody>

			@foreach($sss_c as $sss)
			<tr>
				<td> {{ $sss->id }} </td>
				<td> {{ $sss->salary_range_start }}</td>
				<td> {{ $sss->salary_range_end }}</td>
				<td> {{ $sss->employee_share }}</td>
				<td> {{ $sss->employer_share}} </td>
			</tr>
			@endforeach

		</tbody>

	</table>

@stop