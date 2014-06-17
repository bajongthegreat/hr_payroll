@extends('layout.master')

@section('content')

<style type="text/css">

</style>
<h2 class="page-header"> Medical Examinations</h2>


<div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		  
		  	<div class="parent">
  <div class="child">
  		<a href="{{ action('MedicalEstablishmentsController@index') }}" class="btn btn-default"> <span class="glyphicon glyphicon-th	"></span> Manage Medical Establishments</a>
</div>

<div class="child">
  		<a href="{{ action('DiseasesController@index') }}" class="btn btn-default"> <span class="glyphicon glyphicon-dashboard"></span> Manage Known Diseases</a>
</div>
	
		</div>


		  </div>
</div>
		  	


  <div class="search-container col-md-4 pull-right">
   {{ Form::open(['action' => 'EmployeesMedicalExaminationsController@index', 'method' => 'GET']) }}
  <input class="form-control " name="src" placeholder="Search for medical records." id="search" ng-model="query" value="{{Input::get('src')}}">
 {{ Form::close() }}

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('EmployeesMedicalExaminationsController@create', 'add_type=bulk')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add Multiple records</a>
   <a  href="{{ action('EmployeesMedicalExaminationsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>

  <table class="table table-hover">
	<thead>
		<th width="10%"></th>
		<th> Medical Establishment </th>
		<th> Date conducted</th>
		<th></th>

	</thead>
	<tbody>

		@foreach($physical_examinations as $pe)

			<?php 
				$date_conducted = new DateTime($pe->date_conducted);
			?>
		
			<tr data-employee_id="{{ $pe->employee_work_id }}" >
  				<td class="__more_violations_parent" data-medical_establishment="{{ $pe->medical_establishment_id }}" data-date_conducted="{{ $pe->date_conducted }}" data-status="closed"  > <span class="label label-default"><span class="glyphicon glyphicon-list"></span>  View Employees Included</span></td>
				<td> {{ $pe->establishment }} </td>
				<td> {{ $date_conducted->format('F d, Y')  }} </td>
				<td> <a href="{{ action('EmployeesMedicalExaminationsController@edit', $pe->id) }}">Edit</a> </td>
			</tr>
		@endforeach

	</tbody>
</table>
	
		<?php $collection = $physical_examinations; ?>
		@include('partials.pagination_links')


@stop


@section('scripts')
<script type="text/javascript">
	$('.__more_violations_parent').on('click', function(e) {
		var URI = '/employees/medical_examinations';
		var self = $(this);

		var date_conducted = self.data('date_conducted');
		var medical_establishment_id = self.data('medical_establishment');
		console.log(medical_establishment_id);

		if ($(this).data('status') == 'closed') {
			
			// Change status
			$(this).data('status', 'open');
 
			// Change the label
			$(this).html('<span class="label label-default"><span class="glyphicon glyphicon-resize-small"></span> Collapse</span>');

			$.ajax({
				type: 'GET',
				url: _globalObj._baseURL + URI,
				data: { jq_ax: 'employees_included', medical_establishment_id: medical_establishment_id ,'date_conducted': date_conducted },
				success: function(data) {
					
					if (!data) return false;
					self.parent().parent().find('.__more_violations_child' + date_conducted).fadeOut().remove();

					var tr_open_parent_from_original_table = '<tr class="__more_violations_child' + date_conducted +'">',
					    tr_close_parent_from_original_table = '</tr>',
					    tr_td_open_table_container = '<td colspan="7">',
					    tr_td_close_table_container = '</td>';

					var inner_table_open = '<table class="table">',
					    inner_table_close = '</table>';

					var inner_table_headers_open = '<thead>',
					    inner_table_headers_close = '</thead>';

					var inner_table_headers_child = ['Name', 'Medical Findings', 'Recommendation', 'Remarks' ,''],
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
								
								inner_table_data_container += "<td>" + data[key].lastname + ', ' + data[key].firstname + ' ' + data[key].middlename +"</td>";
								inner_table_data_container += "<td>" + data[key].medical_findings +"</td>";
								inner_table_data_container += "<td>" + data[key].recommendations +"</td>";
								inner_table_data_container += "<td>" + data[key].remarks +"</td>";
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
			self.html('<span class="label label-default"><span class="glyphicon glyphicon-list"></span> View Employees Included</span>');
			self.parent().parent().find('.__more_violations_child' + date_conducted).fadeOut().remove();
		}
	});


</script>
@stop