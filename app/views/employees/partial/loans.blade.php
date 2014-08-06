<?php 

	$sss_loan = DB::table('sss_loans')->leftJoin('employees', 'employees.id', '=', 'sss_loans.employee_id')
	                              ->where('employee_work_id', '=', $employee->employee_work_id)
	                   	          ->where('status', '=', 'open')
	                      		  ->first(['sss_loans.id', 'loan_amount','monthly_amortization', 
	                      		  	       'check_date', 'check_number', 'check_amount', 'salary_deduction_date']);
	                      		 
	if ($sss_loan) {

	    $payments = DB::table('sss_loans_remittance')->where('sss_loan_id','=', $sss_loan->id)->sum('amount');

	    $amount_obligated_to_pay = ($sss_loan->monthly_amortization*24);
		$balance = $amount_obligated_to_pay - $payments;
		$payment_percentage = round(($payments/$amount_obligated_to_pay) * 100, 2);
	}

	$previous_sss_loans = DB::table('sss_loans')->leftJoin('employees', 'employees.id', '=', 'sss_loans.employee_id')
				                              ->where('employee_work_id', '=', $employee->employee_work_id)
				                  	          ->where('status', '=', 'closed')
				                      		  ->get(['date_issued', 'duration_in_months', 'monthly_amortization', 'sss_loans.id']);

?>


<div class="panel panel-default ">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          SSS LOAN INFORMATION
        </a></h4></h3>
		  </div>


@if ($sss_loan)

<div class="panel panel-default smooth-panel-edges">
	<div class="panel-heading text-center">
		CURRRENT LOAN DETAILS
	</div>

	<div class="panel-body">


			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Check Date</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > {{ $sss_loan->check_date }}</span>
					</div>
					
				</div>
			</div>


			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Check Number</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > {{ $sss_loan->check_number }}</span>
					</div>
					
				</div>
			</div>


			
			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Check Amount</label>
					</div>

					<div class="col-xs-2">
						<span class="label-value" > P {{ number_format($sss_loan->check_amount, 2) }}</span>
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Loan Amount</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > P {{ number_format($sss_loan->loan_amount,2) }}</span>
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Amount Obligation</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > P 	{{ number_format($amount_obligated_to_pay, 2) }} </span>
					</div>
					
				</div>
			</div>

			<hr>

			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>First Monthly Amortization</label>
					</div>
					<?php 
						$month_start = new DateTime($sss_loan->salary_deduction_date);
					?>
					<div class="col-xs-4">
						<span class="label-value" > {{ $month_start->format('F Y') }} </span>
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Monthly Amortization</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > P {{ number_format($sss_loan->monthly_amortization, 2) }} </span>
					</div>
					
				</div>
			</div>

	</div>


</div>

		  <!-- Statement of Account -->

<div class="panel panel-default smooth-panel-edges">
	<div class="panel-heading">
		<h3 class="panel-title text-center">STATEMENT OF ACCOUNT</h3>
	</div>

	<div class="panel-body">

		<div>
						
		</div>
		

		<!-- Statement Starts -->
		<?php 
			$today = new DateTime();
		?>
		<div class="summary-title">Account Summary as of {{ $today->format('F m, Y') }}</div>

		<div class="container" style="margin-top: 10px">
			
			<div class="form-group">
				<span class="col-md-6">Amount obligated to pay</span>
				<span class="col-md-2">P {{ number_format($amount_obligated_to_pay, 2) }}</span>
			</div>

			<div class="form-group">
				<span class="col-md-6">Payments made  <span>( {{ $payment_percentage }}% ) </span></span>
				<span class="col-md-2">(P {{ number_format($payments, 2) }})  </span>
			</div>

		</div>

		<hr>

			<div class="container" style="margin-top: 10px">
			
			<div class="form-group">
				<span class="col-md-6 text-right"><strong>Balance</strong></span>
				<span class="col-md-2">P {{ number_format($balance, 2)}}</span>
			</div>


		</div>

	</div>
</div>


	<div class="panel panel-default smooth-panel-edges">
		<div class="panel-body">
			<a class="btn btn-primary col-md-12 pull-left" href="{{ route('sss_loans.show', $sss_loan->id) }}">View more details of this loan</a>
		</div>
	</div>
@else
	<div class="panel panel-default smooth-panel-edges">
		
		<div class="panel-body">
			<div class="alert alert-warning text-center">No loan account found</div>
		</div>
	</div>
@endif
	
			  <div class="panel panel-default smooth-panel-edges">
			  <div class="panel-heading">
			  	PREVIOUS LOANS
			  </div>
			  <div class="panel-body">
			    
			    <table class="table table-striped">
				  	<thead>
				  		<th class="text-center">Date Issued</th>
				  		<th class="text-center">Payable amount</th>
				  		<th class="text-center">Monthly amortization</th>
				  	</thead>

				  	<tbody>
				 	
				 	@foreach($previous_sss_loans as $loan)
				 		<tr class="text-center">
				 			<td>{{$loan->date_issued}}</td>
				 			<td>{{number_format($loan->monthly_amortization * $loan->duration_in_months, 2)}}</td>
				 			<td>{{ $loan->monthly_amortization}}</td>
				 			<td> <a class="btn btn-default" href="{{ route('sss_loans.show', $loan->id) }}"><img width="20" src="{{ asset('img/icons/32x32/zoom-in.png')}}"> View More</a> </td>
				 		</tr>
				 	@endforeach
				  		
				  	</tbody>

				  </table>


				  @if (count($previous_sss_loans) == 0)
				  
				  	<div class="alert alert-warning text-center smooth-panel-edges">No previous SSS loan records found.</div>


				  
				  @endif

			  </div>
			</div>
		  

		  <div class="panel panel-default smooth-panel-edges" >
		  <div class="panel-body">
		    <a href="{{ action('LeavesController@create') }}?ref={{ base64_encode(URL::current() . '?v=leaves')}}#employee={{$employee->employee_work_id}}" class="btn btn-primary pull-left">Add record</a>
		    <a href="{{ action('LeavesController@index') }}" class="btn btn-default pull-right">Go to Loans</a>
		  </div>
		</div>
				

		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
