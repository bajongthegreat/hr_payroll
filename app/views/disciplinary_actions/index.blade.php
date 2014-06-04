@extends('layout.master')
@section('content')
	

	<!-- Note: -->
	<!-- Can be filtered by month -->

	<h2 class="page-header"> Disciplinary Actions Monitoring </h2>
	

	
	  <div class="search-container col-md-4 pull-right">
		{{ Form::open(['method' => 'GET'])}}	
	  <input class="form-control " name="src" placeholder="Search employee..." id="search" ng-model="query">
		{{ Form::close() }}
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

<style type="text/css">
.__more_violations_parent {
	cursor: pointer;
}
</style>
	  <table class="table table-hover">
	  		<thead>
	  			<th></th>
	  			<th>Employee Name</th>

	  			<th>Company</th>
	  			<th>Department</th>
	  			<th>Position </th>
	  			<th>Violation Code</th>
	  			<th>Penalty</th>

	  		</thead>
	  		<tbody>
	  			@foreach ($employee_violators as $violator)
	  				
	  				<tr  >
	  					<td class="__more_violations_parent" data-status="closed" data-employee_id="{{ $violator->employee_id}}" data-violation_id="{{ $violator->violation_id }}"> <span class="label label-default"><span class="glyphicon glyphicon-list"></span>  View all</span></td>
	  					<?php $number_violated = $disciplinaryactions->getOffensesCount($violator->employee_id, $violator->violation_id); ?>
	  					

	  					<td><a class="label label-info" href="{{ action('EmployeesController@show', $violator->employee_work_id) }}?v=violations"> {{ $violator->lastname or ''}}, {{ $violator->firstname or '' }} {{ (isset($violator->middlename[0])) ? ucfirst($violator->middlename) . '.'  : '' }} </a></td>
	  					<td>{{ $violator->company }}</td>
	  					<td> {{ $violator->department or '<span class="label label-default">Not specified</span>' }}</td>
	  					<td> {{ $violator->position or '<span class="label label-default">Not specified</span>'}}</td>
	  					<td> <span class="label label-warning">{{ $violator->violation_code }}</span></td>

	  					<td> <span class="label label-warning"> {{ $violations->find($violator->violation_id, 'id')->pluck(wordifyWithSuffix($number_violated) . '_offense') }} ({{$number_violated}})</span></td>
	  					
	  				</tr>
	  			@endforeach
	  		</tbody>
	  </table>
	

@stop

@section('scripts')
<script type="text/javascript">
	$('.__more_violations_parent').on('click', function(e) {
		var URI = '/employees/disciplinary_actions';
		var self = $(this);

		var employee_id = self.data('employee_id'),
		    violation_id = self.data('violation_id');

		if ($(this).data('status') == 'closed') {
			
			// Change status
			$(this).data('status', 'open');
 
			// Change the label
			$(this).html('<span class="label label-default"><span class="glyphicon glyphicon-resize-small"></span> Collapse</span>');

			$.ajax({
				type: 'GET',
				url: _globalObj._baseURL + URI,
				data: { jq_ax: 'employee_violations', employee_id: employee_id, violation_id: violation_id },
				success: function(data) {
					
					if (!data) return false;
					self.parent().parent().find('.__more_violations_child' + employee_id + violation_id).fadeOut().remove();

					var tr_open_parent_from_original_table = '<tr class="__more_violations_child'+ employee_id + violation_id +'">',
					    tr_close_parent_from_original_table = '</tr>',
					    tr_td_open_table_container = '<td colspan="7">',
					    tr_td_close_table_container = '</td>';

					var inner_table_open = '<table class="table">',
					    inner_table_close = '</table>';

					var inner_table_headers_open = '<thead>',
					    inner_table_headers_close = '</thead>';

					var inner_table_headers_child = ['Date Violated', 'Effectivity Date', ''],
					   inner_table_headers_container = "";

					var inner_table_tbody_open = '<tbody>',
					    inner_table_tbody_close = '</tbody>';

					 var inner_table_data_container = "";

					// Fill inner table header container
					for (var i = 0; i <= inner_table_headers_child.length - 1; i++) {
						inner_table_headers_container += '<th>' + inner_table_headers_child[i] + '</th>';
					};

					if (data.length == 0) {}
					else {
						
						var effectivity_date = "";
						$.each(data, function(key,value) {
							console.log(data[key])
							inner_table_data_container += "<tr>";
								effectivity_date = (data[key].violation_effectivity_date == null) ? 'N/A' : data[key].violation_effectivity_date;
								inner_table_data_container += "<td>" + data[key].violation_date +"</td>";
								inner_table_data_container += "<td>" + effectivity_date +"</td>";
								inner_table_data_container += '<td><a href="' + _globalObj._baseURL + URI + '/'  + data[key].id + '/edit#employee=' + data[key].employee_work_id + '" class="btn btn-default">Edit</a></td>';
								// inner_table_data_container += '<td><a href="#" data-employee_id="' + data[key].id + '" data-url="' + _globalObj._baseURL + URI + '"/' + data[key].id +' class="btn btn-default _deleteItem">Edit</a></td>';
				
							inner_table_data_container += "</tr>";
						});
						

						var mynewChild = tr_open_parent_from_original_table + tr_td_open_table_container + '<div class="well">' + inner_table_open +
						inner_table_headers_open + inner_table_headers_container +inner_table_headers_close +  inner_table_tbody_open + inner_table_data_container+ inner_table_tbody_close+inner_table_close +'</div>' + tr_td_close_table_container + tr_close_parent_from_original_table;
						
						self.parent().last().after('' + mynewChild);	

					}



				}
			});
			
			// Append the data
			
		} else {
			self.data('status', 'closed');
			self.html('<span class="label label-default"><span class="glyphicon glyphicon-list"></span> View all</span>');
			self.parent().parent().find('.__more_violations_child' + employee_id + violation_id).fadeOut().remove();
		}
	});


</script>
@stop