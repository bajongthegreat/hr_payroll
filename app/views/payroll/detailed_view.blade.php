@extends('layout.reports')
<style type="text/css">
.report-header-title {
	margin-left: 10px;
	font-size: 16px;
}

</style>													

@section('content')

																						
<!-- Don't use .container at all or you will have to
     override a lot of responsive styles. -->

<?php 
	$start = new DateTime(Input::get('start'));
	$end = new DateTime(Input::get('end'));
?>
<div class="page-header-less-margin">
	<div class="report-header-title">TIBUD SA KATIBAWASAN MULTI-PURPOSE COOPERATIVE</div>
	<div class="report-header-title">CONSOLIDATED PAYROLL</div>
	<div class="report-header-title">{{ $start->format('F d')}} TO {{ $end->format('F d, Y')}}	</div>
</div>

<table class="tablesorter" style="width: 1480px;">
	<thead>
		<th class="text-center">ID Number</th>
		<th class="text-center" >Name</th>
		<th class="text-center">Ndays</th>
		<th class="text-center">Basic</th>
		<th class="text-center">Incentive</th>
		<th class="text-center">Overtime</th>
		<th class="text-center">NPremium</th>
		<th class="text-center">Holiday</th>
		<th class="text-center">Adjustment</th>
		<th class="text-center">Grosspay</th>
		<th class="text-center">HDMF</th>
		<th class="text-center">SSS</th>
		<th class="text-center">PHIC</th>
		<th class="text-center">SSS Loan</th>
		<th class="text-center">HDMF Loan</th>
		<th class="text-center">Health Care</th>
		<th class="text-center">CBU</th>
		<th class="text-center">Pledge</th>
		<th class="text-center">Pharmacy</th>
		<th class="text-center">Ticket</th>
		<th class="text-center">Grocery</th>
		<th class="text-center">Savings</th>
		<th class="text-center">Adjustment</th>
		<th class="text-center">Netpay</th>
	</thead>
	<tbody>
		@foreach($data as $key=>$value)
			<tr>
				<td class="text-center">{{ $value->employee_id }}</td>
				<td class="text-center"> {{ $value->name }}</td>
				<td class="text-center">{{ $value->days_worked }}</td>
				<td class="text-center">{{ number_format($value->basic_pay, 2) }}</td>
				<td class="text-center">{{ ($value->incentives == 0)  ? "-" : $value->incentives}}</td>
				<td class="text-center">{{ ($value->overtime_pay == 0) ? "-" : $value->overtime_pay  }}</td>
				<td class="text-center">{{ ($value->night_premium == 0) ? "-" : $value->night_premium }}</td>
				<td class="text-center">{{ ($value->holiday == 0) ? "-" : number_format($value->holiday, 2) }}</td>
				<td class="text-center">{{ ($value->adjustment_cr == 0) ? "-" : $value->adjustment_cr }}</td>
				<td class="text-center">{{ number_format($value->grosspay, 2) }}</td>
				<td class="text-center">{{ ($value->hdmf_contribution == 0) ? "-" : $value->hdmf_contribution  }}</td>
				<td class="text-center">{{ ($value->sss_contribution == 0) ? "-"  : $value->sss_contribution }}</td>
				<td class="text-center">{{ ($value->philhealth_contribution == 0) ? "-" : $value->philhealth_contribution }}</td>
				<td class="text-center">{{ ($value->sss_loan == 0) ? "-" : number_format($value->sss_loan,2) }}</td>
				<td class="text-center">{{ ($value->hdmf_loan == 0) ? "-" : number_format($value->hdmf_loan,2)  }}</td>
				<td class="text-center">{{ ($value->health_care  == 0) ? "-" : number_format($value->health_care,2) }}</td>
				<td class="text-center">{{ ($value->cbu == 0) ? "-" : number_format($value->cbu,2) }}</td>
				<td class="text-center">{{ ($value->pledge == 0) ? "-" : number_format($value->pledge,2)  }}</td>
				<td class="text-center">{{ ($value->pharmacy == 0) ? "-" : number_format($value->pharmacy,2) }}</td>
				<td class="text-center">{{ ($value->tickets == 0) ? "-" : number_format($value->tickets,2) }}</td>
				<td class="text-center">{{ ($value->grocery == 0) ? "-" : number_format($value->grocery,2) }}</td>
				<td class="text-center">{{ ($value->savings == 0) ? "-" : number_format($value->savings,2) }}</td>
				<td class="text-center">{{ ($value->adjustment_dr == 0) ? "-" : number_format($value->adjustment_dr,2) }}</td>
				<td class="text-center">{{ ($value->netpay == 0) ? "-" : number_format($value->netpay, 2) }}</td>


			</tr>
		@endforeach
	</tbody>
</table>

																							




@stop

@section('scripts')

<script type="text/javascript">
	(function(){
		setTimeout(function() {
			$('.tablesorter').dataTable();
		}, 500);
	})();
</script>
@stop


