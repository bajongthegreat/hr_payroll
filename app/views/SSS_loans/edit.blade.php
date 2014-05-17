@extends('layout.master')


@section('content')


<div class="page-header">
<h1>Update SSS Loan record  <a  href="{{ action('SSS_loansController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>

<?php 
	$employee_work_id = $loan->employee->employee_work_id;
	$employee_name = ucfirst($loan->employee->lastname) . ', ' . ucfirst($loan->employee->firstname) . ' ' . ucfirst($loan->employee->middlename[0]);
	$date_hired = $loan->employee->date_hired;
?>

<!-- Employee Search Panel -->
@include('partials.employee_search_panel')

<!-- Error container -->
@include('partials.errors')




	{{ Form::model($loan, ['action' => ['SSS_loansController@update', $loan->id],'method' => 'PATCH', 'class' => 'form-horizontal', 'role' => 'form']) }}

	
	<div id="loan_information" class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Leave Information</h4></h3>
		  </div>
		  <div class="panel-body">

		
				{{ Form::hidden('employee_id', NULL, ['id' => 'employee_id'])}}
		  		{{ Form::hidden('work_id', NULL, ['id' => 'work_id'])}}

			<div class="form-group">
						
				{{ Form::label('sss_id', 'SSS ID: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-3">
					<p> {{ $loan->sss_id }}</p>
					{{ Form::hidden('sss_id', Input::old('sss_id'))  }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('date_issued', 'Date Issued: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('date_issued', Input::old('date_issued'), array('class' => 'form-control', 'data-format' => "YYYY-MM-DD") ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('loan_amount', 'Loan Amount: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('loan_amount', Input::old('loan_amount'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('salary_deduction_date', 'Start of Salary Deduction: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('salary_deduction_date', Input::old('salary_deduction_start'), array('class' => 'form-control', 'data-format' => "YYYY-MM-DD") ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('monthly_amortization', 'Monthly Amortization: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('monthly_amortization', Input::old('monthly_amortization'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

				<div class="form-group">
						
				{{ Form::label('duration_in_months', 'Duration in Months: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-2">
					{{ Form::text('duration_in_months', Input::old('duration_in_months'), array('class' => 'form-control') ) }}
				</div>
				
			</div>





			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
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

        </script>

@stop