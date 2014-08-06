@extends('layout.master')


@section('content')

<?php 
	$amount_obligated_to_pay = ($sss_loan_profile->monthly_amortization*24);
	$balance = $amount_obligated_to_pay - $total_payments;
	$payment_percentage = round(($total_payments/$amount_obligated_to_pay) * 100, 2);
?>


<div class="container">

<div class="page-header">
<h1> SSS Loan Inquiry</h1>
</div>


<div class="panel panel-default">
  <div class="panel-body">

		    <!-- Button trigger modal -->
		 <div class="row col-md-12">
		 	<a class="btn btn-default col-md-12 pull-left">
			 Edit Loan information
			</a>
		 </div>   
		 <hr>
		    <!-- Button trigger modal -->
		 <div class="row col-md-12">
		 	<button class="btn btn-primary col-md-12 pull-left" id="add_loan_payment" data-toggle="modal" data-target="#myModal">
			  Add Loan Payment
			</button>
		 </div>   
		
  </div>
</div>


	<div class="panel panel-default">

		<div class="panel-heading">
		    <h3 class="panel-title text-center">SSS Member Information</h3>
		  </div>

		<div class="panel-body" >



			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>SSS Number</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" >{{ $sss_loan_profile->sss_id }}</span>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Borrower's Name</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" >{{ $sss_loan_profile->lastname }}, {{ $sss_loan_profile->firstname }} {{ isset($sss_loan_profile->middlename[0]) ? $sss_loan_profile->middlename[0] : ' ' }} {{ $sss_loan_profile->name_extension }}</span>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Date of Birth</label>
					</div>

					<?php 

						$birthdate = new DateTime($sss_loan_profile->birthdate);

					?>

					<div class="col-xs-4">
						<span class="label-value" > {{  $birthdate->format('F m, Y') }}</span>
					</div>

				</div>
			</div>




			<hr>
			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Loan Type</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" >Salary Loan</span>
					</div>
					
				</div>
			</div>

						<hr>


			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Check Date</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > {{ $sss_loan_profile->check_date }}</span>
					</div>
					
				</div>
			</div>


			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Check Number</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > {{ $sss_loan_profile->check_number }}</span>
					</div>
					
				</div>
			</div>


			
			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Check Amount</label>
					</div>

					<div class="col-xs-2">
						<span class="label-value" > P {{ number_format($sss_loan_profile->check_amount, 2) }}</span>
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Loan Amount</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > P {{ number_format($sss_loan_profile->loan_amount,2) }}</span>
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
						$month_start = new DateTime($sss_loan_profile->salary_deduction_date);
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
						<span class="label-value" > P {{ number_format($sss_loan_profile->monthly_amortization, 2) }} </span>
					</div>
					
				</div>
			</div>

			<hr>
				<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Status</label>
					</div>

					<div class="col-xs-4">
						<span class="label-value" > {{ ($sss_loan_profile->status == 'open' ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>') }} </span>
					</div>
					
				</div>
			</div>


			<div class="row">
				<div class="form-group">

					<div class="col-xs-4">
						<label>Allowed to Re-Loan</label>
					</div>

					<div class="col-xs-4">
						<?php $create_loan = route('sss_loans.create'); ?>
						<span class="label-value" > {{ ($payment_percentage >= 50) ? '<span class="label label-success">Yes</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="' . $create_loan .'#employee=' . $sss_loan_profile->employee_work_id .'" class="label label-primary">Re-loan</a>' : '<span class="label label-danger">No</span>'  }}  </span>
					</div>
					
				</div>
			</div>

		</div>


	</div>

<!-- Statement of Account -->

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title text-center">STATEMENT OF ACCOUNT</h3>
	</div>

	<div class="panel-body">
		<?php 
			$today = new DateTime();
		?>
		<div class="summary-title">Account Summary as of {{ $today->format('F m, Y') }}</div>

		<div class="container" style="margin-top: 10px">
			
			<div class="form-group">
				<span class="col-md-6">Amount obligated to pay</span>
				<span class="col-md-2">P {{ number_format($sss_loan_profile->monthly_amortization*24, 2) }}</span>
			</div>

			<div class="form-group">
				<span class="col-md-6">Payments made  <span>( {{ $payment_percentage }}% ) </span></span>
				<span class="col-md-2">P ({{ number_format($total_payments, 2) }})  </span>
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

<!-- Credited Payments -->

	<div class="panel panel-default">

				<div class="panel-heading">
		    <h3 class="panel-title text-center" >CREDITED PAYMENTS 


</h3>
		  </div>

		<div class="panel-body">

			<table class="table table-bordered">
				<thead >
					<th></th>
					<th class="text-center">SBR/TR No.</th>
					<th class="text-center">SBR/TR Date</th>
					<th class="text-center">Post Date &  Time</th>
					<th class="text-center">Amount</th>
					<th></th>
				</thead>

				<tbody>
					@foreach($payments as $payment)
				
					<tr class="text-center" data-payment_id="{{ $payment->id }}">
						<td>{{ (is_null($payment->sbr_tr_number)) ? "<span class='label label-value label-success'>Auto</span>" : "<span class='label label-value  label-default'>Manual</span>" }}</td>
				
						<td>{{ $payment->sbr_tr_number or '-' }}</td>
						<td>{{ $payment->sbr_tr_date or '-' }}</td>						
						<td>{{  $payment->created_at }}</td>
						<td>{{ number_format($payment->amount, 2) }}</td>
						<td> <a class="btn btn-default edit-payment">Edit</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>		
	

	</div>


</div>


<!-- Add Payments Modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">SSS Loan Payment</h4>
      </div>
      <div class="modal-body">

      	{{ Form::open(['class' => 'form-horizontal', 'role' => 'form']) }}

      					<!-- SSS Loan -->
      					<input type="hidden" id="sss_loan_id" value="{{ $sss_loan_profile->id }}">
      					<input type="hidden" id="employee_id" value="{{ $sss_loan_profile->employee_id }}">

        		<div class="form-group">
						
					{{ Form::label('sbr_tr_number', 'SBR/TR Number: ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-6">
						{{ Form::text('sbr_tr_number', Input::old('sbr_tr_number'), array('class' => 'form-control', 'required') ) }}
					</div>
				
				</div>

					<div class="form-group">
						
					{{ Form::label('sbr_tr_date', 'SBR/TR Date: ', array('class' => 'col-sm-4 text-right', 'required')) }}

					<div class="col-sm-6">
						{{ Form::text('sbr_tr_date', Input::old('sbr_tr_date'), array('class' => 'form-control', 'required') ) }}
					</div>
				
				</div>


				<div class="form-group">
						
					{{ Form::label('amount', 'Amount: ', array('class' => 'col-sm-4 text-right')) }}

					<div class="col-sm-6">
						{{ Form::text('amount', Input::old('amount'), array('class' => 'form-control') ) }}
					</div>
				
				</div>

				<div class="alert message-container" style="display:none">

				</div>
				<div class="alert alert-warning">Please be informed that the system will only record the total amount obligated to pay. If payment exceeds, the system will reject any other payments.</div>
				<a class="btn btn-primary col-md-12" href="#" style="display:none" id="submit-another-payment" data-process>Submit another payment</a>	

		{{ Form::close() }}


      </div>
      <div class="modal-footer">

      		<p class="col-xs-6">{{ Form::label('timestamp', 'Timestamp') }} : {{ date('F m, Y h:i:s') }}</p>
      	
        <button type="button" class="btn btn-default reloadhtml" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit_sss_loan_payment" data-process_type="add">Save changes</button>
      </div>
    </div>
  </div>
</div>




<!-- Edit Payments Modal -->




@stop

@section('scripts')
<script type="text/javascript">
	(function(){
		setTimeout(function() {
			$('.table-bordered').dataTable();
		},1500);

		function resetModal() {
			
			var submit = $('#submit_sss_loan_payment');
			var submit_another = $('#submit-another-payment');

			$('#sbr_tr_number').focus().val('');
			$('#sbr_tr_date').val('');
			$('#amount').val('');
			$('.message-container').html('').hide();

			submit.html('Save Changes')
			      .prop('disabled', false);

			submit_another.hide();
		}


		// Reset any value on modal
		$('#add_loan_payment').on('click', function() {
			$('#submit_sss_loan_payment').data("process-type", 'add');
	
			resetModal();
		});

		$('#submit-another-payment').on('click', function() {
			$('#submit_sss_loan_payment').data("process-type", 'add');
			resetModal();
		});

		$('.reloadhtml').on('click', function() {
			location.reload();
		});

		$('.edit-payment').on('click', function() {
			var payment_id =  $(this).parent()
			       				  .parent()
			               				   .data('payment_id');

			resetModal();

			// alert('wa');

			// Perform an AJAX request to get the payment details
			$.ajax({
				type: 'GET',
				data: { payment_id : payment_id},
				url: _globalObj._baseURL + '/sss_loans/payment/' + payment_id + '/edit',
				success: function(payment_details) {
					if ( payment_details.hasOwnProperty('data') ) {
						var payment = payment_details.data;


						var sbr_tr_number = $('#sbr_tr_number');
						var sbr_tr_date = $('#sbr_tr_date');
						var amount = $('#amount');
						var sss_loan_id = $('#sss_loan_id');


						$('#add_loan_payment').trigger('click');
						$('#submit_sss_loan_payment').data("process-type", 'update')
						                             .data('payment_id', payment.id);

						sbr_tr_number.val(payment.sbr_tr_number);
						sbr_tr_date.val(payment.sbr_tr_date);
						amount.val(payment.amount);
						sss_loan_id.val(payment.sss_loan_id);

					}
					console.log('without')
				},
				error: function (error_details) {
					alert(error_details);
				}
			});

			// Display the payment details through bootstrap modal 
		});

		$('#submit_sss_loan_payment').on('click', function() {

			var sbr_tr_number = $('#sbr_tr_number').val();
			var sbr_tr_date = $('#sbr_tr_date').val();
			var amount = $('#amount').val();
			var sss_loan_id = $('#sss_loan_id').val();
			var messageContainer = $('.message-container');
			var employee_id = $('#employee_id').val();
			var submit = $('#submit_sss_loan_payment');
			var submit_another = $('#submit-another-payment');


			if (submit.data('process-type') == 'add') {
				form_submission_type = 'POST';
				url = _globalObj._baseURL + "/sss_loans/payment";
			} else {
				form_submission_type = 'PUT';
				url = _globalObj._baseURL + "/sss_loans/payment/" + submit.data('payment_id');
			}

			// Perform an AJAX submit
			$.ajax({
				type: 'POST',
				url: url,
				data: { amount: amount, 
					    sbr_tr_number: sbr_tr_number, 
					    sbr_tr_date: sbr_tr_date,
					    sss_loan_id: sss_loan_id,
					    employee_id: employee_id,
				        _token: _globalObj._token,
				        _method: form_submission_type },
				beforeSend: function() {
					submit.html('Saving...')
					      .prop('disabled', true);
					
					messageContainer.html('');

					messageContainer.removeClass('alert-danger')
									.removeClass('alert-success')
					                .hide();

					submit_another.hide();
				},
				success: function(loan_data) {
					
					// Check if errors exists
					if (loan_data.hasOwnProperty('errors')) {
						var oldHtml = "";
						var error_item = "";

						$.each(loan_data.errors, function(i,v) {
							oldHtml = messageContainer.html();
							error_item = '<li>' + v + '</li>';

							messageContainer.html(oldHtml + error_item);

						});

						messageContainer.addClass('alert-danger');
						messageContainer.show();

						submit.html('Save Changes')
     					      .prop('disabled', false);

					} 


					// Check the process outcome
					if (loan_data.hasOwnProperty('status')) {
						
						if (loan_data.status == 'success') {
							messageContainer.addClass('alert-success');

							// Message from server
							messageContainer.html(loan_data.message);

							// Presentation to client
							submit.html('Save Changes');
							messageContainer.show();	
							submit_another.show();
						} else {
							messageContainer.addClass('alert-danger');

							// Message from server
							messageContainer.html(loan_data.message);

							// Presentation to client
							submit.html('Save Changes');
							messageContainer.show();
						}

					}


				},
				error: function() {
					$('#submit_sss_loan_payment').html('Save Changes')
					                             .prop('disabled', false);
				}
			});

		});


	})()
</script>
@stop