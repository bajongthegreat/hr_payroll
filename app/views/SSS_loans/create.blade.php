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


		  		@include('SSS_loans.form')



			<hr>


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

           	var redirect = true;
        </script>

@stop

@section('later_scripts')
<script type="text/javascript" src="{{ asset('jquery/hr_disciplinary_actions.js') }}"></script>
@stop
