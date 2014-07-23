@extends('layout.master')
@section('content')
	

	<!-- Note: -->
	<!-- Can be filtered by month -->

	<h2 class="page-header"> Daily Time Record </h2>
	

	
	  <div class="search-container col-md-4 pull-right">
		{{ Form::open(['method' => 'GET'])}}	
	  <input class="form-control " name="src" placeholder="Search employee..." id="search" ng-model="query" value="{{{ Input::get('src') }}}">
	  <input type="hidden" name="group" value="{{{Input::get('group')}}}">
		{{ Form::close() }}
	  </div>
	
	  <div class="header-buttons pull-left">
	  <a href="{{ action('DTRController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new  Record</a>
	   <a  href="{{ action('DTRController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
			
	  </div>
	  <?php 
	  		$group = Input::has('group') ? Input::get('group') : 'grouped';
	  ?>
	    	<!--  Filter by year -->
	<div class="header-buttons 	"><span  class="col-md-2"> {{ Form::select('year', [ 'grouped' => 'Grouped',
		                                                                             'none' => 'Not grouped'], $group , ['class' => 'form-control', 'id' => 'group']) }}</div>


	  <table class="table table-hover">
	  	@if (Input::has('group') && Input::get('group') == 'none')
	  		<thead>
	  			<th>Employee ID</th>
	  			<th>Employee Name</th>
	  			<th>Date</th>
	  			<th>Shift</th>
	  			<th>Work Assignment</th>
	  			
	  		</thead>
	  		<tbody>
	  			@foreach ($daily_time_records as $dtr)
	  					<?php
	  						$date = new DateTime($dtr->work_date);
	  					 ?>
	  				<tr  >
	  					<td> {{ $dtr->employee_work_id}}</td>
	  					<td> {{ $dtr->lastname . ', ' . $dtr->firstname . ' ' . $dtr->middlename}}</td>
	  					<td> {{ $date->format('F d, Y') }}</td>
	  					<td> {{ ($dtr->shift == 'ns') ? '<span class="label label-info">Night Shift</span>' : '<span class="label label-warning">Day shift</span>' }} </td>
	  					<td> {{ $dtr->work_assignment }}</td>
	  					<td> <a href="{{ action('DTRController@edit', $dtr->id) }}?type=single"  class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
	  				</tr>
	  			@endforeach
	  		</tbody>
	  	@else
	  		<thead>
	  			<th width="10%"></th>
	  			<th>Date</th>
	  			<th>Shift</th>
	  			<th>Work Assignment</th>
	  			
	  		</thead>
	  		<tbody>
	  			@foreach ($daily_time_records as $dtr)
	  					<?php
	  						$date = new DateTime($dtr->work_date);
	  					 ?>
	  				<tr  >
	  					<td class="__more_violations_parent" data-status="closed"  data-work_date="{{ $dtr->work_date }}" data-shift="{{ $dtr->shift }}" data-work_assignment="{{ $dtr->work_assignment_id }}"> <span class="label label-default"><span class="glyphicon glyphicon-list"></span>  View all Included Employees</span></td>
	  					<td> {{ $date->format('F d, Y') }}</td>
	  					<td> {{ ($dtr->shift == 'ns') ? '<span class="label label-info">Night Shift</span>' : '<span class="label label-warning">Day shift</span>' }} </td>
	  					<td> {{ $dtr->name }}</td>
	  					<td> <a href="{{ action('DTRController@edit', $dtr->id) }}?shift={{$dtr->shift}}&work_date={{$dtr->work_date}}&work_assignment={{ $dtr->work_assignment_id }}&type=bulk"  class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
	  				</tr>
	  			@endforeach
	  		</tbody>
	  	@endif
	  </table>
	  	@if (Session::has('message'))
	  		<div class="alert alert-info text-center"> {{ Session::get('message') }}</div>
	  	@endif
	<?php $collection = $daily_time_records; ?>
		@include('partials.pagination_links')

@stop

@section('scripts')
<script type="text/javascript">

	$('#group').on('change', function() {
		window.location = '?group='+ $(this).val();
	});

	$('.__more_violations_parent').on('click', function(e) {
		
		var URI = '/payroll/dtr';
		var self = $(this);

		var work_date = self.data('work_date');
		var shift = self.data('shift');
		var work_assignment_id = self.data('work_assignment');

		if ($(this).data('status') == 'closed') {
			
			// Change status
			$(this).data('status', 'open');
 
			// Change the label
			$(this).html('<span class="label label-default"><span class="glyphicon glyphicon-resize-small"></span> Collapse</span>');

			console.log(work_assignment_id)
			$.ajax({
				type: 'GET',
				url: _globalObj._baseURL + URI,
				data: { jq_ax: 'dtr', 
				        work_date:work_date, 
				        shift: shift, 
				        work_assignment: work_assignment_id },
				success: function(data) {
					
					if (!data) return false;
					self.parent().parent().find('.__more_violations_child' + work_date + shift + work_assignment_id).fadeOut().remove();

					var tr_open_parent_from_original_table = '<tr class="__more_violations_child'+ work_date + shift + work_assignment_id + '">',
					    tr_close_parent_from_original_table = '</tr>',
					    tr_td_open_table_container = '<td colspan="7">',
					    tr_td_close_table_container = '</td>';

					var inner_table_open = '<table class="table">',
					    inner_table_close = '</table>';

					var inner_table_headers_open = '<thead>',
					    inner_table_headers_close = '</thead>';

					var inner_table_headers_child = ['Employee', 'Time IN AM','Time OUT AM','Time IN PM', 'Time OUT PM' , 'Hours worked' ,''],
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
						var overtime = "";
						var total = 0;
						var effectivity_date = "";
						$.each(data, function(key,value) {
							// console.log(data[key])
							inner_table_data_container += "<tr>";
			
								effectivity_date = (data[key].violation_effectivity_date == null) ? 'N/A' : data[key].violation_effectivity_date;
								total = calculateTotalHours(data[key].time_in_am, data[key].time_out_am, data[key].time_in_pm, data[key].time_out_pm, data[key].shift);
			
								if (total.overtime != 0) {
									overtime = '<span class="label label-info">' + total.overtime +' HR OT</span>';
								} else {
									overtime = "";
								}

								inner_table_data_container += "<td>" + data[key].lastname +  ', ' + data[key].firstname +"</td>";
								inner_table_data_container += "<td>" + data[key].time_in_am +"</td>";
								inner_table_data_container += "<td>" + data[key].time_out_am +"</td>";
								inner_table_data_container += "<td>" + data[key].time_in_pm +"</td>";
								inner_table_data_container += "<td>" + data[key].time_out_pm +"</td>";
								inner_table_data_container += "<td>" + total.total + "  " + overtime +"</td>";
								
								inner_table_data_container += '<td><a href="' + _globalObj._baseURL + URI + '/'  + data[key].id + '/edit" class="btn btn-default">Edit</a></td>';
								// inner_table_data_container += '<td><a href="#" data-id="' + data[key].id + '" data-url="' + _globalObj._baseURL + URI + '"/' + data[key].id +' class="btn btn-default _deleteItem">Edit</a></td>';
				
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
			self.html('<span class="label label-default"><span class="glyphicon glyphicon-list"></span> View all Included Employees</span>');
			self.parent().parent().find('.__more_violations_child' + work_date + shift + work_assignment_id).fadeOut().remove();

		}
	});


</script>
@stop