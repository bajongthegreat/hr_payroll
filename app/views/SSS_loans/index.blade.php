@extends('layout.master')


@section('styles') 
  .label a {
    text-decoration: none;
    color: #000;
  }
@stop

@section('content')



<div>

     
     <div class="container-fluid">

          <div class="col-sm-3 col-md-2 sidebar" >
            

            <ul class="nav nav-sidebar">
              <li><a href="{{ action('EmployeesController@index') }}">Employees</a></li>
              <li ><a href="#">Promotions</a></li>
              <li><a href="#">Terminations</a></li>
              <li><a href="#">Assignments</a></li>
              <li class="active"><a href="#">Leaves</a></li>
            </ul>
            
          </div>

  </div>




  <div class="table-container col-sm-11" style="">


  <h2 class="page-header"> SSS Loan Management</h2>


  <div class="search-container col-md-4 pull-right">

  <input class="form-control " name="src" placeholder="Search Loans..." id="search" ng-model="query">

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('SSS_loansController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add new loan record</a>
  
   <a  href="{{ action('SSS_loansController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>



  <table class="table table-hover">
  	<thead>
      <th></th>
      <th>ID</th>
      <th width="25%"> Name</th>   
      <th width="13%">SSS ID</th>
  		<th width="15%"> Date Issued </th>
  		<th > Loan Amount </th>
      <th>Deduction starts</th>
  	</thead>

  

  	<tbody id="leaves" >

    

      @foreach($loans as $loan)
      <?php 
            $loan_date = new DateTime($loan->salary_deduction_date);
      ?>
     
      <tr>
        <td> <a class="label label-info label-value" href="{{ action('SSS_loansController@show', $loan->id)}}">View details</a> </td>
        <td> {{ $loan->id }}</td>
        <td>{{ !isset($loan->lastname)?:strtoupper($loan->lastname)}}, {{ !isset($loan->firstname)?: strtoupper($loan->firstname)}} {{ !isset($loan->middlename[0]) ?: strtoupper($loan->middlename[0]) }} </td>
        <td>{{$loan->sss_id}}</td>
        <td>{{$loan->date_issued}}</td>
        <td>{{$loan->loan_amount}}</td>
        <th>{{ $loan_date->format('F Y') }}</th>
        <td><a class="btn btn-default" href="{{ action('SSS_loansController@edit', $loan->id)}}?#employee={{$loan->employee_work_id}}">Edit</a></td>
      </tr>
      @endforeach
     
       
       

      
        
         

     
  	</tbody>
  </table>




  </div>

</div>




@stop


