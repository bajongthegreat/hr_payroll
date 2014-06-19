@extends('layout.master')
@section('content')
	

	<!-- Note: -->
	<!-- Can be filtered by month -->

	<h2 class="page-header"> Rates </h2>
	

	
	  <div class="search-container col-md-4 pull-right">
		{{ Form::open(['method' => 'GET'])}}	
	  <input class="form-control " name="src" placeholder="Search rate..." id="search" ng-model="query">
		{{ Form::close() }}
	  </div>
	
	  <div class="header-buttons pull-left">
	  <a href="{{ action('RatesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new  Record</a>
	   <a  href="{{ action('RatesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
			
	  </div>
	 

	  <table class="table table-hover">
	  	
	  		<thead>
	  			<th width="10%"></th>
	  			<th>ID</th>
	  			<th>Type</th>
	  			<th>Rate</th>
	  			<th>Overtime Rate</th>
	  			<th>NP 10-3</th>
	  			<th>NP 3-6</th>
	  		</thead>
	  		<tbody>
	  			@foreach ($rates as $rate)
	  					
	  				<tr  >
	  					<td class="__more_violations_parent" data-status="closed"   data-id="{{ $rate->id }}"> <span class="label label-default"><span class="glyphicon glyphicon-list"></span>  View Special Rates</span></td>
	  					<td>{{ $rate->id }}</td>
	  					<td> {{ ucfirst($rate->type) }} </td>
	  					<td> {{ $rate->rate }} </td>
	  					<td> {{ round($rate->overtime_rate, 2) }} </td>
	  					<td> {{ round($rate->night_premium_10_3, 2) }} </td>
	  					<td> {{ round($rate->night_premium_3_6, 2) }} </td>
	  					<td> <a href="{{ action('RatesController@edit', $rate->id) }}"  class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
	  				</tr>
	  			@endforeach
	  		</tbody>
	  	
	  </table>
	  	@if (Session::has('message'))
	  		<div class="alert alert-info text-center"> {{ Session::get('message') }}</div>
	  	@endif
	<?php $collection = $rates; ?>
		@include('partials.pagination_links')

@stop

@section('scripts')
<script type="text/javascript">

	
	$('.__more_violations_parent').on('click', function(e) {
		
		var URI = '/payroll/rates';
		var self = $(this);

		var id = self.data('id');

		if ($(this).data('status') == 'closed') {
			
			// Change status
			$(this).data('status', 'open');
 
			// Change the label
			$(this).html('<span class="label label-default"><span class="glyphicon glyphicon-resize-small"></span> Collapse</span>');

			$.ajax({
				type: 'GET',
				url: _globalObj._baseURL + URI,
				data: { jq_ax: 'rates', 
				        id: id },
				success: function(data) {
					
					if (!data) return false;
					self.parent().parent().find('.__more_violations_child' + id).fadeOut().remove();

					var tr_open_parent_from_original_table = '<tr class="__more_violations_child'+ id + '">',
					    tr_close_parent_from_original_table = '</tr>',
					    tr_td_open_table_container = '<td colspan="7">',
					    tr_td_close_table_container = '</td>';

					var inner_table_open = '<table class="table">',
					    inner_table_close = '</table>';

					var inner_table_headers_open = '<thead>',
					    inner_table_headers_close = '</thead>';

					var inner_table_headers_child = ['Type', 'Rate', 'Overtime Rate', 'NP 10-3', 'NP 3-6'],
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
			

								inner_table_data_container += "<td>" + data[key].type.replace(new RegExp('_', 'g') ,' ') +"</td>";
								inner_table_data_container += "<td>" + (Math.round(data[key].rate * 100)/ 100)  +"</td>";
								inner_table_data_container += "<td>" + (Math.round(data[key].overtime_rate * 100) / 100) +"</td>";
								inner_table_data_container += "<td>" + (Math.round(data[key].night_premium_10_3 * 100) / 100) +"</td>";
								inner_table_data_container += "<td>" + (Math.round(data[key].night_premium_3_6 * 100) / 100) +"</td>";
								
								// inner_table_data_container += '<td><a href="' + _globalObj._baseURL + URI + '/'  + data[key].id + '/edit" class="btn btn-default">Edit</a></td>';
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
			self.html('<span class="label label-default"><span class="glyphicon glyphicon-list"></span> View Special Rates</span>');
			self.parent().parent().find('.__more_violations_child' + id).fadeOut().remove();

		}
	});


</script>
@stop