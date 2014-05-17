@extends('layout.master')


@section('content')



<div>
     
     <div class="container-fluid">

          <div class="col-sm-3 col-md-2 sidebar" >
            

            <ul class="nav nav-sidebar">
              <li class="active"><a href="#">Employees</a></li>
              <li ><a href="#">Promotions</a></li>
              <li><a href="#">Terminations</a></li>
              <li><a href="#">Assignments</a></li>
              <li><a href="{{ action('LeavesController@index') }}">Leaves</a></li>

              <li> 
                   <div class="filter-collection well">
          
                    <div class="filter-title" style="font-size: 16px; font-weight: bold;"> Filter by:</div>
                    <div class="filter-content"> 

                        @include('employees.partial.filterby')
                       
                    </div> <!-- Filter content -->
                    
                  </div>
            </li>
            </ul>
            
          </div>

  </div>




  <div class="table-container col-sm-11">


  <h2 class="page-header"> Employee list</h2>

  @include('partials.breadcrumbs')

  @if (Input::has('src'))
  <p>Search term: <span class="label label-default">{{Input::get('src') }}</span></p>
  @endif

  


  <div class="search-container col-md-4 pull-right">
   {{ Form::open(['method' => 'GET', 'action' => 'EmployeesController@index'])}}
   <?php  $request_param = Input::except('_token', '_method', 'src'); ?>

  <input class="form-control " name="src" placeholder="Search an employee..." id="search" ng-model="query" value="{{Input::get('src')}}">
  
  <!-- Retain query strings even while searching -->
   @foreach($request_param as $key => $value)
      {{Form::hidden($key, $value)}}
   @endforeach

  {{ Form::close()}}


  </div>

  <div class="header-buttons pull-left">
    @if ($accessControl->hasAccess($uri, 'create', $GLOBALS['_byPassRole']))
  <a href="{{ action('EmployeesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Create new Employee</a>
    @endif
   <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
   
 

  </div>



  <table class="table table-hover" ng-controller="EmployeeController" id="employeeTable">
  	<thead>
  		<th >ID </th>
  		<th > Name </th>
  		<th>Position</th>
      <th>Membership status</th>
  		<th>Employment status</th>
  	</thead>

  

  	<tbody id="employees" >

     
        
            <?php foreach ($employees as $employee): ?>

             <tr class="" >

                <td class="clickableRow" href="{{ route('employees.index') }}/{{ $employee->employee_work_id }}" > <?php echo $employee->employee_work_id . '</td>'; ?>
                <td class="clickableRow" href="{{ route('employees.index') }}/{{ $employee->employee_work_id }}"> <?php echo   ucfirst($employee->lastname) . ', ' . $employee->firstname . '</td>'; ?>
                <td> <?php echo  ucfirst($employee->position['name']) . '</td>'; ?>
                <td> <?php echo  ucfirst($employee->membership_status) . '</td>'; ?>
                <td> <?php echo ucfirst( $employee->employment_status) . '</td>'; ?>
                <td> 
                   @if ($accessControl->hasAccess($uri, 'edit', $GLOBALS['_byPassRole']))
                  <a class="btn btn-small btn-default editButton" href="{{ action('EmployeesController@edit', $employee->employee_work_id ) }}"> <span class="glyphicon glyphicon-edit"></span> Edit</a> 
                   @endif

                    @if ($accessControl->hasAccess($uri, 'delete', $GLOBALS['_byPassRole']))
                  <a class="btn btn-small btn-default deleteButton" href="#" data-employee_id="{{ $employee->employee_work_id}}"> <span class="glyphicon glyphicon-remove"></span> Delete</a> </td>
                    @endif
               </tr>
            <?php endforeach; ?>
       

      
        
         

     
  	</tbody>
  </table>

@if (count($employees) == 0)

  <div  align="center" class="alert alert-warning"> No Employees found.</div>

@endif

  <?php 

      echo $employees->appends(['src' => Input::get('src'), 'filterby' => Input::get('filterby')] )->links(); 
    
  ?>


  </div>

</div>



@include('partials.old_new')

@stop


@section('scripts')

<script>




(function() {
  // For clickable <tr> table rows
    $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });


    $('.deleteButton').on('click', function(e) {

      // Prevent from going back to top when clicking the button
      e.preventDefault();

      var deleteButton = $(this);

      // Get the data attribute with a key "employee_id"
      var id = deleteButton.data('employee_id');


      // Contact server to delete the employee
      $.ajax({
        type: 'DELETE',
        url: '{{ action('EmployeesController@destroy') }}',
        data: { employee_work_id: id },
        success: function(data) {
        
          if (data == "1") {
            deleteButton.closest('tr').fadeOut(255)
          }
        }
      });
      
    });


})();



// $(document).ready(function($) {
    
 

    
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
       
// });

</script>

@stop