@extends('layout.master')


@section('content')
	
	<div class="page-header">
<h1>Employee Reports  <a  href="{{ action('ReportsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	<div class="panel panel-default">
                  <div class="panel-heading">Human Resource</div>
                  <div class="panel-body">
                    <div class="list-group employee-list">
					      <a href="{{ action('ReportsController@create_employee_masterlist_excel') }}" class="list-group-item">
					        <h4 class="list-group-item-heading">Employee Master list</h4>
					        <p class="list-group-item-text">Creates a file to display all employees registered in the database.</p>
					      </a>
					      <a href="{{ action('ReportsController@create_dpc_excel') }}" class="list-group-item">
					        <h4 class="list-group-item-heading">DPC Monitoring Sheet</h4>
					        <p class="list-group-item-text">Creates a file of the summary of violations committed by employees.</p>
					      </a>
					      <a href="#" class="list-group-item">
					        <h4 class="list-group-item-heading">Physical Examination Report</h4>
					        <p class="list-group-item-text">A summary of Physical Examinations done.</p>
					      </a>
					    </div>
                  </div>
                </div>

    <div class="panel panel-default">
                  <div class="panel-heading">Payroll</div>
                  <div class="panel-body">
                    <div class="list-group employee-list">
					      <a href="#" class="list-group-item">
					        <h4 class="list-group-item-heading">Payslip</h4>
					        <p class="list-group-item-text">Creates a file that lists all employee payslips within the specified payroll period.</p>
					      </a>
					      <a href="#" class="list-group-item">
					        <h4 class="list-group-item-heading">SSS Contributions Report</h4>
					        <p class="list-group-item-text">Creates a file of all the contributions by both the employer and the employee.</p>
					      </a>
					      <a href="#" class="list-group-item">
					        <h4 class="list-group-item-heading">Physical Examination Report</h4>
					        <p class="list-group-item-text">A summary of Physical Examinations done.</p>
					      </a>
					    </div>
                  </div>
                </div>
        

@stop