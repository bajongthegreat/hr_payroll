@extends('layouts.scaffold')

@section('main')

<h1>Show StageProcess</h1>

<p>{{ link_to_route('stageProcesses.index', 'Return to all stageProcesses') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Stage_process</th>
				<th>Parent_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $stageProcess->stage_process }}}</td>
					<td>{{{ $stageProcess->parent_id }}}</td>
                    <td>{{ link_to_route('stageProcesses.edit', 'Edit', array($stageProcess->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('stageProcesses.destroy', $stageProcess->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
