@extends('layout.master')


@section('content')


<div class="page-header"> <h2>Pag-ibig Contribution table</h2></div>

	<table class="table table-border">

		<thead>
			<th>ID</th>
			<th>Salary Start</th>
			<th>Salary End</th>
			<th>Employee Share</th>
			<th>Employer Share</th>
		</thead>

		<tbody>

			@foreach($hdmfs as $hdmf)

			<?php 
					if ($hdmf->id == 2) {
						$hdmf->salary_range_end = $hdmf->salary_range_start+1 . ' and above.';
					}
			?>
			<tr>
				<td> {{ $hdmf->id }} </td>
				<td> {{ $hdmf->salary_range_start }}</td>
				<td> {{ $hdmf->salary_range_end }}</td>
				<td> {{ $hdmf->employee_share*100 }}%</td>
				<td> {{ $hdmf->employer_share*100}}% </td>
			</tr>
			@endforeach

		</tbody>

	</table>

@stop