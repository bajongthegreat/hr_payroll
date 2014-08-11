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


  <h2 class="page-header"> Employee Leave Management</h2>

<p>Search term: <i><u><% query %></u></i></p>


  <div class="search-container col-md-4 pull-right">

  <input class="form-control " name="src" placeholder="Search Employee Leaves..." id="search" ng-model="query">

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('LeavesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> File a leave</a>
  
   <a  href="{{ action('LeavesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>



  <table class="table table-hover">
  	<thead>
      <th></th>
      <th>Employee ID</th>
  		<th > Name </th>
  		<th > Duration </th>
  		<th>Type</th>
  		<th>Status</th>
  	</thead>

  

  	<tbody id="leaves" >

    

      @foreach($leaves as $leave)
     
      <tr>
     
        <td>From ({{$leave->start_date}}) To ({{$leave->end_date}})</td>
        <td>{{  $helper->getLeaveType($leave->type) }}</td>
        <td>{{ $helper->getStatus($leave->status, true) }}</td>
      </tr>
      @endforeach
     
       
       

      
        
         

     
  	</tbody>
  </table>




  </div>

</div>



@include('partials.old_new')

@stop


@section('scripts')

<script>

$(document).ready(function($) {
    

    // $('#search').keyup(function(e) {
    //     var searchURL =  '/employees',
    //         searchString = $(this).val();  

    //     $.ajax({
    //         method: 'GET',
    //         url: searchURL,
    //         data: { searchJSON: searchString },
    //         datatype: 'json',
    //         beforeSend: function() {
    //           console.log('loading');
    //         },
    //         success: function(data) {
    //           $('#employees').html(data);
    //         }


    //     });
    // });
       
});

</script>

@stop