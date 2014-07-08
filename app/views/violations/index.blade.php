@extends('layout.master')
@section('content')
	
		<h2 class="page-header"> Violations list</h2>
		
		
		  <div class="search-container col-md-4 pull-right">
			{{ Form::open(['action' => 'ViolationsController@index', 'method' => 'GET']) }}		
		  <input class="form-control " name="src" placeholder="Search violation..." id="search" ng-model="query" value="{{ Input::get('src') }}">
			{{ Form::close() }}
		  </div>
		
		  <div class="header-buttons pull-left">
		  <a href="{{ action('ViolationsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new Violation</a>
		   <a  href="{{ action('ViolationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
		
		  </div>

		  <table class="table table-striped">
		  	<thead>
		  		<th width="100px"></th>
		  		<th class="text-center" width="15%">Violation Code</th>
		  		<th class="text-center" width="70%">Violation Description</th>



		  	</thead>

		  	<tbody>
		  		@foreach($violations as $violation)
		  			<tr>
		  				<td class="__more_violations_parent" data-status="closed"  data-violation_id="{{ $violation->id }}"> <span class="label label-default"><span class="glyphicon glyphicon-list"></span>  View all</span></td>
	  					
		  				<td class="text-center">  {{$violation->code}} </td>
		  				<td> {{html_entity_decode($violation->description) }} </td>
		  				<td> <a href=" {{ action('ViolationsController@edit', $violation->id) }}" class="btn btn-default"> <span class="glyphicon glyphicon-edit"></span> Edit</a> </td>
		  			</tr>
		  		@endforeach
		  	</tbody>
		  </table>
		<?php $collection = $violations; ?>
		@include('partials.pagination_links')
@stop



@section('scripts')
<script type="text/javascript">
	$('.__more_violations_parent').on('click', function(e) {
		var URI = '/violations';
		var self = $(this);

		var violation_id = self.data('violation_id');

		if ($(this).data('status') == 'closed') {
			
			// Change status
			$(this).data('status', 'open');
 
			// Change the label
			$(this).html('<span class="label label-default"><span class="glyphicon glyphicon-resize-small"></span> Collapse</span>');

			$.ajax({
				type: 'GET',
				url: _globalObj._baseURL + URI,
				data: { jq_ax: 'offense',  id: violation_id },
				success: function(data) {
					
					if (!data) return false;
					self.parent().parent().find('.__more_violations_child' + violation_id).fadeOut().remove();

					var tr_open_parent_from_original_table = '<tr class="__more_violations_child' + violation_id +'">',
					    tr_close_parent_from_original_table = '</tr>',
					    tr_td_open_table_container = '<td colspan="7">',
					    tr_td_close_table_container = '</td>';

					var inner_table_open = '<table class="table">',
					    inner_table_close = '</table>';

					var inner_table_headers_open = '<thead>',
					    inner_table_headers_close = '</thead>';

					var inner_table_headers_child = ['Offense #', 'Punishment Type', 'Days suspended' ,''],
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

								days_suspended = (data[key].days_of_suspension == null) ? 'N/A' : data[key].days_of_suspension;
								
								inner_table_data_container += "<td>" + data[key].offense_number +"</td>";
								inner_table_data_container += "<td>" + data[key].punishment_type +"</td>";
								inner_table_data_container += "<td>" + days_suspended +"</td>";
								// inner_table_data_container += '<td><a href="' + _globalObj._baseURL + URI + '/'  + data[key].id + '/edit' + '" class="btn btn-default">Edit</a></td>';
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
			self.parent().parent().find('.__more_violations_child' + violation_id).fadeOut().remove();
		}
	});


</script>
@stop