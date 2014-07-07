@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Add SSS Loan record  <a  href="{{ action('SSS_loansController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>



<!-- Employee Search Panel -->
@include('partials.employee_search_panel')

<!-- Error container -->
@include('partials.errors')




	{{ Form::open(['action' => 'SSS_loansController@store', 'class' => 'form-horizontal', 'role' => 'form']) }}

	
	<div id="loan_information" class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Leave Information</h4></h3>
		  </div>
		  <div class="panel-body">

		
				{{ Form::hidden('employee_id', NULL, ['id' => 'employee_id'])}}
		  		{{ Form::hidden('work_id', NULL, ['id' => 'work_id'])}}

			<div class="form-group">
						
				{{ Form::label('sss_id', 'SSS ID: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-3">
					<p class="sss_id"></p>
					<input type="hidden" class="sss_id" name="sss_id" value="{{ Input::old('sss_id') }}">
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('date_issued', 'Date Issued: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					<div class='input-group date' id='date_hired' data-date-format="YYYY-MM-DD">

					{{ Form::text('date_issued', Input::old('date_issued'), array('class' => 'form-control', 'data-date-format' => "YYYY-MM-DD") ) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
        
                	</div>
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('loan_amount', 'Loan Amount: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::text('loan_amount', Input::old('loan_amount'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

				<div class="form-group">

						
				{{ Form::label('salary_deduction_date', 'Start of Salary Deduction: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
				<div class='input-group date' id='date_hired' data-date-format="YYYY-MM-DD">
	
					{{ Form::text('salary_deduction_date', Input::old('salary_deduction_date'), array('class' => 'form-control', 'data-date-format' => "YYYY-MM-DD") ) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
        
                	</div>

				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('monthly_amortization', 'Monthly Amortization: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::text('monthly_amortization', Input::old('monthly_amortization'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('duration_in_months', 'Duration in Months: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::input('number','duration_in_months', Input::old('duration_in_months'), array('class' => 'form-control') ) }}
				</div>
				
			</div>





			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary ')) }}</div>
	      </div>
				
		</div>

	 </div> <!-- Panel Body -->



	</div> <!-- End of Panel -->


	{{ Form::close() }}





@stop

@section('scripts')

<script type="text/javascript">

            $(function () {

            	$('#salary_deduction_date, #date_issued').datetimepicker({
                    pickTime: false
                });

                $("#start_date").on("dp.change",function (e) {
	               $('#end_date').data("DateTimePicker").setMinDate(e.date);
	            });
	            $("#end_date").on("dp.change",function (e) {
	               $('#start_date').data("DateTimePicker").setMaxDate(e.date);
	            });

                           

            });

            var __employee="";
           	var __panelsToToggle = ['#loan_information', '#employee_information', '#buttons'];
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
