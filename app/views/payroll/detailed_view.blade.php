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


<div class="page-header-less-margin">
	<div class="report-header-title">TIBUD SA KATIBAWASAN MULTI-PURPOSE COOPERATIVE</div>
	<div class="report-header-title">CONSOLIDATED PAYROLL</div>
	<div class="report-header-title">June 01 TO July 01 2014	</div>
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
				<td class="text-center">{{ ($value->philhealth_contribution) ? "-" : $value->philhealth_contribution }}</td>
				<td class="text-center">{{ ($value->sss_loan) ? "-" : $value->sss_loan }}</td>
				<td class="text-center">{{ ($value->hdmf_loan == 0) ? "-" : $value->hdmf_loan  }}</td>
				<td class="text-center">{{ ($value->health_care  == 0) ? "-" : $value->health_care }}</td>
				<td class="text-center">{{ ($value->cbu == 0) ? "-" : $value->cbu }}</td>
				<td class="text-center">{{ ($value->pledge == 0) ? "-" : $value->pledge  }}</td>
				<td class="text-center">{{ ($value->pharmacy == 0) ? "-" : $value->pharmacy }}</td>
				<td class="text-center">{{ ($value->tickets == 0) ? "-" : $value->tickets }}</td>
				<td class="text-center">{{ ($value->grocery == 0) ? "-" : $value->grocery }}</td>
				<td class="text-center">{{ ($value->savings == 0) ? "-" : $value->savings }}</td>
				<td class="text-center">{{ ($value->adjustment_dr == 0) ? "-" : $value->adjustment_dr }}</td>
				<td class="text-center">{{ ($value->netpay == 0) ? "-" : $value->netpay }}</td>


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


