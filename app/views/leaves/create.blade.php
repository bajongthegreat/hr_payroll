@extends('layout.master')



@section('content')

<div class="page-header">
<h1>Application for Leave <a  href="{{ action('LeavesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


<!-- Employee Search Panel -->
@include('partials.employee_search_panel')

<!-- Error container -->
@include('partials.errors')


{{ Form::open(array('action' => 'LeavesController@store', 'class'=> 'form-horizontal', 'role' => 'form', 'id' => 'storeForm')) }}

	<div id="leave_information" class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Leave Information</h4></h3>
		  </div>
		  <div class="panel-body">

		 


		  	<div class="form-group">

		  		{{ Form::hidden('employee_id', NULL, ['id' => 'employee_id'])}}
		  		{{ Form::hidden('work_id', NULL, ['id' => 'work_id'])}}

				{{ Form::label('type', 'Leave type:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::select('type', ['1' => 'Vacation Leave', '2' => 'Personal Business', '3' => 'Leave with Pay'], NULL, array('class' => 'form-control') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('start_date', 'Start date:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('start_date', Input::old('start_date'), array('class' => 'form-control date', 'data-date-format' => "YYYY-MM-DD", 'required') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('end_date', 'End date:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::text('end_date', Input::old('end_date'), array('class' => 'form-control date', 'data-date-format' => "YYYY-MM-DD", 'required') ) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('reason', 'Reason:', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					{{ Form::textarea('reason', Input::old('reason'), array('class' => 'form-control', 'required') ) }}
				</div>
			</div>

			{{ Form::hidden('status', 'Pending')}}
			@if (Input::has('ref'))
				{{ Form::hidden('ref', Input::get('ref')) }}
			@endif
		  </div> <!-- Panel Body -->



	</div> <!-- End of Panel -->

	<div id="result"></div>
	
	<!-- Buttons -->
	@include('partials.form_buttons')

{{ Form::close() }}


@stop


@section('scripts')

<script type="text/javascript">

            	$('#start_date, #end_date, #file_date').datetimepicker({
                    pickTime: false
                });

                $('.resultContainer').hide();

                $("#start_date").on("dp.change",function (e) {
	               $('#end_date').data("DateTimePicker").setMinDate(e.date);
	            });
	            $("#end_date").on("dp.change",function (e) {
	               $('#start_date').data("DateTimePicker").setMaxDate(e.date);
	            });


           	var __employee="";
           	var __panelsToToggle = ['#leave_information', '#employee_information', '#buttons'];
           	var __fieldsToEmpty = [];
           	var __buttonsToHide = [];
           	var __dbFieldsToUse = [];



           	var __rowsToDisplay = 10;
           	var resultContainer = $('.resultContainer');
           	var hiddenID = $('#employee_id');
        </script>

@stop


@section('later_scripts')
<script type="text/javascript" src="{{ asset('jquery/hr_disciplinary_actions.js') }}"></script>

@stop